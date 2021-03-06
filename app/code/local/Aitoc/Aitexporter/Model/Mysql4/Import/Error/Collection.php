<?php
/**
 * Orders Export and Import
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitexporter
 * @version      1.2.5
 * @license:     Orqsb1o5IOBC2rn5itGJF1Fmsrvozo2C91UTuZiGeO
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
class Aitoc_Aitexporter_Model_Mysql4_Import_Error_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    private $_storeId;

    public function _construct()
    {
        $this->_init('aitexporter/import_error');
    }
    
    public function setStoreId($storeId)
    {
        $this->_storeId = $storeId;

        return $this;
    }

    public function loadOrderErrors($orderIncrementId)
    {
        $currentImport = Mage::registry('current_import');
        if ($currentImport)
        {
            $this
                ->addFieldToFilter('import_id', $currentImport->getId())
                ->addFieldToFilter('order_increment_id', $orderIncrementId)
                ->addFieldToFilter('type', Aitoc_Aitexporter_Model_Import_Error::TYPE_ERROR)
                ;
        }

        return $this;
    }
}