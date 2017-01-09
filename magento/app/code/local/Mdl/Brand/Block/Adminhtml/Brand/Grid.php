<?php
class Mdl_Brand_Block_Adminhtml_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('brandGrid');
       $this->setDefaultSort('brand_id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('brand/brand')->getCollection();
      $this->setCollection($collection);
        /*for store view*/
        parent::_prepareCollection();
       foreach ($collection as $view) { 
        if ( $view->getStoreId() && $view->getStoreId() != 0 ) {
            $view->setStoreId(explode(',',$view->getStoreId()));
        } else {
          $view->setStoreId(array('0'));
        }
      }
      
      
    return $this;
    }
   protected function _prepareColumns()
   {
       $this->addColumn('brand_id',
             array(
                    'header' => 'ID',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'brand_id',
               ));
       $this->addColumn('brand_option_name',
               array(
                    'header' => 'Brand Name',
                    'align' =>'left',
                    'index' => 'brand_option_name',
              ));
       $this->addColumn('brand_title', array(
                    'header' => 'Brand Title',
                    'align' =>'left',
                    'index' => 'brand_title',
             ));
       
      if ( !Mage::app()->isSingleStoreMode() ) {
      $this->addColumn('store_id', array(
          'header' => Mage::helper('brand')->__('Store View'),
          'index' => 'store_id',
          'type' => 'store',
          'store_all' => true,
          'store_view' => true,
          'sortable' => true,
          'filter_condition_callback' => array($this, '_filterStoreCondition'),
      ));
      }
       
      $this->addColumn("brand_image", array(
           "header" => Mage::helper("brand")->__("Brand Banner Image"),
           "index"  => "brand_image",
           "align"  => "center",
           "filter" =>  false,
           "sortable" => false,
           "renderer" =>"Mdl_Brand_Block_Adminhtml_Renderer_Image",
           ));
      
       $this->addColumn("brand_thumbnail_image", array(
           "header" => Mage::helper("brand")->__("Brand logo Image"),
           "index"  => "brand_thumbnail_image",
           "align"  => "center",
           "filter" =>  false,
           "sortable" => false,
           "renderer" =>"Mdl_Brand_Block_Adminhtml_Renderer_Image",
           ));
      $this->addColumn('brand_position', array(
                  'header' => 'Position',
                  'align' =>'left',
                  'index' => 'brand_position',
       ));
      $this->addColumn('brand_status', array(
             'header'    => Mage::helper('brand')->__('Status'),
             'index'     => 'brand_status',
             'width'     => '110',
             'type'      => 'options',
             'options'   => array(
                 1 => 'Enabled',
                 0 => 'Disabled',
             ),
         ));
         
         
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getBrandId()));
    }
    
    
    protected function _filterStoreCondition($collection, $column)
   {  
         if ( !$value = $column->getFilter()->getValue() ) {
             return;
         }
         $this->getCollection()->addStoreFilter($value);
   }
}