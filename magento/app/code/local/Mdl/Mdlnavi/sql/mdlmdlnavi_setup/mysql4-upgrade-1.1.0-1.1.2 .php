<?php
/* @var $this Mage_Core_Model_Resource_Setup */
$this->startSetup();

$this->addAttribute("catalog_category", "mdlmdlnavi_thumb",  array(
    "type"     => "varchar",
    "backend"  => "catalog/category_attribute_backend_image",
    "frontend" => "",
    "label"    => "Thumbnail",
    "input"    => "image",
    "class"    => "custom-category-image",
    "source"   => "",
    "global"   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    "visible"  => true,
    "required" => false,
    "user_defined"  => false,
    "default" => "",
    "searchable" => false,
    "filterable" => false,
    "comparable" => false,
    'group' => 'Mdl Navigation',
    "visible_on_front"  => true,
    "unique"     => false,
    'note' => "For top-level categories only"
	));

$this->addAttribute('catalog_category', 'mdlmdlnavi_selectcol', array(
	'group' => 'Mdl Navigation',
	'type' => 'varchar',
	'input' => 'select',
	'source' => 'mdlmdlnavi/category_attribute_source_selectcol',
	'label' => 'Select no of column',
	'note' => "For top-level categories only",
	'backend' => '',
	'default'  => 4,
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 150
));

$this->endSetup();