<?php
class Mdlext_Mdloption_Helper_Data extends Mage_Core_Helper_Abstract
{	
    const XML_CONFIG_PATH = 'mdloption/';
   
	const NAME_DIR_JS = 'mdl/mdloption/';
  
    protected $_files = array(
        'jquery-1.11.1.min.js',
        'jquery.noconflict.js',
    );
	 public function getJQueryPath($file)
    {
        return self::NAME_DIR_JS . $file;
    }
	
    public function getFiles()
    {
        return $this->_files;
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
