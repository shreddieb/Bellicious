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
class Mdl_UnderConstruction_Controller_Router_Standard extends Mage_Core_Controller_Varien_Router_Standard {

    public function match(Zend_Controller_Request_Http $request) {

        $helper = Mage::helper('Mdl_UnderConstruction');
        $storeCode = $request->getStoreCodeFromPath();

        $enabled = $helper->getConfig('enabled', $storeCode);
        if (1 == $enabled) {

            $allowedIPsString = $helper->getConfig('allowedIPs', $storeCode);
            $allowedIPsString = preg_replace('/ /', '', $allowedIPsString);

            $allowedIPs = array();

            if ('' !== trim($allowedIPsString)) {
                $allowedIPs = explode(',', $allowedIPsString);
            }

            $currentIP = $_SERVER['REMOTE_ADDR'];

            $allowFrontendForAdmins = $helper->getConfig('allowFrontendForAdmins', $storeCode);

            $adminIp = null;
            if (1 == $allowFrontendForAdmins) {
                Mage::getSingleton('core/session', array('name' => 'adminhtml'));

                $adminSession = Mage::getSingleton('admin/session');
                if ($adminSession->isLoggedIn()) {
                    $adminIp = $adminSession['_session_validator_data']['remote_addr'];
                }
            }

            if ($currentIP === $adminIp) {
                $this->__log('Access granted for admin with IP: ' . $currentIP . ' and store ' . $storeCode, 2, $storeCode);
            } else {
                if (!in_array($currentIP, $allowedIPs)) {
                    $this->__log('Access denied  for IP: ' . $currentIP . ' and store ' . $storeCode, 1, $storeCode);

                        Mage::getSingleton('core/session', array('name' => 'front'));

                        $response = $this->getFront()->getResponse();

                        $response->setHeader('HTTP/1.1', '503 Service Temporarily Unavailable');
                        $response->setHeader('Status', '503 Service Temporarily Unavailable');
                        $response->setHeader('Retry-After', '5000');

                        $response->setBody(Mage::app()->getLayout()->createBlock('core/template')->setTemplate('underconstruction/underconstruction.phtml')->toHtml());
                        $response->sendHeaders();
                        $response->outputBody();
                  //  }
                    exit();
                } else {
                    $this->__log('Access granted for IP: ' . $currentIP . ' and store ' . $storeCode, 2, $storeCode);
                }
            }
        }

        return parent::match($request);
    }
	
    private function __log($string, $verbosityLevelRequired = 1, $storeCode = null, $zendLevel = Zend_Log::DEBUG) {
        $helper = Mage::helper('Mdl_UnderConstruction');
        $logFile = trim($helper->getConfig('logFile', $storeCode));
        $logVerbosity = trim($helper->getConfig('logVerbosity', $storeCode));

        if ('' === $logFile) {
            $logFile = 'maintenance.log';
        }

        if ($logVerbosity >= $verbosityLevelRequired) {
            Mage::log($string, $zendLevel, $logFile);
        }
    }

}