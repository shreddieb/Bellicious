<?php

//require_once 'recaptcha/recaptchalib-magic.php';

class Magic_Mdlblog_PostController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::helper('mdlblog')->getEnabled()) {
            $this->_redirectUrl(Mage::helper('core/url')->getHomeUrl());
        }
    }

    protected function _validateData($data)
    {
        $errors = array();
        $helper = Mage::helper('mdlblog');

        if (!Zend_Validate::is($data->getUser(), 'NotEmpty')) {
            $errors[] = $helper->__('Name can\'t be empty');
        }

        if (!Zend_Validate::is($data->getComment(), 'NotEmpty')) {
            $errors[] = $helper->__('Comment can\'t be empty');
        }

        if (!Zend_Validate::is($data->getPostId(), 'NotEmpty')) {
            $errors[] = $helper->__('post_id can\'t be empty');
        }

        $validator = new Zend_Validate_EmailAddress();
        if (!$validator->isValid($data->getEmail())) {
            $errors[] = $helper->__('"%s" is not a valid email address.', $data->getEmail());
        }

        return $errors;
    }

    public function viewAction()
    {
        $identifier = $this->getRequest()->getParam('identifier', $this->getRequest()->getParam('id', false));

        $helper = Mage::helper('mdlblog');
        $session = Mage::getSingleton('customer/session');

        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('mdlblog/comment');
            $data['user'] = strip_tags($data['user']);
            $model->setData($data);

            if (!Mage::getStoreConfig('mdlblog/comments/enabled')) {
                $session->addError($helper->__('Comments are not enabled.'));
                if (!Mage::helper('mdlblog/post')->renderPage($this, $identifier)) {
                    $this->_forward('NoRoute');
                }
                return;
            }

            if (!$session->isLoggedIn() && Mage::getStoreConfig('mdlblog/comments/login')) {
                $session->addError($helper->__('You must be logged in to comment.'));
                if (!Mage::helper('mdlblog/post')->renderPage($this, $identifier)) {
                    $this->_forward('NoRoute');
                }
                return;
            } else {
                if ($session->isLoggedIn() && Mage::getStoreConfig('mdlblog/comments/login')) {
                    $model->setUser($helper->getUserName());
                    $model->setEmail($helper->getUserEmail());
                }
            }

            try {
                if (Mage::getStoreConfig('mdlblog/recaptcha/enabled') && !$session->isLoggedIn()) {
                    $publickey = Mage::getStoreConfig('mdlblog/recaptcha/publickey');
                    $privatekey = Mage::getStoreConfig('mdlblog/recaptcha/privatekey');

                    $resp = recaptcha_check_answer(
                        $privatekey, $_SERVER["REMOTE_ADDR"], $data["recaptcha_challenge_field"],
                        $data["recaptcha_response_field"]
                    );

                    if (!$resp->is_valid) {
                        if ($resp->error == "incorrect-captcha-sol") {
                            $session->addError($helper->__('Your Recaptcha solution was incorrect, please try again'));
                        } else {
                            $session->addError($helper->__('An error occured. Please try again'));
                        }
                        // Redirect back with error message
                        $session->setBlogPostModel($model);
                        $this->_redirectReferer();
                        return;
                    }
                }

                $errors = $this->_validateData($model);
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        $session->addError($error);
                    }
                    $this->_redirectReferer();
                    return;
                }

                if ($session->getData('blog_post_model')) {
                    $session->unsetData('blog_post_model');
                }
                $model->setCreatedTime(now());
                $model->setComment(htmlspecialchars($model->getComment(), ENT_QUOTES));
                if (Mage::getStoreConfig('mdlblog/comments/approval')) {
                    $model->setStatus(2);
                    $session->addSuccess($helper->__('Your comment has been submitted.'));
                } else {
                    if ($session->isLoggedIn() && Mage::getStoreConfig('mdlblog/comments/loginauto')) {
                        $model->setStatus(2);
                        $session->addSuccess($helper->__('Your comment has been submitted.'));
                    } else {
                        $model->setStatus(1);
                        $session->addSuccess($helper->__('Your comment has been submitted and is awaiting approval.'));
                    }
                }
                $model->save();

                $commentId = $model->getCommentId();
            } catch (Exception $e) {
                if (!Mage::helper('mdlblog/post')->renderPage($this, $identifier)) {
                    $this->_forward('NoRoute');
                }
            }

            if (Mage::getStoreConfig('mdlblog/comments/recipient_email') != null && $model->getStatus() == 1
                && isset($commentId)
            ) {
                $translate = Mage::getSingleton('core/translate');
                /* @var $translate Mage_Core_Model_Translate */
                $translate->setTranslateInline(false);
                try {
                    $data["url"] = Mage::getUrl('mdlblog/manage_comment/edit/id/' . $commentId);
                    $postObject = new Varien_Object();
                    $postObject->setData($data);
                    $mailTemplate = Mage::getModel('core/email_template');
                    /* @var $mailTemplate Mage_Core_Model_Email_Template */
                    $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                        ->sendTransactional(
                            Mage::getStoreConfig('mdlblog/comments/email_template'),
                            Mage::getStoreConfig('mdlblog/comments/sender_email_identity'),
                            Mage::getStoreConfig('mdlblog/comments/recipient_email'), null, array('data' => $postObject)
                        );
                    $translate->setTranslateInline(true);
                } catch (Exception $e) {
                    $translate->setTranslateInline(true);
                }
            }
            $this->_redirectReferer();
            return;
            if (!Mage::helper('mdlblog/post')->renderPage($this, $identifier)) {
                $this->_forward('NoRoute');
            }
        } else {
            /* GET request */
            if (!Mage::helper('mdlblog/post')->renderPage($this, $identifier)) {
                $session->addNotice($helper->__('The requested page could not be found'));
                $this->_redirect($helper->getRoute());
                return false;
            }
        }
    }

    public function noRouteAction($coreRoute = null)
    {
        $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
        $this->getResponse()->setHeader('Status', '404 File not found');

        $pageId = Mage::getStoreConfig('web/default/cms_no_route');
        if (!Mage::helper('cms/page')->renderPage($this, $pageId)) {
            $this->_forward('defaultNoRoute');
        }
    }
}