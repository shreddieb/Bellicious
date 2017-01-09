<?php 
class Mdl_Bestseller_Block_Newproduct extends Mage_Catalog_Block_Product_Abstract
{
    protected $_productsCount = null;

    const DEFAULT_PRODUCTS_COUNT = 5;

    public function getProductCollection()
    {
      /*  $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        
        $collection = Mage::getResourceModel('catalog/product_collection');
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        
        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate))
            ->addAttributeToFilter('news_to_date', array('or'=> array(
                0 => array('date' => true, 'from' => $todayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->addAttributeToSort('news_from_date', 'desc')
            ->setPageSize($this->getProductsCount())			
            ->setCurPage(1)
        ; */
		 $pageSize = Mage::helper('bestsellingproduct')->getNewproductNoProduct();
		$todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

		$_productCollection=$this->getLoadedProductCollection();
		$_productCollection = Mage::getResourceModel('catalog/product_collection')
		->addAttributeToSelect('*')
		->addStoreFilter()
		->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate))
		->addAttributeToFilter('news_to_date', array('or'=> array(
		0 => array('date' => true, 'from' => $todayDate),
		1 => array('is' => new Zend_Db_Expr('null')))
		), 'left')
		->addAttributeToFilter(
    'status',
    array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
	)
        ->addAttributeToFilter(
    'visibility',
    array('eq' =>4)
	);
	Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($_productCollection);
       // Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        //Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($_productCollection);
		$filters = Mage::helper('bestsellingproduct')->getNewproductFilters();
		if($filters==1)
		{
			$_productCollection->setOrder('entity_id', 'asc');
		}
		else if($filters==2)
		{
			$_productCollection->setOrder('entity_id', 'desc');
		}
		else if($filters==3)
		{
			$_productCollection->getSelect()->order('rand()');
		}
		else
		{
			$_productCollection->setOrder('entity_id', 'desc');
		}
		$_productCollection->setPageSize($pageSize); 
		/*$now = date("Y-m-d");
		$newsFrom= substr($_productCollection->getData('news_from_date'),0,10);
		$newsTo=  substr($_productCollection->getData('news_to_date'),0,10);*/
		
		return $_productCollection;
		
		/* $this->setToolbar($this->getLayout()->createBlock('catalog/product_list_toolbar', 'Toolbar'));	
		$toolbar = $this->getToolbar();		
		$toolbar->setDefaultOrder('news_from_date')
		->setDefaultDirection('desc')
		->setCollection($collection);
		
		return $this; */        
    }
	
	public function setProductsTest($count)
    {
        return 'hello';
    }

    public function setProductsCount($count)
    {
        $this->_productsCount = $count;
        return $this;
    }

    public function getProductsCount()
    {
	
		if(Mage::helper('bestsellingproduct')->getNewproductNoProduct()) {
			$count = Mage::helper('bestsellingproduct')->getNewproductNoProduct();
		}
		else {
			$count = self::DEFAULT_PRODUCTS_COUNT;
		}
		
		if($count) 		
			return $count;
			
        if (null === $this->_productsCount) {
            $this->_productsCount = self::DEFAULT_PRODUCTS_COUNT;
        }
        return $this->_productsCount;
    }
	
	/* public function getToolbarHtml() {	
		return $this->getToolbar()->_toHtml();
	}
	
	public function getMode() {
		return $this->getToolbar()->getCurrentMode();
	}
	
	public function getProductCollection() {
		return $this->getToolbar()->getCollection();
	} 	 */
}
