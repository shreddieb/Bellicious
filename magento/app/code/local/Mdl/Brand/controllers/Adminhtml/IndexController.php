<?php
class Mdl_Brand_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
	 protected function _initAction()
	 {
        $this->loadLayout()->_title($this->__('Mdl Brands'))->_title($this->__('Manage Brands'));
        return $this;
     }
      
	  public function indexAction()
	  {
         $this->_initAction();
		 $this->renderLayout();
      }
	  
	
	  public function editAction()
	  {
		  
          $Id = $this->getRequest()->getParam('id'); 
          $brand = Mage::getModel('brand/brand')->load($Id);
		
          if ($brand->getBrandId() || $Id == 0){   
               Mage::register('brand_data', $brand);
			   Mage::getSingleton('core/session')->setOldBrandOptionName($brand->getBrandOptionName());
			   $this->loadLayout()->_title($this->__('Manage Brands'))->_title($this->__('Add/Edit Brands'));
               $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
               $this->_addContent($this->getLayout()->createBlock('brand/adminhtml_brand_edit'))
			            ->_addLeft($this->getLayout()->createBlock('brand/adminhtml_brand_edit_tabs'));
               $this->renderLayout();
           }
           else{
               Mage::getSingleton('adminhtml/session')->addError('Brand does not exist');
               $this->_redirect('*/*/');
            }
       }
	   
	 public function saveAction()
	 {
		    
         if ($this->getRequest()->getPost())
         {    
	         $postData = $this->getRequest()->getPost();
		     if (isset($postData['brand_image']['delete'])){ 
                       Mage::helper('brand')->deleteImageFile($postData['brand_image']['value']);
				       $postData['brand_image']='';
               }
			   else{
                    unset($postData['brand_image']);
               }  
					
					
			   if (isset($postData['brand_thumbnail_image']['delete'])){ 
                       Mage::helper('brand')->deleteImageFile($postData['brand_thumbnail_image']['value']);
				       $postData['brand_thumbnail_image']='';
                }
			    else {
                       unset($postData['brand_thumbnail_image']);
                }
				
				if(isset($_FILES['brand_image']['name']) and (file_exists($_FILES['brand_image']['tmp_name']))) {
				 try {
					   
					    $brand_image_new_name=Mage::helper('brand')->getImageNewName($_FILES['brand_image']['name']);
						
					 Mage::helper('brand')->uploadImageFile( $brand_image_new_name,'brand_image');
				      $postData['brand_image'] = 'mdl-brand/' . $brand_image_new_name;
				 }catch(Exception $e) {
				 Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
			   }
		if(isset($_FILES['brand_thumbnail_image']['name']) and (file_exists($_FILES['brand_thumbnail_image']['tmp_name']))) {
				 try {
					   $brand_thumbnail_new_name=Mage::helper('brand')->getImageNewName($_FILES['brand_thumbnail_image']['name']);
					 Mage::helper('brand')->uploadImageFile(  $brand_thumbnail_new_name,'brand_thumbnail_image');
				      $postData['brand_thumbnail_image'] = 'mdl-brand/thumb/' .$brand_thumbnail_new_name;
				 }catch(Exception $e) {
				 Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
			   }
		  try {
						 if( isset($postData['stores']) ) {
							if( in_array('0', $postData['stores']) ){
								$postData['store_id'] = '0';
							} else {
								$postData['store_id'] = join(",", $postData['stores']);
							}
							unset($postData['stores']);
						}

                 $brand = Mage::getModel('brand/brand');
			   $brandy = Mage::getModel('brand/brand')->getCollection();
			   $name = strtolower($this->getRequest()->getPost('brand_option_name'));
			   $id = $this->getRequest()->getParam('id');
               if($id == '')
			    foreach($brandy as $item)
					$collection[]  = strtolower($item->getData('brand_option_name'));
					//$collectId[]  = $item->getData('brand_id');
				 if(in_array($name,$collection))
					{
					 //if($id == '')
					Mage::getSingleton('adminhtml/session')->addError('brand name already exist');
					Mage::getSingleton('adminhtml/session')->setBrandData(false);
					$this->_redirect('*/*/new');
					return;
					}

               if($this->getRequest()->getParam('id') <= 0 )
                  $brand->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
                  $brand->addData($postData)->setUpdateTime(Mage::getSingleton('core/date')
					   ->gmtDate())->setId($this->getRequest()->getParam('id'))->save();
                 Mage::getSingleton('adminhtml/session')->addSuccess('successfully saved');
                 Mage::getSingleton('adminhtml/session')->setBrandData(false);
				 if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $brand->getBrandId()));
					return;
				 }
                 $this->_redirect('*/*/');
                return;
          } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')
                                  ->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                 ->setBrandData($this->getRequest()
                                    ->getPost()
                );
                $this->_redirect('*/*/edit',
                            array('id' => $this->getRequest()
                                                ->getParam('id')));
                return;
                }
              }
              $this->_redirect('*/*/');
            }
			
	   
	   public function newAction()
       {
          $this->_forward('edit');
       }
	 public function deleteAction()
          {
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $brandModel = Mage::getModel('brand/brand');
					/* new added  */
				    $brand= Mage::getModel('brand/brand')->load($this->getRequest()->getParam('id'));
					Mage::dispatchEvent('brand_delete_before', array('branddetails' => $brand));
					 /* new added  */
                    $brandModel->setId($this->getRequest()->getParam('id'))->delete();
                    Mage::getSingleton('adminhtml/session')
                               ->addSuccess('successfully deleted');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
     }
} 