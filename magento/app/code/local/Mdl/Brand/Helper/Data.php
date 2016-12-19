<?php
class Mdl_Brand_Helper_Data extends Mage_Core_Helper_Abstract
{
   /*
    *
    * Brand attribute code
    *
    */
	
	  const BRAND_ATTRIBUTE= 'brand';
	  const BRAND_PARAM= 'brand';
	  const CONFIG_SECTION='brand';
	  
	 
	/*
	 *
	 *
	 *
	 */
    public function deleteImageFile($image)
    {
        if (!$image){
			 return;
		}
	 
	   $brand_image_path = Mage::getBaseDir('media') . DS . $image;
	  
	   if (!file_exists($brand_image_path)) {
		   return;
	   }
	   
       try {
		  unlink($brand_image_path);
	   } catch (Exception $exc) {
		   echo $exc->getTraceAsString();
	   }
    }
		   
	/*
	 *
	 *
	 *
	 */	   
    public function getImageNewName($imagename)
    {
       $image_parts = pathinfo($imagename);
       $image_name=  $image_parts[filename];
	   $image_ext=  $image_parts[extension];
	   $image_name = str_replace(' ', '_', $image_name);
	   $image_new_name=$image_name.'_'.time().'.'.$image_ext;
	   
	   return $image_new_name;
    }
		   
    public function uploadImageFile($imagename,$imagefield)
    {
			
	   $uploader = new Varien_File_Uploader($imagefield);
	   
	   $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
	   
       $uploader->setAllowRenameFiles(false);
	   
	   $uploader->setFilesDispersion(false);
	   $path='';
	   if($imagefield=='brand_image'){ 
	      $path = Mage::getBaseDir('media') . '/mdl-brand/';
	   }else if($imagefield=='brand_thumbnail_image')
	   {
			$path = Mage::getBaseDir('media') .'/mdl-brand/thumb/';  
	   
	   }
	   
	   $uploader->save($path, $imagename);
	   
	   return;
      }
		   
		   
    public function getBrandImage($image)
    {
	   if($image)
	   return Mage::getBaseUrl('media') . '/' .$image;
	   return '';
    }
		   
		   
	public function getBrandUrl($brnadOptionName)
	{
	   
	     $brandOptionValue='';
	   
	   if($brnadOptionName)
	   {
	      $brandOptionValue=$this->_getBrandOptionValue($brnadOptionName);
		  $brandParam=Mage::helper('brand/data')->getBrandParam();
		  return Mage::getUrl('brands/').'?'.$brandParam.'='.$brandOptionValue;
       }
	   return '';

    }
		   
		   
    public function getAvailableOrders()
    {
	   return array(// attribute name => label to be used
					//'price' => $this->__('Price')
					);
    }
		
    /**
	* Return product collection to be displayed by our list block
	*
	* @return Mage_Catalog_Model_Resource_Product_Collection
	*/
	public function getProductCollection()
	{     
        $brandParam=Mage::helper('brand/data')->getBrandParam();
        $optionName=Mage::app()->getRequest()->getParam($brandParam); //echo $optionName;
		//print_r(Mage::app()->getRequest()->getParams());
		if($optionName!=''){ 
	        $collection=$this->_getInitialBrandProducts($optionName);
	        return  $collection;
	     }
		 
		 return Null;
     }
     
	 /*
	  *
	  * get product collectiom by barnad name
	  *
	  */
    protected function  _getInitialBrandProducts($optionName)
    {
			  
        $AttributeName = self::BRAND_ATTRIBUTE;
	    $store_id=Mage::app()->getStore()->getId();
	       
	    /*
		 *
		 * Brand product Collection all Visibility
		 * parentIds holds all visiable simple product id and it's parent product id
	     *  
		 */
	      $collection = Mage::getModel('catalog/product')->getCollection()
					   ->setStoreId($store_id)->addStoreFilter($store_id)->addAttributeToSelect('*')
					   ->addFieldToFilter($AttributeName,array('eq' => Mage::getResourceModel('catalog/product')->getAttribute($AttributeName)
																	   ->getSource()->getOptionId($optionName)))
					   ->addAttributeToFilter('status', array('eq' => 1));
	   
		   
	      $parentIds=array();
				
	      foreach($collection as $product)
	      {        
		       if($product->getTypeId()!='simple' && $product->getVisibility()!=1){      
				     $parentIds[]=$product->getId();
			     }else if($product->getTypeId()=='simple' && $product->getVisibility()!=1){
				      $parentIds[]=$product->getId();
				      $parentIds=$this->_getParentId($product,$parentIds);
			     } 
				      else {    
						    $parentIds=$this->_getParentId($product,$parentIds);
		         }
          }
			
	    /*
	     * remove duplictes id if two or more product has same parrent
	     *
	     */  
	     $parentIds=array_unique($parentIds);
		   
		 $collection = Mage::getModel('catalog/product')->getCollection()
		 ->setStoreId($store_id)->addStoreFilter($store_id)->addAttributeToSelect('*')
		 ->addAttributeToFilter('entity_id', array('in' => $parentIds));
		 
		 return $collection;
    }        
			  
	   
	   /*
	    *
	    * get parent product id by its associative product
	    * 	   
	    **/
    protected function _getParentId($product,$parentIds)
    {
        $parentId = Mage::getModel('catalog/product_type_grouped')->getParentIdsByChild($product->getId()); 
			  if(!$parentId)
			  $parentId = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($product->getId());
			  $parentIds=array_merge($parentIds, $parentId);
			  return $parentIds;
    }
	
	
	protected function _getBrandOptionValue($optionName)
	{
	   return Mage::getResourceModel('catalog/product')->getAttribute(self::BRAND_ATTRIBUTE)
																	   ->getSource()->getOptionId($optionName);
	   
	}
	
