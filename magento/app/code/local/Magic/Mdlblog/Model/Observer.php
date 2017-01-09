<?php

class Magic_Mdlblog_Model_Observer
{
    public function addBlogSection($observer)
    {
        $sitemapObject = $observer->getSitemapObject();
        if (!($sitemapObject instanceof Mage_Sitemap_Model_Sitemap)) {
            throw new Exception(Mage::helper('mdlblog')->__('Error during generation sitemap'));
        }

        $storeId = $sitemapObject->getStoreId();
        $date = Mage::getSingleton('core/date')->gmtDate('Y-m-d');
        $baseUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
        /**
         * Generate mdlblog pages sitemap
         */
        $changefreq = (string)Mage::getStoreConfig('sitemap/mdlblog/changefreq');
        $priority = (string)Mage::getStoreConfig('sitemap/mdlblog/priority');
        $collection = Mage::getModel('mdlblog/mdlblog')->getCollection()->addStoreFilter($storeId);
        Mage::getSingleton('mdlblog/status')->addEnabledFilterToCollection($collection);
        $route = Mage::getStoreConfig('mdlblog/mdlblog/route');
        if ($route == "") {
            $route = "mdlblog";
        }
        foreach ($collection as $item) {
            $xml = sprintf(
                '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%.1f</priority></url>',
                htmlspecialchars($baseUrl . $route . '/' . $item->getIdentifier()), $date, $changefreq, $priority
            );

            $sitemapObject->sitemapFileAddLine($xml);
        }
        unset($collection);
    }
   
}