<?php
class Mdl_Mdltestimonials_Block_Adminhtml_Mdltestimonials_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('mdltestimonials_form', array('legend'=>Mage::helper('mdltestimonials')->__('Testimonial information')));
      $data = Mage::getModel('mdltestimonials/mdltestimonials')->load( $this->getRequest()->getParam('id') );

    
	if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'multiselect',
                array(
                     'name'     => 'stores[]',
                     'label'    => Mage::helper('cms')->__('Store View'),
                     'title'    => Mage::helper('cms')->__('Store View'),
                     'required' => true,
                     'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                )
            );
        }
	
	 
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('mdltestimonials')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
	  
	   $fieldset->addField('author', 'text', array(
          'label'     => Mage::helper('mdltestimonials')->__('Author Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'author',
      ));
	      if (isset($data['filename']) && $data['filename']) {
            $data['filename'] = 'mdltestimonials' . '/' . $data['filename'];
			$data['filename'] = 'mdltestimonials' . '/' . $data['filename']; 
        }
		
		
	  $fieldset->addField('filename', 'image', array(
          'label'     => Mage::helper('mdltestimonials')->__('Author thumb'),
          'required'  => false,
          'name'      => 'filename',
		  'value'     => 'Uplaod'
	  ));

	  $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('mdltestimonials')->__('Content'),
          'title'     => Mage::helper('mdltestimonials')->__('Content'),
          'style'     => 'width:280px; height:100px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
	  
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('mdltestimonials')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('mdltestimonials')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('mdltestimonials')->__('Disabled'),
              ),
          ),
      ));
	  
     if ( Mage::registry('mdltestimonials_data') )
 {
    $form->setValues(Mage::registry('mdltestimonials_data')->getData());
  }
     
      if ( Mage::getSingleton('adminhtml/session')->getMdltestimonialsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getMdltestimonialsData());
          Mage::getSingleton('adminhtml/session')->setMdltestimonialsData(null);
      } elseif ( Mage::registry('mdltestimonials_data') ) {
          $form->setValues(Mage::registry('mdltestimonials_data')->getData());
      }
      return parent::_prepareForm();
  }
}
