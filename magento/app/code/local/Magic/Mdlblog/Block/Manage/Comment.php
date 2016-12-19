<?php

class Magic_Mdlblog_Block_Manage_Comment extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'manage_comment';
        $this->_blockGroup = 'mdlblog';
        $this->_headerText = Mage::helper('mdlblog')->__('MDL Blog Comment');
        parent::__construct();
        $this->setTemplate('magic_mdlblog/comments.phtml');
    }

    protected function _prepareLayout()
    {
        $this->_removeButton('add');
        return parent::_prepareLayout();
    }
}