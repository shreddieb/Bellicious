<?php
class Mdl_Bestseller_Helper_Data extends Mage_Core_Helper_Abstract
{
	const STORE_CONFIG_BESTSELLING_STATUS = 'bestsellingproduct/bestselling/bestselling_status';
	const STORE_CONFIG_BESTSELLING_HOMEPAGE = 'bestsellingproduct/bestselling/bestselling_homepage';
	const STORE_CONFIG_BESTSELLING_SIDEBAR = 'bestsellingproduct/bestselling/bestselling_sidebar';
	const STORE_CONFIG_BESTSELLING_JCAROUSEL = 'bestsellingproduct/bestselling/bestselling_jcarousel';
	const STORE_CONFIG_BESTSELLING_NOPRODUCT = 'bestsellingproduct/bestselling/bestselling_noproduct';
	const STORE_CONFIG_BESTSELLING_FILTERS = 'bestsellingproduct/bestselling/bestselling_filter';
	
	
	const STORE_CONFIG_NEWPRODUCT_STATUS = 'bestsellingproduct/newproduct/newproduct_status';
	const STORE_CONFIG_NEWPRODUCT_HOMEPAGE = 'bestsellingproduct/newproduct/newproduct_homepage';
	const STORE_CONFIG_NEWPRODUCT_SIDEBAR = 'bestsellingproduct/newproduct/newproduct_sidebar';
	const STORE_CONFIG_NEWPRODUCT_JCAROUSEL = 'bestsellingproduct/newproduct/newproduct_jcarousel';
	const STORE_CONFIG_NEWPRODUCT_NOPRODUCT = 'bestsellingproduct/newproduct/newproduct_noproduct';
	const STORE_CONFIG_NEWPRODUCT_FILTERS = 'bestsellingproduct/newproduct/newproduct_filter';
	
	
	const STORE_CONFIG_FEATUREDPRODUCT_STATUS = 'bestsellingproduct/mostviewed/mostviewed_status';
	const STORE_CONFIG_FEATUREDPRODUCT_HOMEPAGE = 'bestsellingproduct/mostviewed/mostviewed_homepage';
	const STORE_CONFIG_FEATUREDPRODUCT_SIDEBAR = 'bestsellingproduct/mostviewed/mostviewed_sidebar';  
	const STORE_CONFIG_FEATUREDPRODUCT_JCAROUSEL = 'bestsellingproduct/mostviewed/mostviewed_jcarousel';
	const STORE_CONFIG_FEATUREDPRODUCT_NOPRODUCT = 'bestsellingproduct/mostviewed/mostviewed_noproduct';
	
	const STORE_CONFIG_JQUERY_SETTINGS = 'bestsellingproduct/jqueryfile/jqueryfile_status';
    	
		
	/**
	 * Get number of bestselling products to be displayed in homepage
	 *
	 * @return integer
	 */
	public function getBestsellingStatus()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_BESTSELLING_STATUS);
        return $num;
    }
	
	public function getNewproductStatus()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_NEWPRODUCT_STATUS);
        return $num;
    }
	
	public function getFeaturedStatus()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_FEATUREDPRODUCT_STATUS);
        return $num;
    }
	
	public function getBestsellingJcarousel()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_BESTSELLING_JCAROUSEL);
        return $num;
    }
	
	public function getBestsellingNoProduct()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_BESTSELLING_NOPRODUCT);
        return $num;
    }
	
	public function getBestsellingFilters()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_BESTSELLING_FILTERS);
        return $num;
    }
	
	public function getNewproductJcarousel()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_NEWPRODUCT_JCAROUSEL);
        return $num; 
    }
	
	public function getNewproductNoProduct()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_NEWPRODUCT_NOPRODUCT);
        return $num;
    }
	
	public function getNewproductFilters()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_NEWPRODUCT_FILTERS);
        return $num;
    }
	
	public function getFeaturedJcarousel()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_FEATUREDPRODUCT_JCAROUSEL);
        return $num;
    }
	
	public function getFeaturedNoProduct()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_FEATUREDPRODUCT_NOPRODUCT);
        return $num;
    }
	
	public function getJquerySetting()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_JQUERY_SETTINGS);
        return $num;
    }
	
	/**
	 * Get number of bestselling products to be displayed in homepage
	 *
	 * @return integer
	 */
	public function getBestsellingHomepage()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_BESTSELLING_HOMEPAGE);
        return $num >= 0 ? $num : 3;
    }
	/**
	 * Get number of bestselling products to be displayed in sidebar
	 *
	 * @return integer
	 */
	public function getBestsellingSidebar()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_BESTSELLING_SIDEBAR);
        return $num >= 0 ? $num : 5;
    }
	
	/**
	 * Get number of new products to be displayed in homepage
	 *
	 * @return integer
	 */
	public function getNewproductHomepage()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_NEWPRODUCT_HOMEPAGE);
        return $num >= 0 ? $num : 3;
    }
	
	/**
	 * Get number of new products to be displayed in sidebar
	 *
	 * @return integer
	 */
	public function getNewproductSidebar()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_NEWPRODUCT_SIDEBAR);
        return $num >= 0 ? $num : 5;
    }	
	
	/**
	 * Get number of most viewed products to be displayed in homepage
	 *
	 * @return integer
	 */
	public function getMostviewedHomepage()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_FEATUREDPRODUCT_HOMEPAGE);
        return $num >= 0 ? $num : 3;
    }
	
	/**
	 * Get number of most viewed products to be displayed in sidebar
	 *
	 * @return integer
	 */
	public function getMostviewedSidebar()
    {
        $num = (int)Mage::getStoreConfig(self::STORE_CONFIG_FEATUREDPRODUCT_SIDEBAR);
        return $num >= 0 ? $num : 5;
    }	
}