<?php

/**
 * PHP version: 7.4.30
 * 
 * @title:	  Shurjopay Opencart Plugin
 * @description: shurjoPay Engine backend exposes 3 simple RESTful API calls to facilitate authenticated secure payment and verification of payment transactions. Any integrator can use these calls to effectively integrate with shurjoPay and make payment transactions using credit or debit cards, mobile wallets and bank accounts using internet banking for their users.
 * This is the main Plugin file which contains the 3 API calls
 * 
 * @author     Mohammed Shahadat Ali
 * @author     Rubel Ahmed
 * @datetime   26 October 2022
 * @copyright  Shurjomukhi Ltd.
 * @website	  www.shurjopay.com.bd
 * @platform   Opencart 3.0.3.8
 * @version	  shurjopay 2.0

*/

//the configuration details are included here
require_once 'config.php';

class ControllerExtensionPaymentShurjopay extends Controller
{
    //sandbox testing url
	private $shurjopay_sandbox_api  = SHURJOPAY_SANDBOX_API;
    //shurjopay live url
	private $shurjopay_live_api  = SHURJOPAY_LIVE_API;

    //the API endpoints are defined here
	private $token_url = TOKEN_URL;
	private $payment_url = PAYMENT_URL;
	private $verification_url = VERIFICATION_URL;

    //This URL will be redirected after completing a payment
	private $return_url = RESPONSE_URL;



	public function index()
	{
	$data = $this->postFields();

		return $this->load->view('extension/payment/shurjopay', $data);
	}


