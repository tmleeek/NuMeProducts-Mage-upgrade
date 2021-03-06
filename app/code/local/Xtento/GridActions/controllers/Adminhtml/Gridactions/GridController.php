<?php

/**
 * Product:       Xtento_GridActions (1.7.2)
 * ID:            mJUDsdnuj0QF2iAHyWBW1BRT7TLEsSdABAEYeucwpwE=
 * Packaged:      2013-12-11T00:50:07+00:00
 * Last Modified: 2013-05-31T15:29:13+02:00
 * File:          app/code/local/Xtento/GridActions/controllers/Adminhtml/Gridactions/GridController.php
 * Copyright:     Copyright (c) 2013 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_GridActions_Adminhtml_GridActions_GridController extends Mage_Adminhtml_Controller_Action
{
    public function massAction()
    {
        Mage::getModel('gridactions/processor')->processOrders();
        $this->_redirect('adminhtml/sales_order');
    }
}