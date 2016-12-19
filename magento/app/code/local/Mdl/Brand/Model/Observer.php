<?php

class Mdl_Brand_Model_Observer extends Mage_Core_Model_Abstract
{
    public function saveAttributeBrandOptions(Varien_Event_Observer $observer)
	{  
          $old_option_value='';
		  $object = $observer->getEvent()->getDataObject();
	       if(!$object->isObjectNew())
		     {  
			    //$old_option_value = Mage::getSingleton('core/session')->getOptionName(); 
				 $old_option_value=Mage::getSingleton('core/session')->getOldBrandOptionName();
			 }
					
	  
        $brand=$observer->getEvent()->getData('brand');
		$option_value=$brand->getBrandOptionName();
		//echo $old_option_value;
		//echo $option_value;
		
          $brandParam=Mage::helper('brand/data')->getBrandParam();
          $this->_addAttributeValue($brandParam,$option_value,$old_option_value);
		  Mage::getSingleton('core/session')->unsOldBrandOptionName();
    
    }
    
    
    
    
     protected function _addAttributeValue($arg_attribute, $arg_value,$old_option_value)
    {
        $attribute_model        = Mage::getModel('eav/entity_attribute');

        $attribute_code         = $attribute_model->getIdByCode('catalog_product', $arg_attribute);
        $attribute              = $attribute_model->load($attribute_code);
       
        if(!$this->_attributeValueExists($arg_attribute, $arg_value))
        { 
		    
             /*to update option if option is alreay exist */
			if($old_option_value!='' || $arg_value!=$old_option_value)
			{
				
				 $optionId= $this->_attributeValueExists($arg_attribute, $old_option_value);
				
				  $data = array();
				  /*
				   *   $optionId is the option_id of the option in 'eav_attribute_option_value' table
				   *   0 is current store id,
				   *   $arg_value is the new label for the option
				   *   $option_value is option value that we want to update in place of $old_option_value
				   */
				  $values = array($optionId => array(0 => $arg_value,1=> $arg_value ));
                  $data['option']['value'] = $values;
                  $attribute->addData($data);
                  $attribute->save();

			}
			else /*Add new option*/
			{
				
			 
			$value['option'] = array($arg_value,$arg_value);
			$result = array('value' => $value);
            $attribute->setData('option',$result);
            $attribute->save();
		    }
        }
		
	

		$attribute_options_model= Mage::getModel('eav/entity_attribute_source_table') ;
        $attribute_table        = $attribute_options_model->setAttribute($attribute);
        $options                = $attribute_options_model->getAllOptions(false);

        foreach($options as $option)
        {
            if ($option['label'] == $arg_value)
            {
                return $option['value'];
            }
        }
       return false;
    }
	Protected function _attributeValueExists($arg_attribute, $arg_value)
    {
        $attribute_model        = Mage::getModel('eav/entity_attribute');
        $attribute_options_model= Mage::getModel('eav/entity_attribute_source_table') ;

        $attribute_code         = $attribute_model->getIdByCode('catalog_product', $arg_attribute);
        $attribute              = $attribute_model->load($attribute_code);

        $attribute_table        = $attribute_options_model->setAttribute($attribute);
        $options                = $attribute_options_model->getAllOptions(false);

        foreach($options as $option)
        {
            if ($option['label'] == $arg_value)
            {
                return $option['value'];
            }
        }

        return false;
    }
	public function DeleteAttributeBrandOptions(Varien_Event_Observer $observer)
	{    
		$brandDetails=$observer->getEvent()->getData('branddetails');
		$brandOptionName=$brandDetails['brand_option_name'];
		
		if($brandOptionName)
		{
			 $this->_deleteAttributeOptionByOptionName($brandOptionName);
		}
		
	}
	protected function _deleteAttributeOptionByOptionName($brandOptionName)
	{
		
		$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
        $attribute  = Mage::getSingleton("eav/config")->getAttribute("catalog_product", "brand");

            $updates = array();
			$label='';
			$value='';
			foreach ($attribute->getSource()->getAllOptions() as $option) {
				 
				   $label=$option['label'];  /* label */
				   $value=$option['value']; /* option Id */
				   if($label==$brandOptionName)
				   {
					   
					$updates['delete'][$value] = true; 
					$updates['value'][$value] = true;
			
				   }
			}

		$setup->addAttributeOption($updates);
	}
}
	 