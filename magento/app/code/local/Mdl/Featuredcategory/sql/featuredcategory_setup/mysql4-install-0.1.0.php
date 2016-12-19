<?php 
/*  Table::mdl_featured_category */
$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('featuredcategory/featured'))
    ->addColumn('featured_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Featured ID')
    ->addColumn('featured_category', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
        ), 'Featured Category')
    ->setComment('Mdl featuredcategory/featured entity table');
$installer->getConnection()->createTable($table);
// Category Thumbnail Attribute
$setup->addAttribute('catalog_category', 'mdl_featured_thumbnail', array(
    'group'         => 'General Information',
    'input'         => 'image',
    'type'          => 'varchar',
    'label'         => 'Featured Thumbnail',          
    'backend'       => "catalog/category_attribute_backend_image", 
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
	'position' => 5,	
));
$installer->endSetup();