<?php

class Mdl_Mdlnavi_Model_Category_Attribute_Source_Labelcolor extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = array(
				array(
					'value' => 'red	',
					'label' => Mage::helper('catalog')->__('Red'),
				),
				array(
					'value' => 'yellow',
					'label' => Mage::helper('catalog')->__('Yellow'),
				),
				array(
					'value' => 'green',
					'label' => Mage::helper('catalog')->__('Green'),
				),
			);
		}
		return $this->_options;
	}
}