	public function postFields(){
		$this->load->model('checkout/order');

		$this->load->language('extension/payment/shurjopay');

		$data['button_confirm'] = $this->language->get('button_confirm');

        //The generate_shurjo_pay function is redirected into a URL named action
		$data['action'] = $this->url->link('extension/payment/shurjopay/generate_shurjopay_form');
		
        
        //The callback function is redirected into returnUrl
		$data['returnUrl'] = $this->url->link('extension/payment/shurjopay/callback', '', true);
		// $data['cancel_url'] = $this->url->link('extension/payment/shurjopay/decrypt_and_validate', '', true)
		
        //data fetched from admin config of shurjopay plugin in shurjopay.twig file
        $data['pay_to_username'] = $this->config->get('payment_shurjopay_merchant_username');
		$data['pay_to_password'] = $this->config->get('payment_shurjopay_merchant_password');
		$data['uniq_transaction_key'] = $this->config->get('payment_shurjopay_merchant_uniq_transaction_key') . uniqid();
		$data['merchant_prefix'] = $this->config->get('payment_shurjopay_merchant_uniq_transaction_key');
		$data['userIP'] = $this->config->get('payment_shurjopay_merchant_userIP');
		$data['paymentOption'] = $this->config->get('payment_shurjopay_merchant_paymentOption');

		$data['sandbox'] = $this->config->get('payment_shurjopay_merchant_sandbox');

		$data['description'] = $this->config->get('config_name');
		$data['transaction_id'] = $this->session->data['order_id'];

		$data['language'] = $this->session->data['language'];
		$data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		$data['name'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
		$data['email'] = $order_info['email'];
		$data['phone'] = $order_info['telephone'];
		$data['address'] = $order_info['payment_address_1'];
		$data['city'] = $order_info['payment_city'];
		$data['state'] = $order_info['payment_zone'];
		$data['postcode'] = $order_info['payment_postcode'];
		$data['country'] = $order_info['payment_country'];
		$data['currency'] = $order_info['currency_code'];

        //order id taken from session
		$data['order_id'] = $this->session->data['order_id'];
		return $data;
	}

	/**
	 * callback
	 *
	 * @return void
	 */
	public function callback()
	{
		$token   = json_decode(json_encode($this->authentication()), true);

		$response = $this->verifyOrder($_REQUEST['order_id']);

		$this->load->model('checkout/order');

			
			$data =$response;

			$sp_code = $data['sp_code'];
			
			$order_id = $this->session->data['order_id'];

			$orderHistoryData = "Transaction ID:<b>"
				. $data['order_id']
				. "</b><br>Bank ID:<b>"
				. $data['bank_trx_id']
				. "</b><br>Payment Method:<b>"
				. $data['method'] . "</b>";

			switch ($sp_code) {

				case '000':
					$res = array('status' => true, 'msg' => 'Your Transaction is Success');
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_shurjopay_order_status_id'), $orderHistoryData, true);
					break;

				case '001':
					$res = array('status' => false, 'msg' => 'Your Transaction Failed');
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'), $orderHistoryData, true);
					break;
			}

			if ($res['status']) {
				$this->session->data['success'] = $res['msg'];
				header("location: " . $this->url->link('checkout/success'));
				die();
			} else {
				$this->session->data['error'] = $res['msg'];
				header("location: " . $this->url->link('checkout/checkout', '', true));
				die();
			}
		// }
	}

	/**
	 * generate_shurjopay_form
	 *
	 * @return string
	 */
	public function generate_shurjopay_form()
	{

		/**-Function-generate_shurjopay_form
			This function is used to create payload body.
			This prepareTransactionPayload function will return payload data.
		*/
		
        //Generate token from authentication function
		$token   = json_decode($this->authentication(), true);

        //This is the request parameters for checkout
		$createpaybody = json_encode(
			array(
				// store information
				'token' => $token['token'],
				'store_id' => $token['store_id'],
				'prefix' => $this->request->post['merchant_prefix'],
				'currency' => $this->request->post['currency'],
				'return_url' => $this->request->post['returnUrl'],
				'cancel_url' => $this->request->post['returnUrl'],
				'amount' => $this->request->post['amount'],
				// Order information
				'order_id' => $this->request->post['uniq_transaction_key'],
				'discsount_amount' => 0,
				'disc_percent' => 0,
				// Customer information
				'client_ip' => $_SERVER['REMOTE_ADDR'] ?: ($_SERVER['HTTP_X_FORWARDED_FOR'] ?: $_SERVER['HTTP_CLIENT_IP']),
				'customer_name' => $this->request->post['name'],
				'customer_phone' => $this->request->post['phone'],
				'customer_email' => $this->request->post['email'],
				'customer_address' => $this->request->post['address'],
				'customer_city' => $this->request->post['city'],
				'customer_state' => $this->request->post['state'],
				'customer_postcode' => $this->request->post['postcode'],
				'customer_country' => $this->request->post['country'],
				'value1' => $this->session->data['order_id'],
				'value2' => 'value2',
				'value3' => 'value3',
				'value4' => 'value4'
			)
		);



		$header = array(
			'Content-Type:application/json',
			'Authorization: Bearer ' . $token['token']
		);

		// var_dump($createpaybody);exit;


        $response = $this->prepareCurlRequest($this->payment_url, 'POST', $createpaybody, $header);

        $urlData = json_decode($response);
		header('Location: ' . $urlData->checkout_url);
	}
	/**
	 * authentication
	 *
	 * @return string
	 */
	public function authentication()
	{
        /**
         * This function is used to authenticate user and generate token.
         * the function connects with the Authentication API by providing username and password
         * the function then returns a response that contains a token and some other data as well:
         * Token,
         * store_id,
         * execute_url,
         * token_type,
         * sp_code,
         * massage,
         * TokenCreateTime,
         * expires_in
        */
		
            //checking if sandbox testing is selected
			if ($this->config->get('payment_shurjopay_merchant_sandbox')) {
				$url = $this->shurjopay_sandbox_api;
			} else {
				$url = $this->shurjopay_live_api;
			}
			$data = $this->postFields();
			$sp_user = $data['pay_to_username'];
			$sp_pass = $data['pay_to_password'];
            
            //saving shurjopay credentials into an array
			$credential = array(
				'username' => trim($sp_user),
				'password' => html_entity_decode($sp_pass),
			);
	
			$header = array(
				''
			);

            //checking if token url or credentials is found or not
			if (empty($this->token_url) || empty($credential)) return null;
			try {
                //send all required data to prepareCurlRequest
				$response = $this->prepareCurlRequest($this->token_url, 'POST', $credential, $header);
				if ($response === false) {
					throw new Exception('error');
				}
	
				# Got object as response from prepareCurlRequest in $response variable
				# and returning that object from here
				return $response;
	
			} catch (Exception $e) {
				return $e->getMessage();
			}
		
	}


	public function prepareCurlRequest($url, $method, $payload_data, $header)
	{ 
		/**-Function-prepareCurlRequest
			This function is used to prepare curl body.
			This prepareCurlRequest function will return curl response.
		*/

		try {
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_HTTPHEADER => $header,
				CURLOPT_POST => 1,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => $payload_data,
				CURLOPT_CUSTOMREQUEST => $method,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
			));
		} catch (Exception $e) {
			// logInfo("ShurjoPay has been failed for preparing Curl request !");
			return $e->getMessage();
		} finally {
			$response = curl_exec($curl);
			//print_r($response);exit();
			curl_close($curl);

			# here , returning object instead of Json to our core three method
			return $response;
		}
	}
	public function verifyOrder($shurjopay_order_id)
	{
        /**
         * This function connects with the Verification API by sending the order id as a request
         * This function then returns a response that contains the details of the order
        */

		$token   = json_decode($this->authentication(), true);
		// var_dump($token);exit;
		$header=array(
		    'Content-Type:application/json',
		    'Authorization: Bearer '.$token['token']    
		);
		$postOrderId = json_encode (
		        array(
		            'order_id' => $shurjopay_order_id
		        )
		);
		try {
			$response = $this->prepareCurlRequest($this->verification_url,'POST',$postOrderId,$header);
			return $response; 
			      //object
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
