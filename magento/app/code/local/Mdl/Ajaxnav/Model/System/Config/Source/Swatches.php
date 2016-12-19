<?php
class Mdl_Ajaxnav_Model_System_Config_Source_Swatches extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();
        
        $options[] = array(
                'value'=> 'link',
                'label' => Mage::helper('ajaxnav')->__('Links Only')
        );
        $options[] = array(
                'value'=> 'icons',
                'label' => Mage::helper('ajaxnav')->__('Icons Only')
        );
        $options[] = array(
                'value'=> 'iconslinks',
                'label' => Mage::helper('ajaxnav')->__('Icons + Links')
        );
        
        return $options;
    }
} 