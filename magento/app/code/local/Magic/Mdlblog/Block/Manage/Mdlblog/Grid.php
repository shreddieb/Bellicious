<?php

class Magic_Mdlblog_Block_Manage_Mdlblog_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('blogGrid');
        $this->setDefaultSort('created_time');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getStore()
    {
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('mdlblog/mdlblog')->getCollection();
        $store = $this->_getStore();
        if ($store->getId()) {
            $collection->addStoreFilter($store);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'post_id',
            array(
                 'header' => Mage::helper('mdlblog')->__('ID'),
                 'align'  => 'right',
                 'width'  => '50px',
                 'index'  => 'post_id',
            )
        );

        $this->addColumn(
            'title',
            array(
                 'header' => Mage::helper('mdlblog')->__('Title'),
                 'align'  => 'left',
                 'index'  => 'title',
            )
        );

        $this->addColumn(
            'identifier',
            array(
                 'header' => Mage::helper('mdlblog')->__('Identifier'),
                 'align'  => 'left',
                 'index'  => 'identifier',
            )
        );

        $this->addColumn(
            'user',
            array(
                 'header' => Mage::helper('mdlblog')->__('Posted By'),
                 'width'  => '150px',
                 'index'  => 'user',
            )
        );

        $this->addColumn(
            'created_time',
            array(
                 'header'    => Mage::helper('mdlblog')->__('Created at'),
                 'index'     => 'created_time',
                 'type'      => 'datetime',
                 'width'     => '120px',
                 'gmtoffset' => true,
                 'default'   => ' -- '
            )
        );

        $this->addColumn(
            'update_time',
            array(
                 'header'    => Mage::helper('mdlblog')->__('Updated at'),
                 'index'     => 'update_time',
                 'width'     => '120px',
                 'type'      => 'datetime',
                 'gmtoffset' => true,
                 'default'   => ' -- '
            )
        );

        $this->addColumn(
            'status',
            array(
                 'header'  => Mage::helper('mdlblog')->__('Status'),
                 'align'   => 'left',
                 'width'   => '80px',
                 'index'   => 'status',
                 'type'    => 'options',
                 'options' => array(
                     1 => Mage::helper('mdlblog')->__('Enabled'),
                     2 => Mage::helper('mdlblog')->__('Disabled'),
                     3 => Mage::helper('mdlblog')->__('Hidden'),
                 ),
            )
        );

        $this->addColumn(
            'action',
            array(
                 'header'    => Mage::helper('mdlblog')->__('Action'),
                 'width'     => '100',
                 'type'      => 'action',
                 'getter'    => 'getId',
                 'actions'   => array(
                     array(
                         'caption' => Mage::helper('mdlblog')->__('Edit'),
                         'url'     => array('base' => '*/*/edit'),
                         'field'   => 'id',
                     )
                 ),
                 'filter'    => false,
                 'sortable'  => false,
                 'index'     => 'stores',
                 'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('post_id');
        $this->getMassactionBlock()->setFormFieldName('mdlblog');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                 'label'   => Mage::helper('mdlblog')->__('Delete'),
                 'url'     => $this->getUrl('*/*/massDelete'),
                 'confirm' => Mage::helper('mdlblog')->__('Are you sure?'),
            )
        );

        $statuses = Mage::getSingleton('mdlblog/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                 'label'      => Mage::helper('mdlblog')->__('Change status'),
                 'url'        => $this->getUrl('*/*/massStatus', array('_current' => true)),
                 'additional' => array(
                     'visibility' => array(
                         'name'   => 'status',
                         'type'   => 'select',
                         'class'  => 'required-entry',
                         'label'  => Mage::helper('mdlblog')->__('Status'),
                         'values' => $statuses,
                     )
                 )
            )
        );
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}