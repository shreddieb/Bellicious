<?php

class Magic_Mdlblog_Model_Comment extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('mdlblog/comment');
    }

    public function load($id, $field = null)
    {
        return parent::load($id, $field);
    }
}