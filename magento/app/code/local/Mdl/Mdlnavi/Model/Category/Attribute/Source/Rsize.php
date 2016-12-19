<?php

class Mdl_Mdlnavi_Model_Category_Attribute_Source_Rsize extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = array(
				array(
					'value' => 1,
					'label' => Mage::helper('catalog')->__('25%'),
				),
				array(
					'value' => 2,
					'label' => Mage::helper('catalog')->__('50%'),
				),
				array(
					'value' => 3,
					'label' => Mage::helper('catalog')->__('75%'),
				),
				array(
					'value' => 4,
					'label' => Mage::helper('catalog')->__('100%'),
				)
			);
		}
		return $this->_options;
	}
}
