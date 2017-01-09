<?php
class Mdl_Brand_Block_Adminhtml_Brand_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
        if (Mage::getSingleton('adminhtml/session')->getBrandData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getBrandData();
            Mage::getSingleton('adminhtml/session')->getBrandData(null);
        }
        elseif (Mage::registry('brand_data'))
         {
            $data = Mage::registry('brand_data')->getData();
         }
       $fieldset = $form->addFieldset('brand_form',array('legend'=>'General'));
       
       $fieldset->addField('brand_option_name', 'text',
                     array(
                          'label' => 'Brand Attribute Option Name',
                          'class' => '',
                          'required' => true,
                          'name' => 'brand_option_name',
                     ));
       
       $fieldset->addField('brand_title', 'text',
                       array(
                          'label' => 'Brand Title',
                          'class' => 'required-entry',
                          'required' => true,
                          'name' => 'brand_title',
                    ));
                    
      
       $fieldset->addField('brand_status','select',
                        array(
                             'label'    => Mage::helper('brand')->__('Status'),
                             'name'     => 'brand_status',
                             'required' => true,
                             'values'   => array(
                                 array(
                                     'value' => 1,
                                     'label' => Mage::helper('brand')->__('Enabled'),
                                 ),
                                 array(
                                     'value' => 0,
                                     'label' => Mage::helper('brand')->__('Disabled'),
                                 ),
                             ),
                        )
                    );
       
        $fieldset->addField('brand_position', 'text',
                       array(
                          'label' => 'Brand Position',
                          'class' => 'validate-digits input-text',
                          'required' => true,
                          'name' => 'brand_position',
                    ));
        if (!Mage::app()->isSingleStoreMode()) {
        $fieldset->addField('store_id', 'multiselect',
                            array(
        'name' => 'stores[]',
        'label' => Mage::helper('brand')->__('Store View'),
        'title' => Mage::helper('brand')->__('Store View'),
        'required' => true,
        'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
               ));
           } else {
               $fieldset->addField('store_id', 'hidden', array(
                   'name' => 'stores[]',
                   'value' => Mage::app()->getStore(true)->getId(),
               ));
           }
                   
      $fieldset->addField('brand_image', 'image', array(
                 'label'     => 'Brand Banner Image',
                 'name'      => 'brand_image',
                 'value'  => 'Uplaod'
               ));
      
      $fieldset->addField('brand_thumbnail_image', 'image', array(
                 'label'     => 'Brand logo Image',
                 'name'      => 'brand_thumbnail_image',
                 'value'  => 'Uplaod'
               ));
      
      $fieldset->addField('brand_description', 'textarea', array(
                'label'     => Mage::helper('brand')->__('Brand Description'),
                'class'     => '',
                'required'  => false,
                'name'      => 'brand_description',
                'value'     => '<b><b/>',
                'disabled'  => false,
                'after_element_html' => '<small>Enter brand description here</small>',
                'tabindex'  => 1
                
              ));

 if ( Mage::registry('brand_data') )
 {
    $form->setValues(Mage::registry('brand_data')->getData());
  }
  
  
   if ( Mage::getSingleton('adminhtml/session')->getBrandData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getBrandData());
          Mage::getSingleton('adminhtml/session')->getBrandData(null);
      } elseif ( Mage::registry('brand_data') ) {
          $form->setValues(Mage::registry('brand_data')->getData());
      }
  return parent::_prepareForm();
 }
}
