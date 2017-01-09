<?php
class Mdl_NewsletterPopup_IndexController extends Mage_Core_Controller_Front_Action
{
	public function IndexAction() {
      
	  $this->loadLayout();   
      $this->renderLayout(); 
	  
    }
	
	public function ajaxpostAction(){
		if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $session            = Mage::getSingleton('core/session');
            $customerSession    = Mage::getSingleton('customer/session');
            $email              = (string) $this->getRequest()->getPost('email');
			$error = null;
			$success = null;
            try {
                if (!Zend_Validate::is($email, 'EmailAddress')) {
                    //Mage::throwException($this->__('Please enter a valid email address.'));
					$error =  $this->__('Please enter a valid email address.');
                }

                if (Mage::getStoreConfig(Mage_Newsletter_Model_Subscriber::XML_PATH_ALLOW_GUEST_SUBSCRIBE_FLAG) != 1 && 
                    !$customerSession->isLoggedIn()) {
                    //Mage::throwException($this->__('Sorry, but administrator denied subscription for guests. Please <a href="%s">register</a>.', Mage::helper('customer')->getRegisterUrl()));
					$error = $this->__('Sorry, but administrator denied subscription for guests.');
					
                }

                $ownerId = Mage::getModel('customer/customer')
                        ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                        ->loadByEmail($email)
                        ->getId();
                if ($ownerId !== null && $ownerId != $customerSession->getId()) {
                    //Mage::throwException($this->__('This email address is already assigned to another user.'));
					$error = $this->__('This email address is already assigned to another user.');
					
                }

                $status = Mage::getModel('newsletter/subscriber')->subscribe($email);
			    if ($status == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
                    //$session->addSuccess($this->__('Confirmation request has been sent.'));
					$success = $this->__('Confirmation request has been sent.');
                }
                else {
                    //$session->addSuccess($this->__('Thank you for your subscription.'));
					$success = $this->__('Thank you for your subscription.');
                }
            }
            catch (Mage_Core_Exception $e) {
                //$session->addException($e, $this->__('There was a problem with the subscription: %s', $e->getMessage()));
				$error = $this->__('There was a problem with the subscription: %s', $e->getMessage());
            }
            catch (Exception $e) {
                //$session->addException($e, $this->__('There was a problem with the subscription.'));
				$error = $this->__('There was a problem with the subscription.');
            }
        }
		$response = array('status' => ($error === null?'success':'error'), 'msg' => ($error === null?$success:$error));
		//$response = array('msg' => $err);
		echo json_encode($response);
		exit;
	}
}