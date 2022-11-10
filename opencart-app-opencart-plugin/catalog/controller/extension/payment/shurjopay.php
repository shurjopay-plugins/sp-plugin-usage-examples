<?php

/**
 * 
 * PHP version: 7.4.30
 * 
 * @title:	  Shurjopay Opencart Plugin
 * @description: shurjoPay Engine backend exposes 3 simple RESTful API calls to facilitate authenticated secure payment and verification of payment transactions. Any integrator can use these calls to effectively integrate with shurjoPay and make payment transactions using credit or debit cards, mobile wallets and bank accounts using internet banking for their users.
 * This is the main Plugin file which contains the 3 API calls
 * 
 * @author     Mohammed Shahadat Ali
 * @author     Rubel Ahmed
 * @copyright  Shurjopay Ltd.
 * @website	  www.shurjopay.com.bd
 * @platform   Opencart 3.0.3.8
 * @version	  shurjopay 2.0
 * @since 2022-11-08
 * 
 * TODO: commenting left for ipnHandler function
 */

//the configuration details are included here
require_once 'shurjopayConfig.php';

class ControllerExtensionPaymentShurjopay extends Controller
{
	//sandbox testing url
	private $shurjopay_sandbox_api  = SHURJOPAY_SANDBOX_API;
    //shurjopay live url
	private $shurjopay_live_api  = SHURJOPAY_LIVE_API;

	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		$data = $this->postFields();
		return $this->load->view('extension/payment/shurjopay', $data);
	}
	
	/**
	 * getConfiguration
	 * 
	 * this function handles the API endpoints
	 * 
	 * @return void
	 */
	public function getConfiguration()
	{
		$baseUrl = $this->config->get('payment_shurjopay_merchant_sandbox') ? $this->shurjopay_sandbox_api : $this->shurjopay_live_api;

		return (object) array(
			'tokenUrl' => $baseUrl . 'api/get_token',
			'paymentUrl' => $baseUrl . 'api/secret-pay',
			'verificationUrl' => $baseUrl . 'api/verification'
		);
	}
	
	/**
	 * postFields
	 * this function fetches the admin panel form credentials
	 * this function fetches all the order information which are required for the APIs
	 * @return void
	 */
	public function postFields()
	{
		$this->load->model('checkout/order');

		$this->load->language('extension/payment/shurjopay');

		$data['button_confirm'] = $this->language->get('button_confirm');

		//The generate_shurjopay_form function is redirected into action
		$data['action'] = $this->url->link('extension/payment/shurjopay/generate_shurjopay_form');

		//The callback function is redirected into returnUrl
		$data['returnUrl'] = $this->url->link('extension/payment/shurjopay/callback', '', true);

		//data fetched from admin config of shurjopay plugin in shurjopay.twig file
		$data['pay_to_username'] = $this->config->get('payment_shurjopay_merchant_username');
		$data['pay_to_password'] = $this->config->get('payment_shurjopay_merchant_password');
		$data['uniq_transaction_key'] = $this->config->get('payment_shurjopay_merchant_uniq_transaction_key'). '_' . $this->session->data['order_id'];
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
	 * all the necessary data is required here to get a response from the Verification API
	 * @return void
	 */
	public function callback()
	{

		$this->load->model('checkout/order');
		$response = $this->verifyOrder($_REQUEST['order_id']);
		$responseFormatted = json_decode($response);
		// Cross check the order id
		$order_id = $this->session->data['order_id'];
		// update the transaction
		// Create string for payment status
		$orderHistoryData = "Transaction ID:<b>"
			. $responseFormatted[0]->order_id
			. "</b><br>Bank ID:<b>"
			. $responseFormatted[0]->bank_trx_id
			. "</b><br>Payment Status:<b>"
			. $responseFormatted[0]->sp_message . "</b>"
			. "</b><br>Payment Method:<b>"
			. $responseFormatted[0]->method . "</b>";

		switch ($responseFormatted[0]->sp_code) {

			case '1000':
				$res = array('status' => true, 'msg' => $responseFormatted[0]->sp_message);
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_shurjopay_order_status_id'), $orderHistoryData, true);
				break;

			case '1001':
				$res = array('status' => false, 'msg' => $responseFormatted[0]->sp_message);
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'), $orderHistoryData, true);
				break;
			case '1002' || '1003' || '1004':
				$res = array('status' => false, 'msg' => $responseFormatted[0]->sp_message);
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'), $orderHistoryData, true);
				break;
		}

		if ($responseFormatted[0]->sp_code == 1000) {
			$this->session->data['success'] = $res['msg'];
			header("location: " . $this->url->link('checkout/success'));
		} else {
			$this->session->data['error'] = $res['msg'];
			header("location: " . $this->url->link('checkout/checkout', '', true));
		}
	}

	/**
	 * generate_shurjopay_form
	 * The token from authentication is then sent to this function
	 * This function is used to create payload body.
	 * This function will return payload data and redirect to the checkout API
	 * @return string
	 */
	public function generate_shurjopay_form()
	{
		$token   = json_decode($this->authentication(), true);
		$config = $this->getConfiguration();

		//payload
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

		//sending payload data, payment url and header to prepareCurlRequest function
		$response = $this->prepareCurlRequest($config->paymentUrl, 'POST', $createpaybody, $header);

		$urlData = json_decode($response);
		header('Location: ' . $urlData->checkout_url);
	}
	/**
	 * authentication
	 * This function is used to authenticate user and generate token.
	 * the function connects with the Authentication API by providing username and password
	 * the function then returns a response that contains a token and some other authentication details as well:
		* Token,
		* store_id,
		* execute_url,
		* token_type,
		* sp_code,
		* massage,
		* TokenCreateTime,
		* expires_in
	 * @return string
	 */
	public function authentication()
	{

		//calling getConfiguration function to check if sandbox testing is selected
		$config = $this->getConfiguration();

		$data = $this->postFields();
		$sp_user = $data['pay_to_username'];
		$sp_pass = $data['pay_to_password'];

		//saving shurjopay credentials into an array
		$credential = array(
			'username' => trim($sp_user),
			'password' => html_entity_decode($sp_pass),
		);
		$header = array('');

		//checking if token url or credentials is found or not
		if (empty($config->tokenUrl) || empty($credential)) return null;
		try {
			//send all required data to prepareCurlRequest
			$response = $this->prepareCurlRequest($config->tokenUrl, 'POST', $credential, $header);
			if ($response === false) {
				throw new Exception('error');
			}
		} catch (Exception $e) {
			return $e->getMessage();
		} finally {
			return $response;
		}
	}

	
	/**
	 * prepareCurlRequest
	 * This function is used to prepare curl body.
	 * This prepareCurlRequest function will return curl response.
	 * @param  mixed $url
	 * @param  mixed $method
	 * @param  mixed $payload_data
	 * @param  mixed $header
	 * @return void
	 */
	public function prepareCurlRequest($url, $method, $payload_data, $header)
	{ 
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
				#If HTTPS not working in local project
				#Please Uncomment |CURLOPT_SSL_VERIFYPEER| 
				#NOTE-Please Comment Again before going Live
				//CURLOPT_SSL_VERIFYPEER => 0,
			));
		} catch (Exception $e) {
			return $e->getMessage();
		} finally {
			$response = curl_exec($curl);
			curl_close($curl);

			return $response;
			# here , returning object instead of Json to our core three method
		}
	}	
	
	/**
	 * verifyOrder
	 * This function connects with the Verification API by sending the order id as a request
	 * This function then returns a response that contains the details of the order
	 * @param  mixed $shurjopay_order_id
	 * @return void
	 */
	public function verifyOrder($shurjopay_order_id)
	{

		$config = $this->getConfiguration();

		$token   = json_decode($this->authentication(), true);
		$header = array(
			'Content-Type:application/json',
			'Authorization: Bearer ' . $token['token']
		);
		$postOrderId = json_encode(
			array(
				'order_id' => $shurjopay_order_id
			)
		);
		try {
			$response = $this->prepareCurlRequest($config->verificationUrl, 'POST', $postOrderId, $header);
		} catch (Exception $e) {
			return $e->getMessage();
		} finally {
			return $response;
		}
	}

	//Commenting left
	public function ipnHandler()
	{
		if(empty($_REQUEST['order_id']))  { return false;} 
		$response = $this->verifyOrder($_REQUEST['order_id']);
		$responseFormatted = json_decode($response);
		$order_id = $responseFormatted[0]->customer_order_id;
		$op_order_id_with_prefix = explode("_",$order_id);
		$op_order_id = $op_order_id_with_prefix[1];
		
		$orderHistoryData = "Transaction ID:<b>"
			. $order_id
			. "</b><br>Bank ID:<b>"
			. $responseFormatted[0]->bank_trx_id
			. "</b><br>Payment Status:<b>"
			. $responseFormatted[0]->sp_message . "</b>"
			. "</b><br>Payment Method:<b>"
			. $responseFormatted[0]->method . "</b>";

		switch ($responseFormatted[0]->sp_code) {

			case '1000':
				$res = array('status' => true, 'msg' => $responseFormatted[0]->sp_message);
				$this->model_checkout_order->addOrderHistory($op_order_id, $this->config->get('payment_shurjopay_order_status_id'), $orderHistoryData, true);
				break;
			case '1001':
				$res = array('status' => false, 'msg' => $responseFormatted[0]->sp_message);
				$this->model_checkout_order->addOrderHistory($op_order_id, $this->config->get('config_order_status_id'), $orderHistoryData, true);
				break;
			case '1002' || '1003' || '1004':
				$res = array('status' => false, 'msg' => $responseFormatted[0]->sp_message);
				$this->model_checkout_order->addOrderHistory($op_order_id, $this->config->get('config_order_status_id'), $orderHistoryData, true);
				break;
		}

		return false;

	}
}
