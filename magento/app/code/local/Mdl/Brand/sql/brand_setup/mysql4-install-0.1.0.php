<?php

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();


$attr = array (
  'group'=>'MDL Brand Product',
  'attribute_model' => NULL,
  'backend' => '',
  'type' => 'int',
  'table' => '',
  'frontend' => '',
  'input' => 'select',
  'label' => 'Brand',
  'frontend_class' => '',
  'source' => '',
  'required' => '0',
  'user_defined' => '1',
  'default' => '',
  'unique' => '0',
  'note' => '',
  'input_renderer' => NULL,
  'is_global' => '2',
  'visible' => '1',
  'searchable' => '1',
  'is_filterable' => '1',
  'comparable' => '0',
  'visible_on_front' => '1',
  'is_html_allowed_on_front' => '0',
  'is_used_for_price_rules' => '',
  'filterable_in_search' => '0',
  'used_in_product_listing' => '0',
  'used_for_sort_by' => '0',
  'is_configurable' => '1',
  'apply_to' => 'simple',
  'visible_in_advanced_search' => '0',
  'position' => '0',
  'wysiwyg_enabled' => '0',
  'used_for_promo_rules' => '0',
 );
$setup->addAttribute('catalog_product','brand',$attr); /*brand is used  in helper*/
$setup->updateAttribute('catalog_product', 'brand', 'is_filterable', 1);
$this->run("
CREATE TABLE {$this->getTable('mdl_brand')} (
   brand_id int NOT NULL AUTO_INCREMENT,
   brand_option_name varchar(255) NOT NULL,
   brand_title varchar(255) NOT NULL,
   brand_status INT NOT NULL DEFAULT 0,
   brand_position INT NOT NULL DEFAULT 0,
   brand_image text,
   brand_thumbnail_image text,
   brand_description text,
   store_id varchar(255) NOT NULL,
   UNIQUE (brand_option_name),
   PRIMARY KEY (brand_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


");
$installer->endSetup();
?>