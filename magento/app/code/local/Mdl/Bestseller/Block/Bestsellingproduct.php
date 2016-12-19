<?php
class Mdl_Bestseller_Block_Bestsellingproduct extends Mage_Catalog_Block_Product_Abstract
{
    public function getProductsLimit() 
    { 	
		return Mage::helper('bestsellingproduct')->getBestsellingNoProduct();
    }	
	
    public function getProductCollectionInitial()
    { 
        $storeId    = Mage::app()->getStore()->getId();
		$visibility = array(
				Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
				Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
				);	
		$products = Mage::getResourceModel('reports/product_collection')->addAttributeToSelect('*')
		->addOrderedQty();
		//->addAttributeToFilter('visibility', $visibility);
		//->setOrder('ordered_qty', 'desc');
		$pageSize = Mage::helper('bestsellingproduct')->getBestsellingNoProduct();

		//$products = Mage::getModel('sales/order')->getCollection();
		$filters = Mage::helper('bestsellingproduct')->getBestsellingFilters();
				if($filters==1)
				{
					$products->setOrder('ordered_qty', 'asc');
				}
				else if($filters==2)
				{
					$products->setOrder('ordered_qty', 'desc');
				}
				else if($filters==3)
				{
					$products->getSelect()->order('rand()');
				}
				else
				{
					$products->setOrder('ordered_qty', 'desc');
				}
				$products->setPageSize($pageSize);
		return $products; 
    }
	
	public function getProductCollection()
    {		
		$storeId = Mage::app()->getStore()->getId();	
		$productCollection = $this->getProductCollectionIni();
		
		//echo count($productCollection); die;
		$sameProduct = array(); 
 		$checkedProducts = new Varien_Data_Collection();		
		foreach($productCollection as $key => $prod) { 			
			
			$parentId = $this->getParentId($prod);
			
			if($parentId == '') {
				continue; 
			}
						
			$product = Mage::getModel('catalog/product')->setStoreId($storeId)->load($this->getParentId($prod));			
			
			// if the product is not visible or is disabled
			if(!$product->isVisibleInCatalog()) {							
				continue; 
			}
			
			// if two or more simple products of the same configurable product are ordered
			if(in_array($product->getId(),$sameProduct)) {							
				continue; 
			}
			
			$sameProduct[] = $product->getId();
			
			if (!$checkedProducts->getItemById($parentId)) {
				$checkedProducts->addItem($product);			
			}
			
			if(count($checkedProducts) >= $this->getProductsLimit()) {
				break;
			}
		}
		$productCollection = $checkedProducts; 
		//echo "<pre>"; print_r(count($checkedProducts)); exit; 
		return $productCollection; 

	}
	
	/*New Function to get bestseller products*/
	public function getProductCollectionIni()
    {
        $storeId = (int) Mage::app()->getStore()->getId();
 
        // Date
        $date = new Zend_Date();
        $toDate = $date->setDay(1)->getDate()->get('Y-MM-dd');
        $fromDate = $date->subMonth(48)->getDate()->get('Y-MM-dd');
		$pageSize = Mage::helper('bestsellingproduct')->getBestsellingNoProduct();
		
		$collection = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
           ;
			$filters = Mage::helper('bestsellingproduct')->getBestsellingFilters();
				if($filters==1)
				{
					$collection->setOrder('ordered_qty', 'asc');
				}
				else if($filters==2)
				{
					$collection->setOrder('ordered_qty', 'desc');
				}
				else if($filters==3)
				{
					$collection->getSelect()->order('rand()');
				}
				else
				{
					$collection->setOrder('ordered_qty', 'desc');
				}
			$collection->setPageSize($pageSize);
 
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
		// Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
		//echo $collection->getSelect(); die;
        return $collection;
    }
	
	/*End new function*/
	
	public function getParentId($product)
	{
		$parentId = '';
				
		// if the product visibility is not set to "Nowhere"
		// i.e. if the product is visible
		if($product->getVisibility() != '1') {
			$parentId = $product->getId(); 
			
			/* $parentIdArray = $product->loadParentProductIds()->getData('parent_product_ids');
			echo $product->getId(); 
			print_r($parentIdArray); 
			echo "***********<br/>"; */
		}
		else {
			// get parent id if the product is not visible
			// this means that the product is associated with a configurable product
			$parentIdArray = $product->loadParentProductIds()->getData('parent_product_ids');
			
			/* echo $product->getId(); 
			print_r($parentIdArray); 
			echo "***********<br/>"; */
			
			if(!empty($parentIdArray)) {
				$parentId = $parentIdArray[0];
			}
		}		
		return $parentId; 
	}
	
	public function getTabCount()
	{
		$count=0;
		if(Mage::helper('bestsellingproduct')->getBestsellingStatus()==1)
		{
				$count=$count+1;
		}
		if(Mage::helper('bestsellingproduct')->getNewproductStatus()==1)
		{
				$count=$count+1;
		}
		if(Mage::helper('bestsellingproduct')->getFeaturedStatus()==1)
		{
				$count=$count+1;
		}
		return $count;
	}
	
	public function getTabEnable()
	{
		$tabarray=array();
		if(Mage::helper('bestsellingproduct')->getBestsellingStatus()==1)
		{
				array_push($tabarray,$this->__('Best Selling Products'));
		}
		if(Mage::helper('bestsellingproduct')->getNewproductStatus()==1)
		{
				array_push($tabarray,"New Products");
		}
		if(Mage::helper('bestsellingproduct')->getFeaturedStatus()==1)
		{
				array_push($tabarray,"Featured Product");
		}
		return $tabarray;
	}
	
	public function getTabNameEnable()
	{
		$tabNamearray=array();
		if(Mage::helper('bestsellingproduct')->getBestsellingStatus()==1)
		{
				array_push($tabNamearray,"tab-bestseller");
		}
		if(Mage::helper('bestsellingproduct')->getNewproductStatus()==1)
		{
				array_push($tabNamearray,"tab-newproduct");
		}
		if(Mage::helper('bestsellingproduct')->getFeaturedStatus()==1)
		{
				array_push($tabNamearray,"tab-featured");
		}
		return $tabNamearray;
	}
	
} 


