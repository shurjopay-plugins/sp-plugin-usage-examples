<?php
class ControllerExtensionPaymentShurjopay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/shurjopay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_shurjopay', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['merchant_sandbox'])) {
			$data['error_merchant_sandbox'] = $this->error['merchant_sandbox'];
		} else {
			$data['error_merchant_sandbox'] = '';
		}

		if (isset($this->error['merchant_username'])) {
			$data['error_merchant_username'] = $this->error['merchant_username'];
		} else {
			$data['error_merchant_username'] = '';
		}


		if (isset($this->error['merchant_password'])) {
			$data['error_merchant_password'] = $this->error['merchant_password'];
		} else {
			$data['error_merchant_password'] = '';
		}

		
		if (isset($this->error['merchant_uniq_transaction_key'])) {
			$data['error_merchant_uniq_transaction_key'] = $this->error['merchant_uniq_transaction_key'];
		} else {
			$data['error_merchant_uniq_transaction_key'] = '';
		}


		if (isset($this->error['merchant_userIP'])) {
			$data['error_merchant_userIP'] = $this->error['merchant_userIP'];
		} else {
			$data['error_merchant_userIP'] = '';
		}	




		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/shurjopay', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/shurjopay', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

		if (isset($this->request->post['payment_shurjopay_merchant_sandbox'])) {
			$data['payment_shurjopay_merchant_sanbox'] = $this->request->post['payment_shurjopay_merchant_sandbox'];
		} else {
			$data['payment_shurjopay_merchant_sandbox'] = $this->config->get('payment_shurjopay_merchant_sandbox');
		}


		if (isset($this->request->post['payment_shurjopay_merchant_username'])) {
			$data['payment_shurjopay_merchant_username'] = $this->request->post['payment_shurjopay_merchant_username'];
		} else {
			$data['payment_shurjopay_merchant_username'] = $this->config->get('payment_shurjopay_merchant_username');
		}

		if (isset($this->request->post['payment_shurjopay_merchant_password'])) {
			$data['payment_shurjopay_merchant_password'] = $this->request->post['payment_shurjopay_merchant_password'];
		} else {
			$data['payment_shurjopay_merchant_password'] = $this->config->get('payment_shurjopay_merchant_password');
		}



		if (isset($this->request->post['payment_shurjopay_merchant_uniq_transaction_key'])) {
			$data['payment_shurjopay_merchant_uniq_transaction_key'] = $this->request->post['payment_shurjopay_merchant_uniq_transaction_key'];
		} else {
			$data['payment_shurjopay_merchant_uniq_transaction_key'] = $this->config->get('payment_shurjopay_merchant_uniq_transaction_key');
		}

		$data['payment_shurjopay_merchant_paymentOption'] = isset($this->request->post['payment_shurjopay_merchant_paymentOption'])?$this->request->post['payment_shurjopay_merchant_paymentOption']:'shurjopay';



		if (isset($this->request->post['payment_shurjopay_merchant_userIP'])) {
			$data['payment_shurjopay_merchant_userIP'] = $this->request->post['payment_shurjopay_merchant_userIP'];
		} else {
			$data['payment_shurjopay_merchant_userIP'] = $this->config->get('payment_shurjopay_merchant_userIP');
		}

		

		if (isset($this->request->post['payment_shurjopay_order_status_id'])) {
			$data['payment_shurjopay_order_status_id'] = $this->request->post['payment_shurjopay_order_status_id'];
		} else {
			$data['payment_shurjopay_order_status_id'] = $this->config->get('payment_shurjopay_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();


	
		if (isset($this->request->post['payment_shurjopay_status'])) {
			$data['payment_shurjopay_status'] = $this->request->post['payment_shurjopay_status'];
		} else {
			$data['payment_shurjopay_status'] = $this->config->get('payment_shurjopay_status');
		}

		if (isset($this->request->post['payment_shurjopay_sort_order'])) {
			$data['payment_shurjopay_sort_order'] = $this->request->post['payment_shurjopay_sort_order'];
		} else {
			$data['payment_shurjopay_sort_order'] = $this->config->get('payment_shurjopay_sort_order');
		}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/shurjopay', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/shurjopay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


		if (!$this->request->post['payment_shurjopay_merchant_username']) {
			$this->error['merchant_username'] = $this->language->get('error_merchant_username');
		}

		
		if (!$this->request->post['payment_shurjopay_merchant_password']) {
			$this->error['merchant_password'] = $this->language->get('error_merchant_password');
		}		

		if (!$this->request->post['payment_shurjopay_merchant_uniq_transaction_key']) {
			$this->error['merchant_uniq_transaction_key'] = $this->language->get('error_merchant_uniq_transaction_key');
		}


		if (!$this->request->post['payment_shurjopay_merchant_userIP']) {
			$this->error['merchant_userIP'] = $this->language->get('error_merchant_userIP');
		}

		return !$this->error;
	}
}