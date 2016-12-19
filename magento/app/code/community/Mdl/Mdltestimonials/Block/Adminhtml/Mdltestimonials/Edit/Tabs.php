<?php

class Mdl_Mdltestimonials_Block_Adminhtml_Mdltestimonials_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('mdltestimonials_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('mdltestimonials')->__('Testimonials Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('mdltestimonials')->__('Testimonial Information'),
          'title'     => Mage::helper('mdltestimonials')->__('Testimonial Information'),
          'content'   => $this->getLayout()->createBlock('mdltestimonials/adminhtml_mdltestimonials_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}