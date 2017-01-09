<?php
if (!class_exists('Magic_Mdlblog_Block_Product_ToolbarCommon')) {
    if (Mage::helper('mdlblog')->isMobileInstalled()) {
        class Magic_Mdlblog_Block_Product_ToolbarCommon extends Magic_Mobile_Block_Catalog_Product_List_Toolbar
        {
        }
    } else {
        class Magic_Mdlblog_Block_Product_ToolbarCommon extends Mage_Catalog_Block_Product_List_Toolbar
        {
        }
    }
}