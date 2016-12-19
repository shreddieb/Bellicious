<?php

class Magic_Mdlblog_Model_Mysql4_Mdlblog extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('mdlblog/mdlblog', 'post_id');
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $condition = $this->_getWriteAdapter()->quoteInto('post_id = ?', $object->getId());
        $this->_getWriteAdapter()->delete($this->getTable('store'), $condition);

        if (!$object->getData('stores')) {
            $storeArray = array();
            $storeArray['post_id'] = $object->getId();
            $storeArray['store_id'] = '0';
            $this->_getWriteAdapter()->insert($this->getTable('store'), $storeArray);
        } else {
            foreach ((array)$object->getData('stores') as $store) {
                $storeArray = array();
                $storeArray['post_id'] = $object->getId();
                $storeArray['store_id'] = $store;
                $this->_getWriteAdapter()->insert($this->getTable('store'), $storeArray);
            }
        }
        return parent::_afterSave($object);
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     *
     * @return $this|Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('store'))
            ->where('post_id = ?', $object->getId())
        ;

        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $storesArray = array();
            foreach ($data as $row) {
                $storesArray[] = $row['store_id'];
            }
            $object->setData('store_id', $storesArray);
        }

        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('post_cat'))
            ->where('post_id = ?', $object->getId())
        ;

        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $catsArray = array();
            foreach ($data as $row) {
                $catsArray[] = $row['cat_id'];
            }
            $object->setData('cat_id', $catsArray);
        }

        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string                   $field
     * @param mixed                    $value
     * @param Mage_Core_Model_Abstract $object
     *
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);
        if ($object->getStoreId()) {
            $select
                ->join(array('cps' => $this->getTable('store')), $this->getMainTable() . '.post_id = `cps`.post_id')
                ->where('`cps`.store_id in (0, ?) ', $object->getStoreId())
                ->order('store_id DESC')
                ->limit(1)
            ;
        }
        return $select;
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object)
    {
        // Cleanup stats on mdlblog delete
        $adapter = $this->_getReadAdapter();
        // 1. Delete mdlblog/store
        $adapter->delete($this->getTable('mdlblog/store'), 'post_id=' . $object->getId());
        // 2. Delete mdlblog/post_cat
        $adapter->delete($this->getTable('mdlblog/post_cat'), 'post_id=' . $object->getId());
        // 3. Delete mdlblog/post_comment
        $adapter->delete($this->getTable('mdlblog/comment'), 'post_id=' . $object->getId());
       
    }
}