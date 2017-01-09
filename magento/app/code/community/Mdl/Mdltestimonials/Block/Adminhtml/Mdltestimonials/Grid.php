 <?php

class Mdl_Mdltestimonials_Block_Adminhtml_Mdltestimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('mdltestimonialsGrid');
      $this->setDefaultSort('mdltestimonials_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('mdltestimonials/mdltestimonials')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('mdltestimonials_id', array(
          'header'    => Mage::helper('mdltestimonials')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'mdltestimonials_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('mdltestimonials')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));

      
      $this->addColumn('status', array(
          'header'    => Mage::helper('mdltestimonials')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('mdltestimonials')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('mdltestimonials')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('mdltestimonials')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('mdltestimonials')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('mdltestimonials_id');
        $this->getMassactionBlock()->setFormFieldName('mdltestimonials');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('mdltestimonials')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('mdltestimonials')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('mdltestimonials/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('mdltestimonials')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('mdltestimonials')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}