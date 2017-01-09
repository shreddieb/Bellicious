<?php 
/* Featured Category Custum option for config dropdown */
class Mdl_Featuredcategory_Model_System_Config_Source_Featuredcatcustomoptions
{
    public function toOptionArray()
    {
        return array(
            
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Currrent category only')),
			array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Currrent category and sub category')),
			array('value' => 2, 'label'=>Mage::helper('adminhtml')->__('Currrent category and all sub categories')),
            
        );
    }

}

?>