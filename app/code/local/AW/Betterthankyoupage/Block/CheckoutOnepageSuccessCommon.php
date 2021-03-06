<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Betterthankyoupage
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

if (!class_exists('AW_Betterthankyoupage_Block_CheckoutOnepageSuccessCommon')) {
    if (Mage::helper('betterthankyoupage')->isSarp2Installed()) {
        class AW_Betterthankyoupage_Block_CheckoutOnepageSuccessCommon extends AW_Sarp2_Block_Checkout_Onepage_Success
        {
        }
    } else {
        class AW_Betterthankyoupage_Block_CheckoutOnepageSuccessCommon extends Mage_Checkout_Block_Onepage_Success
        {
        }
    }
}
