<?php 

class Mdl_Mdlnavi_Model_Config_Navigationhome
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Home link')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Home icon')),
			array('value' => '4', 'label'=>Mage::helper('adminhtml')->__('Remove home icon or link')),
        );
    }
}
?>