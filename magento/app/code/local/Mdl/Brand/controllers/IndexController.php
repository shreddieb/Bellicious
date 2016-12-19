<?php
class Mdl_Brand_IndexController extends Mage_Core_Controller_Front_Action
{
   
	
public function indexAction()
{
     if(!mage::helper('brand/data')->isEnabled())
	 {
		$this->_redirect('');
		
	 }
	
	$brandParam=Mage::helper('brand/data')->getBrandParam();
	$brandName=$this->getRequest()->getParam($brandParam);
	$this->loadLayout();   
	$this->getLayout()->getBlock("head")->setTitle($this->__("Brands"));
	$breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home"),
                "title" => $this->__("Home"),
                "link"  => Mage::getBaseUrl()
		   ));
    if($brandName)
	{
		$brandName=Mage::helper('brand/data')->getAttributeOptionName($brandName);
     $breadcrumbs->addCrumb($brandName, array(
                "label" => $this->__($brandName),
                "title" => $this->__($brandName),
             
		   ));
	}
	
      $this->renderLayout();
	    
		
		
	}
	
	
	public function brandajaxAction()
	{
		$data=$this->getRequest()->getParams();
		  if(!$data)
		  {
			   
			   $this->_redirect('');
		  }
		  $searchValue=trim($data['brandsearch']); 
		if($searchValue!='')
		{ $brandHtml=''; 
		  $store_id=Mage::app()->getStore()->getId();
           $brandCollection=Mage::getModel('brand/brand')->getCollection()
            ->addStoreFilter($store_id)->addFieldToFilter('brand_status',1)
            ->addFieldToFilter('brand_option_name',array('like' => '%'.$searchValue.'%'));
			
			if(count($brandCollection))
			{
				$brandHtml.='<ul>';
			  foreach($brandCollection as $brand)
			  {
			      $brandParam=Mage::helper('brand/data')->getBrandParam();
				  $optionValue=Mage::helper('brand/data')->getAttributeOptionValue($brand->getBrandOptionName());
				  $brandHtml.='<li><a href="'.Mage::getUrl('brands').'?'.$brandParam.'='.$optionValue.'" title="'.$brand->getBrandOptionName().'">'.$brand->getBrandOptionName().'</a></li>';
			  }
			  $brandHtml.='</ul>';
			  echo json_encode ($brandHtml);
			}
			else
			{
					 $brandHtml='<ul><li><li></ul>';
			  echo json_encode ($brandHtml);
				
			}
			
		}
		else
		{
			
			 $brandHtml='<ul><li><li></ul>';
			  echo json_encode ($brandHtml);
		}
	  
		
	}
}