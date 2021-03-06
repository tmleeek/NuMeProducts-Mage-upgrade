<?php

/**
 * Product:       Xtento_GridActions (1.7.2)
 * ID:            mJUDsdnuj0QF2iAHyWBW1BRT7TLEsSdABAEYeucwpwE=
 * Packaged:      2013-12-11T00:50:07+00:00
 * Last Modified: 2011-12-28T17:12:07+01:00
 * File:          app/code/local/Xtento/GridActions/Model/System/Config/Backend/Import/Servername.php
 * Copyright:     Copyright (c) 2013 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_GridActions_Model_System_Config_Backend_Import_Servername extends Mage_Core_Model_Config_Data
{
    const MODULE_MESSAGE = 'The Simplify Bulk Order Processing extension couldn\'t be enabled. Please make sure you are using a valid license key.';

    public function afterLoad()
    {
        $sName1 = Mage::getModel('gridactions/system_config_backend_import_server')->getFirstName();
        $sName2 = Mage::getModel('gridactions/system_config_backend_import_server')->getSecondName();
        if ($sName1 !== $sName2) {
            $this->setValue(sprintf('%s (Main: %s)', $sName1, $sName2));
        } else {
            $this->setValue(sprintf('%s', $sName1));
        }
    }
}
