<?php
class ControllerExtensionModulePriceFilter extends Controller {
	private $error = array();

	public function index() {
                //270717
		//$this->load->language('module/price_filter');
                  $this->load->language('extension/module/price_filter');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('price_filter', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
                        //270717 - adapting to 2.3.0.1
			//$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
                        $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_price_range'] = $this->language->get('text_price_range');
		$data['text_price_class'] = $this->language->get('text_price_class');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_price_class'] = $this->language->get('entry_price_class');
		$data['entry_price_range'] = $this->language->get('entry_price_range');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
                        //moving to Opencart 2.0.3.1, add extension
			'href' => $this->url->link('extension/module/price_filter', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('extension/module/price_filter', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['price_filter_status'])) {
			$data['price_filter_status'] = $this->request->post['price_filter_status'];
		} else {
			$data['price_filter_status'] = $this->config->get('price_filter_status');
		}
		
		if (isset($this->request->post['price_filter_range'])) {
			$data['price_filter_range'] = $this->request->post['price_filter_range'];
		} else {
			$data['price_filter_range'] = $this->config->get('price_filter_range');
		}
		
		if (isset($this->request->post['price_filter_class'])) {
			$data['price_filter_class'] = $this->request->post['price_filter_class'];
		} elseif($this->config->get('price_filter_class')) {
			$data['price_filter_class'] = $this->config->get('price_filter_class');
		} else {
			$data['price_filter_class'] = 'product-layout';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		//$this->response->setOutput($this->load->view('module/price_filter.tpl', $data));
		//250717 - adapting to 2.3.0.1
		$this->response->setOutput($this->load->view('extension/module/price_filter.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/price_filter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}