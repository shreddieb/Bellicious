<?php

class Magic_Mdlblog_Block_Manage_Cat extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'manage_cat';
        $this->_blockGroup = 'mdlblog';
        $this->_headerText = Mage::helper('mdlblog')->__('MDL Category List');
        parent::__construct();
    }
}