<?php
class Mdl_Ajaxnav_Block_Layer_Filter_Attribute extends Mage_Catalog_Block_Layer_Filter_Attribute {

    public function __construct() {
        parent::__construct();
        //Load Custom PHTML of attributes
        $this->setTemplate('mdl/ajaxnav/filter_attribute.phtml');
        //Set Filter Model Name
        $this->_filterModelName = 'ajaxnav/layer_filter_attribute';
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

    public function getHtmlId($item) {
        //Make HTMLID with requested filter + value of param
        return $this->getVar() . '-' . $item->getValueString();
    }

    public function Selectedfilter($item) {
        //Set Selected filters 
        $ids = (array) $this->_filter->getActiveState();
        return in_array($item->getValueString(), $ids);
    }

    public function getFiltersArray() {

        $_filtersArray = array();
        //$hideLinks = Mage::getStoreConfig('ajaxnav/ajaxnav/remove_links');
        //Get all filter items  ( use getItems method of Mage_Catalog_Model_Layer_Filter_Abstract )
        foreach ($this->getItems() as $_item) {
            //echo $this->getName();
             if(Mage::helper('core')->isModuleEnabled('Mage_ConfigurableSwatches')){
             if (Mage::helper('configurableswatches')->isEnabled())
             {
                $prodAttr = Mage::getStoreConfig('configswatches/general/swatch_attributes');
                $expAttr = explode(',',$prodAttr);
                //print_r($expAttr);
                $width = Mage::getStoreConfig('configswatches/product_listing_dimensions/width');
                $height = Mage::getStoreConfig('configswatches/product_listing_dimensions/height');
                $imgHtml = '<img width="'.$width.'" height="'.$height.'" title="'.$_item->getLabel().'" alt="'.$_item->getLabel().'" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'/catalog/swatches/1/'.$width.'x'.$height.'/media/'.strtolower(str_replace(' ','-',$_item->getLabel())).'.png">';
             }
             else
             {
                $imgHtml = '<div class="color_box" style="background-color:' . $_item->getLabel() . ';"></div>';  
             }
            }
            else
            {
               $imgHtml = '<div class="color_box" style="background-color:' . $_item->getLabel() . ';"></div>';
            }
            $showSwatches = Mage::getStoreConfig('ajaxnav/ajaxnav/show_swatches');
            $_htmlFilters = 'id="' . $this->getHtmlId($_item) . '" ';
            $var_href = "#";

            //Create URL
            $var_href = html_entity_decode($currentUrl = Mage::app()->getRequest()->getBaseUrl() . Mage::getSingleton('core/session')->getRequestPath());
            $_htmlFilters .= 'href="' . $var_href . '" ';

            $_htmlFilters .= 'class="mdl_layered_attribute '
                    . ($this->Selectedfilter($_item) ? 'mdl_layered_attribute_selected' : '') . '" ';

            //Check the number of products against filter
            $qty = '';
            if (!$this->getHideQty())
                $qty = ''; //'(' .  $_item->getCount() .')';


            if ($this->getName() == "Color") {

                if ($showSwatches == "iconslinks") {

                    $iconCode = Mage::helper('ajaxnav')->checkColor($_item->getLabel());
                    $_html = "";
                    $_html .= '<div class="color">
                                        <a ' . $_htmlFilters . '>'.$imgHtml.'' . $_item->getLabel() . '</a><span>' . $qty . '</span>
                                </div>';
                } elseif ($showSwatches == "icons") {

                    $iconCode = Mage::helper('ajaxnav')->checkColor($_item->getLabel());
                    $_html = "";
                    $_html .= '<div class="color">
                                        <a ' . $_htmlFilters . '>'.$imgHtml.'
                                        </a><span>' . $qty . '</span>
                                </div>';
                } else {

                    $_html = "";
                    $_html .= '<a ' . $_htmlFilters . '>' . $_item->getLabel() . '</a><span>' . $qty . '</span>';
                }
            }
            if ($this->getName() == "Color") {
                $_filtersArray[] = $_html;
            } else {
                $_filtersArray[] = '<a ' . $_htmlFilters . '>' . $_item->getLabel() . '</a>' . $qty;
            }
        }

        return $_filtersArray;
    }

}
