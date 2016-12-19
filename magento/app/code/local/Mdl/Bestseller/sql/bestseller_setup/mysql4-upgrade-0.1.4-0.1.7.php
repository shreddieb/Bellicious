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


$setup->addAttribute('catalog_product', 'mdl_new', array(
    'group'         => 'MDL Options',
    'input'         => 'boolean',
    'type'          => 'int',
    'label'         => 'New',
    'backend'       => Null,
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 1,
    'filterable' => 0,
    'comparable'    => 1,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 0,
    'used_in_product_listing' => true,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));

$installer->endSetup();