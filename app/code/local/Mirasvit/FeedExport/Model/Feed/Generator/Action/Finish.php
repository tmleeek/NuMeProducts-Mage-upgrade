<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Advanced Product Feeds
 * @version   1.1.2
 * @revision  252
 * @copyright Copyright (C) 2014 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_FeedExport_Model_Feed_Generator_Action_Finish extends Mirasvit_FeedExport_Model_Feed_Generator_Action
{
    public function process()
    {
        $this->start();

        $feed     = $this->getFeed();
        $io       = Mage::helper('feedexport/io');
        $tmpPath  = Mage::getSingleton('feedexport/config')->getTmpPath($feed->getId());
        $basePath = Mage::getSingleton('feedexport/config')->getBasePath();

        $io->copy($tmpPath.DS.'result.dat', $basePath.DS.$feed->getFilenameWithExt());

        Mage::helper('feedexport')->getState()->setStatus('ready');


        $resource         = Mage::getSingleton('core/resource');
        $connection       = $resource->getConnection('core_write');
        $feedProductTable = $resource->getTableName('feedexport/feed_product');

        $connection->query('UPDATE '.$feedProductTable.' SET `is_new` = 0 WHERE `feed_id`='.$feed->getId());

        $this->finish();

        return $this;
    }
}