	public function getStoreConfig()
	{  
	   return Mage::getStoreConfig(self::CONFIG_SECTION,Mage::app()->getStore()->getId());
	}
	
	public function resizeImage($imagepath, $width=NULL, $height=NULL)
    {         
	      $path_parts = pathinfo($imagepath);
	      $imageName=$path_parts['basename'];
		  $dirname=$path_parts['dirname'];
		   /*
		    * sub dir= get path after media
		    */
		  list($first, $subdir) = explode('media', $dirname);
           
	  $subdir = str_replace('\\', '/', $subdir);
	  $subdir = str_replace('//', '/', $subdir);
	  $imagePathFull =  Mage::getBaseDir('media') .$subdir. DS . $imageName;
      /*  new code */ 
		$config=$this->getStoreConfig();
		$isResize=$config['frontend']['resize_image']; 
		if(!$isResize)
		{
		  
		 return Mage::getBaseUrl("media") .$subdir. '/'. $resizePath . '/' . $imageName;
		}
			/*  new code end */ 
	     $height=$height ? $height : 100;
         $width=$width ? $width : 100;
		$resizePath = $width . 'x' . $height;
		$resizePathFull = Mage::getBaseDir('media').$subdir. '/' .$resizePath. '/' . $imageName;
		 	
	if (file_exists($imagePathFull) && !file_exists($resizePathFull)) { 
		$imageObj = new Varien_Image($imagePathFull);
		$imageObj->constrainOnly(TRUE);
		$imageObj->keepAspectRatio(false);
		$imageObj->resize($width,$height);
		$imageObj->save($resizePathFull);
	}
			

	return Mage::getBaseUrl("media") .$subdir. "/" . $resizePath . "/" . $imageName;
   }
   
   public function getAttributeOptionName($optionValue)
   {
	 
	 return Mage::getResourceModel('catalog/product')->getAttribute(self::BRAND_ATTRIBUTE)
																	   ->getSource()->getOptionText($optionValue);
	
   }
   
    public function getAttributeOptionValue($optionName)
    {
	 
	 return $this->_getBrandOptionValue($optionName);
	
    }
   public function isEnabled()
   {
	  $config=$this->getStoreConfig(); 
	   if($config['general']['enable'])
	   {
		
		return true;
	   }
	
     return false;
   }
   
   public function getBrandParam()
   {
      return self::BRAND_PARAM;
   }
   /*     new added start                              */
   public function getBrandByOption($brandOptionValue=null)
   {
	    $brandHtml='';
		if($brandOptionValue==null) return $brandHtml;
	   
		$brandOptionName=$this->getAttributeOptionName($brandOptionValue);
		if($brandOptionName){
			$brands=Mage::getModel('brand/brand')->getCollection()->addFieldToFilter('brand_option_name',$brandOptionName);
			$brand=$brands->getFirstItem();
		      if(count($brands)){ 
		          $imageUrl= str_replace(array('/\\','\\'),array('/','/'),$this->getBrandImage($brand->getBrandThumbnailImage()));
		          $brandHtml.='<a href="'.$this->getBrandUrl($brand->getBrandOptionName()).'"><img src="'.$imageUrl.'" alt="'.$brandOptionName.'"/></a>';
		        }
		}
		return $brandHtml;
   }
   
   public function getBrandById($Id=null)
   {
	
	    $brandHtml='';
		if($Id==null) return $brandHtml;
	      
		$product=Mage::getModel('catalog/product')->load($Id);
		if($product->getTypeId()!='configurable'){
			return $brandHtml;
		  }
		  
		$brandOptionValue=$this->_getChildOptionName($product);
		
		$brandOptionName=$this->getAttributeOptionName($brandOptionValue);
		if($brandOptionName){
			$brands=Mage::getModel('brand/brand')->getCollection()->addFieldToFilter('brand_option_name',$brandOptionName);
			$brand=$brands->getFirstItem();
		     
			if(count($brands)){ 
		         $imageUrl=$this->getBrandImage($brand->getBrandThumbnailImage());
		         $brandHtml.='<a href="'.$this->getBrandUrl($brand->getBrandOptionName()).'"><img src="'.$imageUrl.'" alt="'.$brandOptionName.'"/></a>';
		    }
		}
		return $brandHtml;
	
   }
   
   protected function _getChildOptionName($product)
    {
		$brandOptionValue='';
        $ChildIds = $product->getTypeInstance()->getUsedProductIds(); 
        foreach ($ChildIds as $id){
            $simpleProduct = Mage::getModel('catalog/product')->load($id);
	        $brandOptionValue=$simpleProduct->getData('brand');
	        if($brandOptionValue){
			    break;
			}
        }
      return  $brandOptionValue;
   
    }
	public function switchTemplate()
	{
		 $tempConfig = Mage::getStoreConfig('mdlpump/item_view/itemviewbox');

		if($tempConfig==1)
		{
			return 'catalog/product/list.phtml';
		}
		elseif($tempConfig==2) {
			return 'catalog/product/product-type/type2.phtml';
		}
		elseif($tempConfig==3) {
			return 'catalog/product/product-type/type3.phtml';
		 }
		elseif($tempConfig==4) {
			return 'catalog/product/product-type/type4.phtml';
		 }
		elseif($tempConfig==5) {
			return 'catalog/product/product-type/type5.phtml';
		 } 
	}
	
}
	   
			