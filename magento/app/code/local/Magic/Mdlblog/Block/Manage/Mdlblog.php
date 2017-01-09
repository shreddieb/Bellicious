<?php

class Magic_Mdlblog_Block_Manage_Mdlblog extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'manage_mdlblog';
        $this->_blockGroup = 'mdlblog';
        $this->_headerText = Mage::helper('mdlblog')->__('Blog Post Manager');
        parent::__construct();
        $this->setTemplate('magic_mdlblog/posts.phtml');
    }

    protected function _prepareLayout()
    {
        $addButtonBlock = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(
                array(
                     'label'   => Mage::helper('mdlblog')->__('Add Post'),
                     'onclick' => "setLocation('" . $this->getUrl('*/*/new') . "')",
                     'class'   => 'add',
                )
            )
        ;
        $this->setChild('add_new_button', $addButtonBlock);

        /**
         * Display store switcher if system has more one store
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $storeSwitcherBlock = $this->getLayout()->createBlock('adminhtml/store_switcher')
                ->setUseConfirm(false)
                ->setSwitchUrl($this->getUrl('*/*/*', array('store' => null)))
            ;
            $this->setChild('store_switcher', $storeSwitcherBlock);
        }
        $this->setChild('grid', $this->getLayout()->createBlock('mdlblog/manage_mdlblog_grid', 'mdlblog.grid'));
        return parent::_prepareLayout();
    }

    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_new_button');
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

    public function getStoreSwitcherHtml()
    {
        return $this->getChildHtml('store_switcher');
    }
}