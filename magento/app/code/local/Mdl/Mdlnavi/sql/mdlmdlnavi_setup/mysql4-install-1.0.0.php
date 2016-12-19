<?php
$this->startSetup();

$this->addAttribute('catalog_category', 'mdlmdlnavi_type', array(
	'group' => 'Mdl Navigation',
	'type' => 'varchar',
	'input' => 'select',
	'source' => 'mdlmdlnavi/category_attribute_source_type',
	'label' => 'Menu type',
	'note' => "For top-level categories only",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'default'  => 'default',
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 100,
));

$this->addAttribute('catalog_category', 'mdlmdlnavi_labelcolor', array(
	'group' => 'Mdl Navigation',
	'type' => 'varchar',
	'input' => 'select',
	'source' => 'mdlmdlnavi/category_attribute_source_labelcolor',
	'label' => 'Label Color',
	'note' => "label color",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 200,
));


$this->addAttribute('catalog_category', 'mdlmdlnavi_mdllabel', array(
	'group' => 'Mdl Navigation',
	'type' => 'text',
	'input' => 'text',
	'label' => 'Label',
	'note' => "New or Sale label etc..",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 300,
));


$this->addAttribute('catalog_category', 'mdlmdlnavi_top', array(
	'group' => 'Mdl Navigation',
	'input' => 'textarea',
	'type' => 'text',
	'label' => 'Top block',
	'note' => "For top-level categories only",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 400,
));

$this->addAttribute('catalog_category', 'mdlmdlnavi_bottom', array(
	'group' => 'Mdl Navigation',
	'input' => 'textarea',
	'type' => 'text',
	'label' => 'Bottom block',
	'note' => "For top-level categories only",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 500,
));

$this->addAttribute('catalog_category', 'mdlmdlnavi_right', array(
	'group' => 'Mdl Navigation',
	'input' => 'textarea',
	'type' => 'text',
	'label' => 'Right block',
	'note' => "For top-level categories only",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 600,
));

$this->addAttribute('catalog_category', 'mdlmdlnavi_right_rsize', array(
	'group' => 'Mdl Navigation',
	'type' => 'varchar',
	'input' => 'select',
	'source' => 'mdlmdlnavi/category_attribute_source_rsize',
	'label' => 'Right block width',
	'note' => "Right Block size",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 700,
));

$this->addAttribute('catalog_category', 'mdlmdlnavi_menu', array(
	'group' => 'Mdl Navigation',
	'type' => 'int',
	'input' => 'select',
	'source' => 'mdlmdlnavi/category_attribute_source_yesno',
	'label' => 'Enable Subcategories',
	'note' => "enable disable subcategories",
	'backend' => '',
	'visible' => true,
	'required' => false,
	'visible_on_front' => true,
	'wysiwyg_enabled' => true,
	'is_html_allowed_on_front'	=> true,
	'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'position' => 800,
));

$this->endSetup();