<?php
class Mdl_Ajaxnav_Block_Layer_Filter_Category extends Mage_Catalog_Block_Layer_Filter_Category {

    public function __construct() {  
        parent::__construct();
        //Load Custom PHTML of category 
        $this->setTemplate('mdl/ajaxnav/filter_category.phtml');
        //Set Filter Model Name
        $this->_filterModelName = 'ajaxnav/layer_filter_category';
    }

    public function getVar() {
        //Get request variable name which is used for apply filter
        return $this->_filter->getRequestVar();
    }

    public function getClearUrl() {
        //Get URL and rewrite with SEO frieldly URL
        $_seoURL = '';
        //Get request filters with URL 
        $query = Mage::helper('ajaxnav')->getParams();
        if (!empty($query[$this->getVar()])) {
            $query[$this->getVar()] = null;
            $_seoURL = Mage::getUrl('*/*/*', array(
                        '_use_rewrite' => true,
                        '_query' => $query,
            ));
        }

        return $_seoURL;
    }

}
