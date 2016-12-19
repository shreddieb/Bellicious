<?php
class Mdl_Brand_Block_Adminhtml_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
   
   public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'brand';
        $this->_controller = 'adminhtml_brand';
       
        $this->_updateButton('save', 'label',Mage::helper('brand')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('brand')->__('Delete'));
        $this->_addButton(
            'saveandcontinue',
            array(
                 'label'   => Mage::helper('brand')->__('Save And Continue Edit'),
                 'onclick' => 'saveAndContinueEdit()',
                 'class'   => 'save',
            ),
            -100
        );
          $this->_formScripts[]
            = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
       /* Here, we're looking if we have transmitted a form object,
          to update the good text in the header of the page (edit or add) */
   public function getHeaderText()
   {  
      if(Mage::registry('brand_data') && Mage::registry('brand_data')->getBrandId())
      { 
         return 'Edit Brand '.'"'.$this->htmlEscape(
         Mage::registry('brand_data')->getBrandTitle()).'"'.'<br />';
      }
      else
      {
         return 'Add New Brand';
      }
   }
}
