<?php

class Mdl_Brand_Model_Brand extends Mage_Core_Model_Abstract
{
	
	 protected $_eventPrefix = 'brand'; 
    protected $_eventObject = 'brand';
    protected function _construct(){

       $this->_init("brand/brand");
	   

    }
	
	
	
}
	 