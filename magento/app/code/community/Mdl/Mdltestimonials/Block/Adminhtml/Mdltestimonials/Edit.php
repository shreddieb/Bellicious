<?php

class Mdl_Mdltestimonials_Block_Adminhtml_Mdltestimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'mdltestimonials';
        $this->_controller = 'adminhtml_mdltestimonials';
        
        $this->_updateButton('save', 'label', Mage::helper('mdltestimonials')->__('Save Testimonial'));
        $this->_updateButton('delete', 'label', Mage::helper('mdltestimonials')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('mdltestimonials_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'mdltestimonials_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'mdltestimonials_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('mdltestimonials_data') && Mage::registry('mdltestimonials_data')->getId() ) {
            return Mage::helper('mdltestimonials')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('mdltestimonials_data')->getTitle()));
        } else {
            return Mage::helper('mdltestimonials')->__('Add Testimonial');
        }
    }
}