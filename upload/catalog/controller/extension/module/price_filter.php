<?php
class ControllerExtensionModulePriceFilter extends Controller {
	public function index() {
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		$category_id = end($parts);

		$this->load->model('catalog/category');
		
		$this->load->model('localisation/currency');

		$category_info = $this->model_catalog_category->getCategory($category_id);

		if ($category_info) {
                        //270717 upgrading to opencart 2.3.0.1
			$this->load->language('extension/module/price_filter');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['button_filter'] = $this->language->get('button_filter');

			$url = '';
			$this->document->addScript('catalog/view/javascript/slider/jquery.slider.js');
			$this->document->addScript('catalog/view/javascript/slider/slider.js');
			$this->document->addStyle('catalog/view/javascript/slider/slider.css');
			$this->document->addStyle('//code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css');
			

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['action'] = str_replace('&amp;', '&', $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url));

			if (isset($this->request->get['price_range'])) {
				$data['price_range'] = explode('-', $this->request->get['price_range']);
			} else {
				$data['price_range'] = array();
			}
			
			if (version_compare(VERSION, '2.2.0.0', '<') == true) {
				$pcode = $this->currency->getCode();
			} else {
				$pcode = $this->session->data['currency'];
			}	
			
			if ($this->currency->getSymbolLeft($pcode)) {
				$code = $this->currency->getSymbolLeft($pcode);
				$data['right_code'] = false;
			} else {
				$code = $this->currency->getSymbolRight($pcode);
				$data['right_code'] = true;
			}
			
			$data['price_code'] = $code;
			$range = explode('-', $this->config->get('price_filter_range'));
			$data['price_range_min'] = $this->currency->convert($range[0], 'XYZ', $pcode);
			$data['price_range_max'] = $this->currency->convert($range[1], 'XYZ' , $pcode);
			$data['product_class'] = $this->config->get('price_filter_class');
			
			if (version_compare(VERSION, '2.2.0.0', '<') == true) {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/price_filter.tpl')) {
					return $this->load->view($this->config->get('config_template') . '/template/module/price_filter.tpl', $data);
				} else {
					return $this->load->view('default/template/module/price_filter.tpl', $data);
				}
			} else {
                            //moving to Opencart 2.3.0.1
				return $this->load->view('extension/module/price_filter', $data);
			}
		}
	}
}