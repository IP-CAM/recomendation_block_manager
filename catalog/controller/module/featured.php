<?php
class ControllerModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('module/featured');

		$data['text_quick'] = $this->language->get('text_quick');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_price'] = $this->language->get('text_price');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_details'] = $this->language->get('button_details');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_sku'] = $this->language->get('text_sku');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_instock'] = $this->language->get('text_instock');
		$data['text_outstock'] = $this->language->get('text_outstock');
		$data['reviews'] = $this->language->get('reviews');
		$data['text_price'] = $this->language->get('text_price');

		$data['no_stock'] = $this->load->loadHelper('stock_status')->getNoStockStatusName();

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

        $recomendation_block_manager_rec_id = $this->config->get('recomendation_block_manager_rec');

        if (!empty($recomendation_block_manager_rec_id)){

            $products = array_reverse(explode(',', $recomendation_block_manager_rec_id));

        } else {

            $products = array_slice($setting['product'], 0, (int)$setting['limit']);

        }


		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
				$image1 = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ((float)$product_info['discount']) {
					$discount = $this->currency->format($this->tax->calculate($product_info['discount'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$discount = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $product_info['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $product_info['product_id'],
					'thumb'       => $image,
					'thumb1'      => $image1,
					'name'        => $product_info['name'],
					'price'       => $price,
					'special'     => $special,
					'discount'    => $discount,
					'quantity' 	  => $product_info['quantity'],
					'tax'         => $tax,
					'rating'      => $rating,
					'reviews'     => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
					'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'author'      => $product_info['manufacturer'],
					'model'       => $product_info['model'],
					'sku'         => $product_info['sku'],
					'allow'       => $product_info['minimum'],
					'description' => strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')),
					'description_html'  => html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'),
					'manufacturers'     => $this->url->link('product/manufacturer/product', 'manufacturer_id=' . $product_info['manufacturer_id']),
				);
			}
		}

		if ($data['products']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/featured.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/featured.tpl', $data);
			} else {
				return $this->load->view('default/template/module/featured.tpl', $data);
			}
		}
	}
}