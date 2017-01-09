<?php

class Magic_Mdlblog_Manage_MdlblogController extends Mage_Adminhtml_Controller_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/mdlext/mdlblog/posts');
    }

    protected function _initAction()
    {
        $this
            ->loadLayout()
            ->_setActiveMenu('mdlblog/posts')
        ;
		
        return $this;
    }

    public function indexAction()
    {
        $this->displayTitle('Posts');
        $this
            ->_initAction()
            ->renderLayout()
        ;
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('mdlblog/mdlblog')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			
			
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('blog_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('mdlblog/posts');
            $this->displayTitle('Edit post');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this
                ->_addContent($this->getLayout()->createBlock('mdlblog/manage_mdlblog_edit'))
                ->_addLeft($this->getLayout()->createBlock('mdlblog/manage_mdlblog_edit_tabs'))
            ;

            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mdlblog')->__('Post does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('mdlblog/mdlblog')->load($id);

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('blog_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('mdlblog/posts');
        $this->displayTitle('Add new post');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this
            ->_addContent($this->getLayout()->createBlock('mdlblog/manage_mdlblog_edit'))
            ->_addLeft($this->getLayout()->createBlock('mdlblog/manage_mdlblog_edit_tabs'))
        ;
        $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        $this->renderLayout();
    }

    public function duplicateAction()
    {
        $oldIdentifier = $this->getRequest()->getParam('identifier');
        $i = 1;
        $newIdentifier = $oldIdentifier . $i;
        while (Mage::getModel('mdlblog/post')->loadByIdentifier($newIdentifier)->getData()) {
            $newIdentifier = $oldIdentifier . ++$i;
        }
        $this->getRequest()->setPost('identifier', $newIdentifier);
        $this->_forward('save');
    }
	
	public function resize($img, $w, $h, $newfilename) {

 //Check if GD extension is loaded
 if (!extension_loaded('gd') && !extension_loaded('gd2')) {
  trigger_error("GD is not loaded", E_USER_WARNING);
  return false;
 }
 
 //Get Image size info
 $imgInfo = getimagesize($img);

 switch ($imgInfo[2]) {
  case 1: $im = imagecreatefromgif($img); break;
  case 2: $im = imagecreatefromjpeg($img);  break;
  case 3: $im = imagecreatefrompng($img); break;
  default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
 }
 
 //If image dimension is smaller, do not resize
 if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {
  $nHeight = $imgInfo[1];
  $nWidth = $imgInfo[0];
 }else{
                //yeah, resize it, but keep it proportional
  if ($w/$imgInfo[0] > $h/$imgInfo[1]) {
   $nWidth = $w;
   $nHeight = $imgInfo[1]*($w/$imgInfo[0]);
  }else{
   $nWidth = $imgInfo[0]*($h/$imgInfo[1]);
   $nHeight = $h;
  }
 }
 $nWidth = round($nWidth);
 $nHeight = round($nHeight);
 
 $newImg = imagecreatetruecolor($nWidth, $nHeight);

 /* Check if this image is PNG or GIF, then set if Transparent*/  
 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
  imagealphablending($newImg, false);
  imagesavealpha($newImg,true);
  $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
  imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
 }
 imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
 
 //Generate the file, and rename it to $newfilename
 switch ($imgInfo[2]) {
  case 1: imagegif($newImg,$newfilename); break;
  case 2: imagejpeg($newImg,$newfilename);  break;
  case 3: imagepng($newImg,$newfilename); break;
  default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
 }
   
   return $newfilename;
}

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('mdlblog/post');
           
            if (isset($data['stores'])) {
                if ($data['stores'][0] == 0) {
                    unset($data['stores']);
                    $data['stores'] = array();
                    $stores = Mage::getSingleton('adminhtml/system_store')->getStoreCollection();
                    foreach ($stores as $store) {
                        $data['stores'][] = $store->getId();
                    }
                }
            }
			//print_r(); die;
			if(isset($_FILES['blogimage']['name']) && $_FILES['blogimage']['name'] != '') {
			
			try {
			
			/* Starting upload */
			$uploader = new Varien_File_Uploader('blogimage');

			// Any extention would work
			$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
			$uploader->setAllowRenameFiles(false);

			// Set the file upload mode
			// false -> get the file directly in the specified folder
			// true -> get the file in the product like folders
			// (file.jpg will go in something like /media/f/i/file.jpg)
			$uploader->setFilesDispersion(false);

			// We set media as the upload dir
			$path = Mage::getBaseDir('media') . DS .'blog' . DS .'images';
			$uploader->save($path, $_FILES['blogimage']['name'] );
			
			$data['blogimage'] = 'blog/images/'.$_FILES['blogimage']['name'] ;
			 
			  $data['blogthumb'] = 'blog/thumb/'.$_FILES['blogimage']['name'] ;
			   $model->setBlogthumb('blog/thumb/'.$_FILES['blogimage']['name']);
				
				$image = $_FILES['blogimage']['name'];
				$_imageUrl = Mage::getBaseDir('media').DS."blog/images/".$image;
				$imageResized = Mage::getBaseDir('media').DS."blog/thumb/".$image;
				if (!file_exists($imageResized)&&file_exists($_imageUrl)) :
				/*$imageObj = new Varien_Image($_imageUrl);
				$imageObj->constrainOnly(TRUE);
				$imageObj->keepAspectRatio(TRUE);
				$imageObj->keepFrame(true);
				$imageObj->resize(200, 200);
				$imageObj->save($imageResized);*/
				
			
				
				$newfilename = Mage::getBaseDir('media').DS."blog/thumb/".$image;
				$thumbnail = $this->resize($_imageUrl,500,400,$newfilename);
				endif;
				//echo $thumbnail; die('here');
			//echo $data['blogimage']; die;
			} catch (Exception $e) {

			}
			}
			else {
			/*if($this->getRequest()->getParam('id'))
			{
			$mod=Mage::getModel('mdlblog/post')->load($this->getRequest()->getParam('id'));
			$data['blogimage'] =$mod['blogimage'];
			} else {
			$data['blogimage'] = '';
			}*/
			  //echo $data['blogimage']['delete'];die;
			  if (isset($data['blogimage']['delete']) && $data['blogimage']['delete'] == 1) 
             {
             $data['blogimage']='';
              }
            else 
                { 
               unset($data['blogimage']);
                  }
			
			}
			
			//$model->setBlogimage($_FILES['blogimage']['name']);
            $model
                ->setData($data)
                ->setId($this->getRequest()->getParam('id'))
            ;

            try {
                $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
                if (isset($data['created_time']) && $data['created_time']) {
                    $dateFrom = Mage::app()->getLocale()->date($data['created_time'], $format);
                    $model->setCreatedTime(Mage::getModel('core/date')->gmtDate(null, $dateFrom->getTimestamp()));
                    $model->setUpdateTime(Mage::getModel('core/date')->gmtDate());
                } else {
                    $model->setCreatedTime(Mage::getModel('core/date')->gmtDate());
                }

                if ($this->getRequest()->getParam('user') == null) {
                    $model
                        ->setUser(
                            Mage::getSingleton('admin/session')->getUser()->getFirstname() . " " . Mage::getSingleton(
                                'admin/session'
                            )->getUser()->getLastname()
                        )
                        ->setUpdateUser(
                            Mage::getSingleton('admin/session')->getUser()->getFirstname() . " " . Mage::getSingleton(
                                'admin/session'
                            )->getUser()->getLastname()
                        )
                    ;
                } else {
                    $model
                        ->setUpdateUser(
                            Mage::getSingleton('admin/session')->getUser()->getFirstname() . " " . Mage::getSingleton(
                                'admin/session'
                            )->getUser()->getLastname()
                        )
                    ;
                }
				
				 $model->save();
                /* recount affected tags */
                if (isset($data['stores'])) {
                    $stores = $data['stores'];
                } else {
                    $stores = array(null);
                }

                $affectedTags = array_merge($addedTags, $removedTags);

                foreach ($affectedTags as $tag) {
                    foreach ($stores as $store) {
                        if (trim($tag)) {
                            Mage::getModel('mdlblog/tag')->loadByName($tag, $store)->refreshCount();
                        }
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('mdlblog')->__('Post was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mdlblog')->__('Unable to find post to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        $postId = (int)$this->getRequest()->getParam('id');
        if ($postId) {
            try {
                $this->_postDelete($postId);
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Post was successfully deleted')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $blogIds = $this->getRequest()->getParam('mdlblog');
        if (!is_array($blogIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select post(s)'));
        } else {
            try {
                foreach ($blogIds as $postId) {
                    $this->_postDelete($postId);
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($blogIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _postDelete($postId)
    {
        $model = Mage::getModel('mdlblog/mdlblog')->load($postId);
        $_tags = explode(',', $model->getData('tags'));
        $model->delete();
        $_stores = Mage::getSingleton('adminhtml/system_store')->getStoreCollection();
        foreach ($_tags as $tag) {
            foreach ($_stores as $store) {
                if (trim($tag)) {
                    Mage::getModel('mdlblog/tag')->loadByName($tag, $store->getId())->refreshCount();
                }
            }
        }
    }

    public function massStatusAction()
    {
        $blogIds = $this->getRequest()->getParam('mdlblog');
        if (!is_array($blogIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select post(s)'));
        } else {
            try {

                foreach ($blogIds as $blogId) {
                    $mdlblog = Mage::getModel('mdlblog/mdlblog')
                        ->load($blogId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setStores('')
                        ->setIsMassupdate(true)
                        ->save()
                    ;
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($blogIds))
                );
            } catch (Exception $e) {

                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function displayTitle($data = null, $root = 'Blog')
    {
        if (!Mage::helper('mdlblog')->magentoLess14()) {
            if ($data) {
                if (!is_array($data)) {
                    $data = array($data);
                }
                foreach ($data as $title) {
                    $this->_title($this->__($title));
                }
                $this->_title($this->__($root));
            } else {
                $this->_title($this->__('Blog'))->_title($root);
            }
        }
        return $this;
    }
}