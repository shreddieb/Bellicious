<?php

class Mdl_CatalogCategorySearch_Helper_Data extends Mage_Core_Helper_Abstract
{  
    const XML_PATH_SHOW_SUBCATEGORIES                = 'mdloption/catalog_category_search/show_subcategories';
    const XML_PATH_SELECT_CATEGORY_ON_CATEGORY_PAGES = 'mdloption/catalog_category_search/select_category_on_category_pages';

    
    public function enableCategories() {
        return Mage::getStoreConfig(self::XML_PATH_ENABLE_CATEGORIES);
    }
	 
     public function showSubCategories() {
        return Mage::getStoreConfig(self::XML_PATH_SHOW_SUBCATEGORIES);
    }

    public function selectCategoryOnCategoryPages() {
        return Mage::getStoreConfig(self::XML_PATH_SELECT_CATEGORY_ON_CATEGORY_PAGES);
    }

    public function getCategoryParamName() {
        return Mage::getModel('catalog/layer_filter_category')->getRequestVar();
    }

    public function getMaximumCategoryLevel() {
        return $this->showSubCategories() ? 3 : 2;
    }

    public function isCategoryPage() {
        return Mage::app()->getFrontController()->getAction() instanceof Mage_Catalog_CategoryController;
    }

    public function isSearchResultsPage() {
        return Mage::app()->getFrontController()->getAction() instanceof Mage_CatalogSearch_ResultController;
    }

}
