<?php
$magentoVersion = Mage::getVersion();
if (version_compare($magentoVersion, '1.9.2.2', '>=')){
$resource = Mage::getSingleton('core/resource');
$installer = $this;
$installer->startSetup();
    $readConnection = $resource->getConnection('core_read');

    $query = 'SELECT * FROM permission_block where block_name="catalog/product_list"';

    $results = $readConnection->fetchAll($query);
    $count = count($results);
    if($count==0) {
    $installer->run("
    INSERT IGNORE INTO permission_block (`block_name`, `is_allowed`) VALUES ('catalog/product_list', 1);
    ");
    }
$installer->endSetup();
}