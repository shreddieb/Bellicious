<?php

class Magic_Mdlblog_Model_Dateformat
{
    const FORMAT_TYPE_FULL   = 'full';
    const FORMAT_TYPE_LONG   = 'long';
    const FORMAT_TYPE_MEDIUM = 'medium';
    const FORMAT_TYPE_SHORT  = 'short';

    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options[] = array(
                'value' => self::FORMAT_TYPE_MEDIUM,
                'label' => Mage::helper('mdlblog')->__('Medium')
            );
        }
        return $this->_options;
    }
}