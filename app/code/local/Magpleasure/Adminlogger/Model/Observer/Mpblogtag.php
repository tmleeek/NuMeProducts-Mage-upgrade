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
class Magpleasure_Adminlogger_Model_Observer_Mpblogtag extends Magpleasure_Adminlogger_Model_Observer
{
    public function MpBlogTagLoad($event)
    {
        $this->createLogRecord(
            $this->getActionGroup('mpblogtag')->getValue(),
            Magpleasure_Adminlogger_Model_Actiongroup_Mpblogtag::ACTION_TAG_LOAD,
            Mage::app()->getRequest()->getParam('id')
        );
    }

    public function MpBlogTagSave($event)
    {
        if (Mage::registry('adminlogger_post_save')){
            return $this;
        }

        $tag = $event->getObject();
        $log = $this->createLogRecord(
            $this->getActionGroup('mpblogtag')->getValue(),
            Magpleasure_Adminlogger_Model_Actiongroup_Mpblogtag::ACTION_TAG_SAVE,
            $tag->getId()
        );
        if ($log){
            $log->addDetails(
                $this->_helper()->getCompare()->diff($tag->getData(), $tag->getOrigData())
            );
        }

    }

    public function MpBlogTagDelete($event)
    {
        $this->createLogRecord(
            $this->getActionGroup('mpblogtag')->getValue(),
            Magpleasure_Adminlogger_Model_Actiongroup_Mpblogtag::ACTION_TAG_DELETE
        );
    }
}
