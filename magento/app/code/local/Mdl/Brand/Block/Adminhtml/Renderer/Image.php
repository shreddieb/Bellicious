<?php
class Mdl_Brand_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    
    public function render(Varien_Object $row)
    {
        
        $condfig=Mage::helper('brand/data')->getStoreConfig();
         $height=$condfig['image_height'] ? $condfig['image_height'] : 100;
         $width=$condfig['image_width'] ? $condfig['image_width'] : 100;
      
        if($row->getData($this->getColumn()->getIndex())){
            $value = $row->getData($this->getColumn()->getIndex());
        }
        else{
             $value='mdl-brand/no_image.png';
        }
		$img1 = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$value;
		
		$img = str_replace('\\', '/', $img1);
	  //$img = str_replace('//', '/', $img);
	  
        return '<img data-src="'.$img1.'" width="'.$width.'px" height="'.$height.'px" src="'.$img.'" />';
    }
}