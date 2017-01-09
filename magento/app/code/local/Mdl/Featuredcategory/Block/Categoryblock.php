<?php
class Mdl_Featuredcategory_Block_Categoryblock extends Mage_Core_Block_Template
{
    /* to get categories Collection */
	
	 public function __construct()
    {       
        $this->_controller = 'featured';
        $this->_blockGroup = 'featuredcategory';
        $this->_headerText = 'Featured Category Manager';
        parent::__construct();
        $this->setTemplate('featuredcategory/categoryform.phtml');
    }
	
	public function getLoadedCategories()
	{   
	      $websites = Mage::app()->getWebsites();
		  $store=Mage::app()->getRequest()->getParam('store');
		  if(!$store)
		  {
			$store=0;
			$storeModel=Mage::getModel('core/store')->load($store);
			$rootcatId= $storeModel->getRootCategoryId();
		    $categories = Mage::getModel('catalog/category')->getCategories($rootcatId);
		  }else
		  {
			
			$storeModel=Mage::getModel('core/store')->load($store);
			$rootcatId=$storeModel->getRootCategoryId();
			
			
			$categories = Mage::getModel('catalog/category')->getCategories($rootcatId);
		  }
		 return $categories;
	}

   public function getLoadedFeaturedCat()
   {  /* return fettured category id array to featuredcat.phtml */
	  
	  $featured=Mage::getModel('featuredcategory/featured')->getCollection()->getFirstItem()->getData();
	 
	  $featuredData=json_decode($featured['featured_category'],true);
	  $storeId=$this->getStoreId();
	
      if($featuredData['featured'])
       {  
		    foreach($featuredData['featured'] as $key=>$value)
			{  
				 if($value['store_id']==$storeId)
				{  
					 $featuredCatIds=$featuredData['featured'][$key]['featured_category'];
					 break;
				}
				
			}
			 return $featuredCatIds ;
		
	   }
	   else
	   {   /* if there is no row in database return an empty array */
	       $featuredCatIds=array();
		   return $featuredCatIds ;
	   }
   
   }
	  
   public function childCategory()
	{
	
        $store=$this->getStoreId();
        $storeModel=Mage::getModel('core/store')->load($store);
		$rootcatId= $storeModel->getRootCategoryId();
		$rootCategory = Mage::getModel('catalog/category')->load($rootcatId);
		return $rootCategory;

	}
 
	public function getStoreId()
	{
		$store=Mage::app()->getRequest()->getParam('store');
		if(!$store)
		{
		   $store=0;
		}
		 return $store;
			
	   
	}
	
	public function getLoadedFeaturedCatFront()
   {  /* return fettured category id array to featuredcat.phtml */
	  
	  $featured=Mage::getModel('featuredcategory/featured')->getCollection()->getFirstItem()->getData();
	 
	  $featuredData=json_decode($featured['featured_category'],true);
	  $storeId=Mage::app()->getStore()->getId();
	  
      if($featuredData['featured'])
       {  
		    foreach($featuredData['featured'] as $key=>$value)
			{  
				 if($value['store_id']==$storeId)
				{  
					 $featuredCatIds=$featuredData['featured'][$key]['featured_category'];
					 break;
				}
				
			}
			 return $featuredCatIds ;
		
	   }
	   else
	   {   /* if there is no row in database return an empty array */
	       $featuredCatIds=array();
		   return $featuredCatIds ;
	   }
   
   }
}
?>