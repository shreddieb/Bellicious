<?php
class Mdl_Mdltestimonials_Block_Mdltestimonials extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getMdltestimonials()     
     { 
        if (!$this->hasData('mdltestimonials')) {
            $this->setData('mdltestimonials', Mage::registry('mdltestimonials'));
        }
        return $this->getData('mdltestimonials');
        
    }
}