<?php

class Mdl_Mdlnavi_Model_Category_Attribute_Source_Selectcol extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = array(
				array(
					'value' => 1,
					'label' => Mage::helper('catalog')->__('1'),
				),
				array(
					'value' => 2,
					'label' => Mage::helper('catalog')->__('2'),
				),
				array(
					'value' => 3,
					'label' => Mage::helper('catalog')->__('3'),
				),
				array(
					'value' => 4,
					'label' => Mage::helper('catalog')->__('4'),
				),
				array(
					'value' => 5,
					'label' => Mage::helper('catalog')->__('5'),
				)
			);
		}
		return $this->_options;
	}
}
