<?php
class Mdl_Ajaxnav_Model_System_Config_Source_States extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();
        
        $options[] = array(
                'value'=> 'sidebar',
                'label' => Mage::helper('ajaxnav')->__('Sidebar')
        );
        $options[] = array(
                'value'=> 'productlist',
                'label' => Mage::helper('ajaxnav')->__('Above Product List')
        );
        $options[] = array(
                'value'=> 'none',
                'label' => Mage::helper('ajaxnav')->__('Hide')
        );
        
        return $options;
    }
} 