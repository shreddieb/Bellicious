<?php
/**
 *
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 * @package   Comming soon page
 * @version   1.0.0
 */
?>
<?php
class Mdl_UnderConstruction_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getConfig($key, $storeId = null) {
        $path = 'underConstruction/settings/' . $key;
        return Mage::getStoreConfig($path, $storeId);
    }

}