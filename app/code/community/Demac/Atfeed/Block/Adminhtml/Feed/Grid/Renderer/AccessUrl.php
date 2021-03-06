<?php
 /**
 * GoMage.com
 *
 * GoMage Feed Pro
 *
 * @category     Extension
 * @copyright    Copyright (c) 2010-2012 GoMage.com (http://www.gomage.com)
 * @author       GoMage.com
 * @license      http://www.gomage.com/licensing  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 3.0
 * @since        Class available since Release 1.0
 */

class Demac_Atfeed_Block_Adminhtml_Feed_Grid_Renderer_AccessUrl extends  Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{
	
	public function render(Varien_Object $feed){


        $baseUrl = Mage::app()->getWebsite($feed->getWebsiteId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
        $url = $baseUrl . '/' . $feed->getFtpFilename();

        if($url){
			return sprintf('<a href="%s" target="_blank">%s</a>', $url, $url);
		}
		
	}
}