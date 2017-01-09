<?php
class Mdl_Ajaxnav_Block_Rewrite_RewriteCatalogCategoryView extends Mage_Catalog_Block_Category_View
{ 
    public function getProductListHtml()
    {
        $html = parent::getProductListHtml();
        if ($this->getCurrentCategory()->getIsAnchor()){
            $html = Mage::helper('ajaxnav')->wrapProducts($html);
        }
        return $html;
    }   
} 