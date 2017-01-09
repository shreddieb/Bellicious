<?php
$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
/**
 * Adding Different Attributes
 */
 
// adding attribute group
//$setup->addAttributeGroup('catalog_product', 'Default', 'Special Attributes', 1000);
 
// the attribute added will be displayed under the group/tab Special Attributes in product edit page
$setup->addAttribute('catalog_product', 'mdl_featured', array(
    'group'         => 'MDL Options',
    'input'         => 'select',
    'type'          => 'varchar',
    'label'         => 'MDL Featured',
    'backend'       => Null,
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 1,
    'filterable' => 0,
    'comparable'    => 1,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
	 'option'            => array (
                                            'value' => array('optionone' => array('Yes'),
                                                             'optiontwo' => array('No'),                 
                                                        )
                                        ),
    'is_html_allowed_on_front' => 0,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));

$setup->addAttribute('catalog_product', 'mdl_size_chart', array(
    'group'         => 'MDL Options',
    'input'         => 'media_image',
    'type'          => 'varchar',
    'label'         => 'Size Chart',          
    'frontend'       => "catalog/product_attribute_frontend_image",
    'visible'       => 1,   
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 1,
    'filterable' => 0,
    'comparable'    => 0,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 0,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,     
));

$installer->endSetup();