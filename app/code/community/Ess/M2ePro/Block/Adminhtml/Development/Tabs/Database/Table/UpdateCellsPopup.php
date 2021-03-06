<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Development_Tabs_Database_Table_UpdateCellsPopup extends Mage_Adminhtml_Block_Widget
{
    // ########################################

    public function __construct()
    {
        parent::__construct();

        // Initialization block
        //------------------------------
        $this->setId('developmentDatabaseUpdateCellsPopup');
        //------------------------------

        $this->setTemplate('M2ePro/development/tabs/database/update_cells_popup.phtml');
    }

    // ########################################

    protected function _toHtml()
    {
        $this->tableName = $this->getRequest()->getParam('table');
        $this->modelName = $this->getRequest()->getParam('model');
        $this->rowsIds = explode(',', $this->getRequest()->getParam('ids'));

        // --------------------------------------
        $data = array(
            'id' => 'development_database_update_cell_popup_confirm_button',
            'label'   => Mage::helper('M2ePro')->__('Confirm'),
            'onclick' => 'DevelopmentDatabaseGridHandlerObj.confirmUpdateTableCellsPopup();',
        );
        $buttonBlock = $this->getLayout()->createBlock('adminhtml/widget_button')->setData($data);
        $this->setChild('popup_confirm_button', $buttonBlock);
        // --------------------------------------

        return parent::_toHtml();
    }

    // ########################################

    public function getTableColumns()
    {
        $resourceModel = Mage::getResourceModel('M2ePro/'.$this->modelName);
        $tableName = Mage::getSingleton('core/resource')->getTableName($this->tableName);

        return $resourceModel->getReadConnection()->fetchAll('SHOW COLUMNS FROM '.$tableName);
    }

    // ########################################
}