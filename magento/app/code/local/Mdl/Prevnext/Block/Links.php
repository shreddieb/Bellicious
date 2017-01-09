<?php
class Mdl_Prevnext_Block_Links extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('inchoo/prevnext/links.phtml');
    }
    
    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getPreviousProduct()
    {
        return $this->helper('inchoo_prevnext')->getPreviousProduct();
    }

    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getNextProduct()
    {
        return $this->helper('inchoo_prevnext')->getNextProduct();
    }    
}
