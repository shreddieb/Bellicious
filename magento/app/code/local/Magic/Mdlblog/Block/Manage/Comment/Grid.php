<?php

class Magic_Mdlblog_Block_Manage_Comment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('commentGrid');
        $this->setDefaultSort('main_table.status');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('mdlblog/comment')->getCollection();
        $collection->getSelect()->joinLeft(
            array('magic_mdlblog_main' => $collection->getTable('mdlblog/mdlblog')), 'main_table.post_id=magic_mdlblog_main.post_id',
            array('magic_mdlblog_main.title')
        );

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'comment_id',
            array(
                 'header' => Mage::helper('mdlblog')->__('ID'),
                 'align'  => 'right',
                 'width'  => '50px',
                 'index'  => 'comment_id',
            )
        );

        $this->addColumn(
            'comment',
            array(
                 'header'       => Mage::helper('mdlblog')->__('Comment'),
                 'align'        => 'left',
                 'index'        => 'comment',
                 'filter_index' => 'main_table.comment',
            )
        );

        $this->addColumn(
            'user',
            array(
                 'header'       => Mage::helper('mdlblog')->__('Posted By'),
                 'width'        => '150px',
                 'index'        => 'user',
                 'filter_index' => 'main_table.user',
            )
        );


        $this->addColumn(
            'email',
            array(
                 'header'       => Mage::helper('mdlblog')->__('Email'),
                 'width'        => '150px',
                 'index'        => 'email',
                 'filter_index' => 'main_table.email',
            )
        );

        $this->addColumn(
            'created_time',
            array(
                 'header'       => Mage::helper('mdlblog')->__('Created'),
                 'align'        => 'center',
                 'width'        => '150px',
                 'type'         => 'datetime',
                 'gmtoffset'    => true,
                 'default'      => '--',
                 'filter_index' => 'main_table.created_time',
                 'index'        => 'created_time',
            )
        );

        $this->addColumn(
            'status',
            array(
                 'header'       => Mage::helper('mdlblog')->__('Status'),
                 'align'        => 'canter',
                 'width'        => '80px',
                 'index'        => 'status',
                 'type'         => 'options',
                 'filter_index' => 'main_table.status',
                 'options'      => array(
                     1 => 'Unapproved',
                     2 => 'Approved',
                 ),
            )
        );

        $this->addColumn(
            'title',
            array(
                 'header' => Mage::helper('mdlblog')->__('Post Title'),
                 'align'  => 'left',
                 'width'  => '80px',
                 'index'  => 'title',
                 'type'   => 'text'
            )
        );

       

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('main_table.comment_id');
        $this->getMassactionBlock()->setFormFieldName('comment');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                 'label'   => Mage::helper('mdlblog')->__('Delete'),
                 'url'     => $this->getUrl('*/*/massDelete'),
                 'confirm' => Mage::helper('mdlblog')->__('Are you sure?'),
            )
        );

        $this->getMassactionBlock()->addItem(
            'approve',
            array(
                 'label'   => Mage::helper('mdlblog')->__('Approve'),
                 'url'     => $this->getUrl('*/*/massApprove'),
                 'confirm' => Mage::helper('mdlblog')->__('Are you sure?'),
            )
        );

        $this->getMassactionBlock()->addItem(
            'unapprove',
            array(
                 'label'   => Mage::helper('mdlblog')->__('Unapprove'),
                 'url'     => $this->getUrl('*/*/massUnapprove'),
                 'confirm' => Mage::helper('mdlblog')->__('Are you sure?'),
            )
        );
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}