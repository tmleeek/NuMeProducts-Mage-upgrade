<?php

/**
 * MageWorx
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MageWorx EULA that is bundled with
 * this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.mageworx.com/LICENSE-1.0.html
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@mageworx.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extension
 * to newer versions in the future. If you wish to customize the extension
 * for your needs please refer to http://www.mageworx.com/ for more information
 * or send an email to sales@mageworx.com
 *
 * @category   MageWorx
 * @package    MageWorx_MultiFees
 * @copyright  Copyright (c) 2009 MageWorx (http://www.mageworx.com/)
 * @license    http://www.mageworx.com/LICENSE-1.0.html
 */
/**
 * Multi Fees extension
 *
 * @category   MageWorx
 * @package    MageWorx_MultiFees
 * @author     MageWorx Dev Team <dev@mageworx.com>
 */
/* @var $installer MageWorx_MultiFees_Model_Mysql4_Setup */
$installer = $this;
$installer->startSetup();
//if (version_compare(Mage::getVersion(), '1.4.1', '>=')) {
//    $description = $installer->getConnection()->describeTable($installer->getTable('sales/order_aggregated_created'));
//    if (!empty($description['base_multifees_amount'])) {
//        $installer->getConnection()->query("ALTER TABLE  {$installer->getTable('sales/order_aggregated_created')} CHANGE base_multifees_amount total_multifees_amount decimal(12,4) NOT NULL DEFAULT '0'");
//    }
//}

//if (!$installer->getConnection()->tableColumnExists($installer->getTable('multifees_fee'), 'apply_to')) {
//    $installer->getConnection()->addColumn(
//	$installer->getTable('multifees_fee'),
//	'apply_to',
//	'varchar(255)'
//    );
//}
$installer->endSetup();