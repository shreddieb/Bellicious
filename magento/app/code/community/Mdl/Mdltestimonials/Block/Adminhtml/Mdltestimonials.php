<?php
class Mdl_Mdltestimonials_Block_Adminhtml_Mdltestimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_mdltestimonials';
    $this->_blockGroup = 'mdltestimonials';
    $this->_headerText = Mage::helper('mdltestimonials')->__('Testimonial Manager');
    $this->_addButtonLabel = Mage::helper('mdltestimonials')->__('Add Testimonials');
    parent::__construct();
  }
}