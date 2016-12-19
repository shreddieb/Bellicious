<?php
class Mdl_Ajaxnav_Block_Search_Layer extends Mdl_Ajaxnav_Block_Layer_View {

    public function getLayer() {
        return Mage::getSingleton('catalogsearch/layer');
    }

    /**
     * Check availability display layer block
     *
     * @return bool
     */
    public function canShowBlock() {

        $availableResCount = (int) Mage::app()->getStore()
                        ->getConfig(Mage_CatalogSearch_Model_Layer::XML_PATH_DISPLAY_LAYER_COUNT);

        if (!$availableResCount || ($availableResCount >= $this->getLayer()->getProductCollection()->getSize())) {
            return parent::canShowBlock();
        }
        return false;
    }

    protected function createCategoriesBlock() {

        $categoryBlock = $this->getLayout()
                ->createBlock('ajaxnav/layer_filter_categorysearch')
                ->setLayer($this->getLayer())
                ->init();
        $this->setChild('category_filter', $categoryBlock);
    }

}
