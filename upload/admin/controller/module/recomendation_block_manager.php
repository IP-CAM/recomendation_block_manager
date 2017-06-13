<?php
class ControllerModuleRecomendationBlockManager extends Controller {

    private $error = array();
	public function index() {   
		$this->load->language('module/recomendation_block_manager');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('recomendation_block_manager_rec', ['recomendation_block_manager_rec' => $this->request->post['recomendation_block_manager_rec']]);
            $this->model_setting_setting->editSetting('recomendation_block_manager_pop', ['recomendation_block_manager_popular' => $this->request->post['recomendation_block_manager_popular']]);
            $this->model_setting_setting->editSetting('recomendation_block_manager_hit', ['recomendation_block_manager_hit' => $this->request->post['recomendation_block_manager_hit']]);
            $this->model_setting_setting->editSetting('recomendation_block_manager_news', ['recomendation_block_manager_news' => $this->request->post['recomendation_block_manager_news']]);

            $this->cache->delete_cache_products();

            $this->cache->delete_cache_welldone_modules();

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('module/recomendation_block_manager', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');

		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');

		/*Проверка на существование переменной success и и присваивание значения, для  вывода в шаблоне при сохранении */
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        /*/Проверка на существование переменной success и и присваивание значения, для  вывода в шаблоне при сохранении */
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/recomendation_block_manager', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('module/recomendation_block_manager', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('module/recomendation_block_manager', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];


		/*Работа с post запросами и запись в массив data[]*/

		$posts = ['recomendation_block_manager_rec', 'recomendation_block_manager_popular', 'recomendation_block_manager_hit', 'recomendation_block_manager_news'];

		foreach ($posts as $post){
            if (isset($this->request->post[$post])) {
                $data[$post] = $this->request->post[$post];
            } else {
                $data[$post] = $this->config->get($post);
            }
        }

        /*/Работа с post запросами и запись в массив data[]*/

		$this->load->model('catalog/product');

        $products_rec = explode(',', $data['recomendation_block_manager_rec']);

        $products_pop = explode(',', $data['recomendation_block_manager_popular']);

        $products_hit = explode(',', $data['recomendation_block_manager_hit']);

        $products_news = explode(',', $data['recomendation_block_manager_news']);


		$data['products_rec'] = array();
		
		foreach ($products_rec as $product_rec_id) {
			$product_rec_info = $this->model_catalog_product->getProduct($product_rec_id);
			
			if ($product_rec_info) {
				$data['products_rec'][] = array(
					'product_id' => $product_rec_info['product_id'],
					'name'       => $product_rec_info['name']
				);
			}

		}


        $data['products_pop'] = array();

        foreach ($products_pop as $product_pop_id) {
            $product_pop_info = $this->model_catalog_product->getProduct($product_pop_id);

            if ($product_pop_info) {
                $data['products_pop'][] = array(
                    'product_id' => $product_pop_info['product_id'],
                    'name'       => $product_pop_info['name']
                );
            }

        }

        $data['products_hit'] = array();

        foreach ($products_hit as $product_hit_id) {
            $product_hit_info = $this->model_catalog_product->getProduct($product_hit_id);

            if ($product_hit_info) {
                $data['products_hit'][] = array(
                    'product_id' => $product_hit_info['product_id'],
                    'name'       => $product_hit_info['name']
                );
            }

        }

        $data['products_news'] = array();

        foreach ($products_news as $product_news_id) {
            $product_news_info = $this->model_catalog_product->getProduct($product_news_id);

            if ($product_news_info) {
                $data['products_news'][] = array(
                    'product_id' => $product_news_info['product_id'],
                    'name'       => $product_news_info['name']
                );
            }

        }





        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/recomendation_block_manager.tpl', $data));


		//$this->response->setOutput($this->load->render());

	}

	protected function validate() {
        return !$this->error;
		/*if (!$this->user->hasPermission('modify', 'module/special_products_off')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}*/
	}
}
?>