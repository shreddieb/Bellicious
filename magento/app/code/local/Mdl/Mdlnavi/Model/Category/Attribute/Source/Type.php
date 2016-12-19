<?php

class Mdl_Mdlnavi_Model_Category_Attribute_Source_Type extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = array(
				array(
					'value' => 'default',
					'label' => Mage::helper('catalog')->__('Default'),
				),
				array(
					'value' => 'megamenu',
					'label' => Mage::helper('catalog')->__('Megamenu'),
				),
			);
		}
		return $this->_options;
	}
}
