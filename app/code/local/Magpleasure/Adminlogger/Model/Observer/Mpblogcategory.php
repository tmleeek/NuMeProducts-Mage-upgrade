<?php
/**
 * Magpleasure Ltd.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE-CE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magpleasure.com/LICENSE-CE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento COMMUNITY edition
 * Magpleasure does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * Magpleasure does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   Magpleasure
 * @package    Magpleasure_Adminlogger
 * @version    1.0.2
 * @copyright  Copyright (c) 2012-2013 Magpleasure Ltd. (http://www.magpleasure.com)
 * @license    http://www.magpleasure.com/LICENSE-CE.txt
 */

class Magpleasure_Adminlogger_Model_Observer_Mpblogcategory extends Magpleasure_Adminlogger_Model_Observer
{
    public function MpBlogCategoryLoad($event)
    {
        $this->createLogRecord(
            $this->getActionGroup('mpblogcategory')->getValue(),
            Magpleasure_Adminlogger_Model_Actiongroup_Mpblogcategory::ACTION_CATEGORY_LOAD,
            Mage::app()->getRequest()->getParam('id')
        );
    }

    public function MpBlogCategorySave($event)
    {
        $category = $event->getObject();
        $log = $this->createLogRecord(
            $this->getActionGroup('mpblogcategory')->getValue(),
            Magpleasure_Adminlogger_Model_Actiongroup_Mpblogcategory::ACTION_CATEGORY_SAVE,
            $category->getId()
        );
        if ($log){
            $log->addDetails(
                $this->_helper()->getCompare()->diff($category->getData(), $category->getOrigData())
            );
        }
    }

    public function MpBlogCategoryDelete($event)
    {
        $this->createLogRecord(
            $this->getActionGroup('mpblogcategory')->getValue(),
            Magpleasure_Adminlogger_Model_Actiongroup_Mpblogcategory::ACTION_CATEGORY_DELETE
        );
    }
}
