<?php
class Mdlext_Mdloption_Model_Settings extends Mage_Core_Model_Abstract
{
    /**
     * cms file
     * @var string
     */
    private $_file = '/app/code/local/Mdlext/Mdloption/etc/cms.xml';
	private $_packagefile = '/app/code/local/Mdlext/Mdloption/etc/package.xml';
    protected $settings;
	protected $packagesettings;
    public function __construct()
    {
        parent::__construct();
        $this->settings = new Varien_Simplexml_Config();
        $this->settings->loadFile(Mage::getBaseDir().$this->_file);
		$this->packagesettings = new Varien_Simplexml_Config();
        $this->packagesettings->loadFile(Mage::getBaseDir().$this->_packagefile);
        if ( !$this->settings || !$this->packagesettings) {
            throw new Exception('Can not read theme config file '.Mage::getBaseDir().$this->_file);
        }
    }

    public function setupCms()
    {
		/* New Code Added */
		foreach ( $this->packagesettings->getNode('system/config')->children() as $k=>$item ) {
			 $this->_processConfig($item);
        } /* End New Code Added */
		
        foreach ( $this->settings->getNode('cms/pages')->children() as $item ) {
            $this->_processCms($item, 'cms/page');
        }

	    foreach ( $this->settings->getNode('cms/blocks')->children() as $item ) {
            $this->_processCms($item, 'cms/block');
        }

    }
	/* New Function Added */
	public function setupPackage()
    {
		foreach ( $this->packagesettings->getNode('system/config')->children() as $k=>$item ) {
			 $this->_processConfig($item);
        } 
    }
	/* New Function Added */
	protected function _processConfig($item)
	{
		$configClass = new Mage_Core_Model_Config();
		//echo '<pre>'; print_r($item); die;
		$config = array();
		foreach($item as $k=>$v)
		{
			$configClass->saveConfig(str_replace('-','/',$k), $v, 'default', 0);
		}
	}
	
    protected function _processCms($item, $model)
    {
        $cmsPage = array();
        foreach ( $item as $p ) {
            $cmsPage[$p->getName()] = (string)$p;
	        if ( $p->getName() == 'stores' ) {
		        $cmsPage[$p->getName()] = array();
		        foreach ( $p as $store ) {
			        $cmsPage[$p->getName()][] = (string)$store;
		        }
	        }
        }

	    $orig_page = Mage::getModel($model)->getCollection()
            ->addFieldToFilter('identifier', array( 'eq' => $cmsPage['identifier'] ))
            ->load();
        if (count($orig_page)) {
            foreach ($orig_page as $_page) {
                $_page->delete();
            }
        }

	    Mage::getModel($model)->setData($cmsPage)->save();

    }

}
