<?php

class Magic_Mdlblog_Block_Manage_Mdlblog_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'mdlblog';
        $this->_controller = 'manage_mdlblog';

        $this->_updateButton('save', 'label', Mage::helper('mdlblog')->__('Save Post'));
        $this->_updateButton('delete', 'label', Mage::helper('mdlblog')->__('Delete Post'));

        $this->_addButton(
            'saveandcontinue',
            array(
                 'label'   => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                 'onclick' => 'saveAndContinueEdit()',
                 'class'   => 'save',
            ),
            -100
        );

        if ($this->getRequest()->getParam('id')) {
            $this->_addButton(
                'diplicate',
                array(
                     'label'   => Mage::helper('mdlblog')->__('Duplicate Post'),
                     'onclick' => 'duplicate()',
                     'class'   => 'save'
                ),
                0
            );
        }

        $this->_formScripts[]
            = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('blog_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'post_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'post_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }

            function duplicate() {
                $(editForm.formId).action = '" . $this->getUrl('*/*/duplicate') . "';
                editForm.submit();
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('blog_data') && Mage::registry('blog_data')->getId()) {
            return Mage::helper('mdlblog')->__(
                "Edit Post '%s'", $this->escapeHtml(Mage::registry('blog_data')->getTitle())
            );
        } else {
            return Mage::helper('mdlblog')->__('Add Post');
        }
    }
}