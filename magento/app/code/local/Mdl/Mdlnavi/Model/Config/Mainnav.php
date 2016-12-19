<?php 

class Mdl_Mdlnavi_Model_Config_Mainnav
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Top Side')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Left Side')),
        );
    }
}
?>