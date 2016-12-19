<?php

class Magic_Mdlblog_Block_Manage_Mdlblog_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('blog_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('mdlblog')->__('MDL Blog'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                 'label'   => Mage::helper('mdlblog')->__('MDL Blog Form'),
                 'title'   => Mage::helper('mdlblog')->__('MDL Blog Form'),
                 'content' => $this->getLayout()->createBlock('mdlblog/manage_mdlblog_edit_tab_form')->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }
}