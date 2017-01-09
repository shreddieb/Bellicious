<?php
class Mdlext_Mdloption_Model_Observer
{
	public function controllerActionPredispatch($observer){
		$action = $observer->getEvent()->getControllerAction();
		return $this;
	}
	
	public function prepareLayoutBefore(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();

        if ("head" == $block->getNameInLayout()) {
            foreach (Mage::helper('mdloption')->getFiles() as $file) {
                $block->addJs(Mage::helper('mdloption')->getJQueryPath($file));
            }
        }
        return $this;
    }
}