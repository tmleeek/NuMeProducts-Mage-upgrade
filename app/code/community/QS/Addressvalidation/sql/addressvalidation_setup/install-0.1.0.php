<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Виталий
 * Date: 25.07.12
 * Time: 22:44
 * To change this template use File | Settings | File Templates.
 */

/* @var $installer Mage_Customer_Model_Entity_Setup */
$installer = $this;
$installer->startSetup();

// Add reset password link token attribute
$installer->addAttribute('customer', 'validation_flag', array(
    'type'     => 'int',
    'input'    => 'hidden',
    'visible'  => false,
    'required' => false
));

$installer->endSetup();