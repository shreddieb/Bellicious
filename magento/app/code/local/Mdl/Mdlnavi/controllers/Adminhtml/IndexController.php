<?php 
class Mdl_Mdlnavi_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{	
	public function urlupAction()
    {
		$catId = $this->getRequest()->getParam('cat_id');
		$category = Mage::getModel('catalog/category')->load($catId );
		echo $category->getLevel();
	}
}