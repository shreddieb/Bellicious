<?php 
class Mdl_Featuredcategory_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
{      
	   $this->loadLayout();
	   $block=$this->getLayout()->createBlock('featuredcategory/categoryblock')->setTemplate('featuredcategory/categoryform.phtml');
	   // append block to content block
	   $this->getLayout()->getBlock('content')->append($block);
	   // render the layout 
	   $this->renderLayout();
    }

    public function saveCategoryAction()
    {
		  /* get post data */
		  $param=$this->getRequest()->getPost();
		  $storeId=$param['store_id'];
		  if(!$storeId)
		  {
			$errorMessage = $this->__('Set Featured category according store view');
			Mage::getSingleton('adminhtml/session')->addError($errorMessage);
			$this->_redirect('adminfeaturedcategory/adminhtml_index/index/');
			return;
		 }
	    
		
	

		/* category Ids array
		 * encode in json form
		 *
		 */
		$categoryIds=$param['category'];
		$featuredData=array("featured"=>array(array("store_id"=>$storeId, "featured_category"=>$categoryIds)));
		$featuredDataJson=json_encode($featuredData);
		/* Create Model_Resource_Featured_Collection Object and get first item to get featured categories  */
		$Featured=Mage::getModel('featuredcategory/featured')->getCollection()->getFirstItem()->getData();
		   
	    if(isset($Featured['featured_id']))
		$firstFeaturedId=$Featured['featured_id'];
		  
		/* Create Model_Featured Object */
		$FeaturedObj=Mage::getModel('featuredcategory/featured');
		if(!count($Featured))
		{  /* to create first row */
		$FeaturedObj->setFeaturedCategory($featuredDataJson);
		$FeaturedObj->save();
		}
		else
		{   /* to update existing row */
			
				 
		 //  $FeaturedObj->load($firstFeaturedId)->setFeaturedCategory($featuredDataJson)->save();
		 $FeaturedModel=$FeaturedObj->load($firstFeaturedId);
		 $featuredDataJsonOld=$FeaturedModel->getFeaturedCategory();
		 /* check if featured category data is already exist for this store*/
		 $featuredDataOld=json_decode($featuredDataJsonOld,true);
		 $fee=$featuredDataOld['featured'];
		  $IsExist=false;
						
			foreach($fee as $key=>$value)
			{   $index=$key;
				 if($value['store_id']==$storeId)
				{  
					$IsExist=true;
					$featuredDataOld['featured'][$key]['featured_category']=$categoryIds;
				
					$FeaturedModel->setFeaturedCategory(json_encode($featuredDataOld))->save();
				    $message = $this->__("Featured category has been updated successfully");
		            Mage::getSingleton('adminhtml/session')->addSuccess($message);
					 
				}
				
			}
			if($IsExist)
			{
				 $this->_redirect('adminfeaturedcategory/adminhtml_index/index/',array('store'=>$storeId)); 
		         return ;
			}
			if(!$IsExist)
			{   $featuredDataOld['featured'][$index+1]['store_id']=$storeId;
			    $featuredDataOld['featured'][$index+1]['featured_category']=$categoryIds;
				$FeaturedModel->setFeaturedCategory(json_encode($featuredDataOld))->save();
			    $message = $this->__("Featured category has been successfully Added");
		        Mage::getSingleton('adminhtml/session')->addSuccess($message);
				$this->_redirect('adminfeaturedcategory/adminhtml_index/index/',array('store'=>$storeId)); 
				return ;
			  
			}
	    }
		
		
		
	 }

}