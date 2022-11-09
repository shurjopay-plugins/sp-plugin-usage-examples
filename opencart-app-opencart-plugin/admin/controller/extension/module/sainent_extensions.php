<?php
class ControllerExtensionModuleSainentExtensions extends Controller {
    private $error; 
    
    public function index() {
        
        $this->load->language('extension/module/sainent_extensions');
		
		$this->document->setTitle($this->language->get('text_title'));
        
        $data['breadcrumbs'] = array();
        
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_title'),
			'href' => $this->url->link('extension/module/sainent_extensions', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		$data['user_token'] = $this->session->data['user_token'];
		         
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/sainent_extensions', $data));
    }
		
	public function install() {
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/sainent_extensions');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/sainent_extensions');

		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('module_sainent_extensions', array('module_sainent_extensions_status' => '1'));
		
	}
	
	public function uninstall() {
		$this->load->model('user/user_group');
		$this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'extension/module/sainent_extensions');
		$this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'extension/module/sainent_extensions');
    }
	
}