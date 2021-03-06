<?php

/**
 * Product:       Xtento_OrderExport (1.3.4)
 * ID:            mJUDsdnuj0QF2iAHyWBW1BRT7TLEsSdABAEYeucwpwE=
 * Packaged:      2013-12-11T00:50:10+00:00
 * Last Modified: 2013-11-08T20:02:33+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Shared/Customer.php
 * Copyright:     Copyright (c) 2013 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Data_Shared_Customer extends Xtento_OrderExport_Model_Export_Data_Abstract
{
    public function getConfiguration()
    {
        // Init cache
        if (!isset($this->_cache['customer_group'])) {
            $this->_cache['customer_group'] = array();
        }
        // Return config
        return array(
            'name' => 'Customer information',
            'category' => 'Customer',
            'description' => 'Export customer information from customer tables.',
            'enabled' => true,
            'apply_to' => array(Xtento_OrderExport_Model_Export::ENTITY_ORDER, Xtento_OrderExport_Model_Export::ENTITY_INVOICE, Xtento_OrderExport_Model_Export::ENTITY_SHIPMENT, Xtento_OrderExport_Model_Export::ENTITY_CREDITMEMO, Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER),
        );
    }

    public function getExportData($entityType, $collectionItem)
    {
        // Set return array
        $returnArray = array();
        // Fetch fields to export
        if ($entityType == Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER) {
            $customer = Mage::getModel('customer/customer')->load($collectionItem->getObject()->getId());
            $this->_writeArray = & $returnArray; // Write on main level
            // Is subscribed to newsletter
            if ($this->fieldLoadingRequired('is_subscribed')) {
                $subscription = Mage::getModel('newsletter/subscriber')->loadByEmail($customer->getEmail());
                if ($subscription->getId()) {
                    $this->writeValue('is_subscribed', $subscription->isSubscribed());
                } else {
                    $this->writeValue('is_subscribed', '0');
                }
            }
        } else {
            $this->_writeArray = & $returnArray['customer']; // Write on customer level
            $order = $collectionItem->getOrder();
            // Is subscribed to newsletter
            if ($this->fieldLoadingRequired('is_subscribed')) {
                $subscription = Mage::getModel('newsletter/subscriber')->loadByEmail($order->getCustomerEmail());
                if ($subscription->getId()) {
                    $this->writeValue('is_subscribed', $subscription->isSubscribed());
                } else {
                    $this->writeValue('is_subscribed', '0');
                }
            }
            // Load customer
            $customer = Mage::getModel('customer/customer')->load($order->getCustomerId());
            if (!$customer || !$customer->getId()) {
                if ($this->getShowEmptyFields()) { // If this is debug mode and no customer was found, still output the customer attribute codes
                    $collection = Mage::getResourceModel('customer/customer_collection')
                        ->addAttributeToSelect('*');
                    $collection->getSelect()->limit(1, 0); // At least one customer must exist for this to work
                    if ($customer = $collection->getFirstItem()) {
                        foreach ($customer->getData() as $key => $value) {
                            if ($key == 'entity_id') {
                                continue;
                            }
                            $this->writeValue($key, NULL);
                        }
                    }
                }
                return $returnArray;
            }
        }

        if ($entityType !== Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER && !$this->fieldLoadingRequired('customer')) {
            return $returnArray;
        }

        // Customer data
        foreach ($customer->getData() as $key => $value) {
            if ($key == 'entity_id') {
                continue;
            }
            $this->writeValue($key, $value);
        }

        // Customer group
        if ($this->fieldLoadingRequired('customer_group')) {
            if (isset($this->_cache['customer_group'][$customer->getGroupId()])) {
                $this->writeValue('customer_group', $this->_cache['customer_group'][$customer->getGroupId()]);
            } else {
                $customerGroup = Mage::getModel('customer/group')->load($customer->getGroupId());
                if ($customerGroup && $customerGroup->getId()) {
                    $this->writeValue('customer_group', $customerGroup->getCustomerGroupCode());
                    $this->_cache['customer_group'][$customer->getGroupId()] = $customerGroup->getCustomerGroupCode();
                }
            }
        }

        // Has this customer purchased yet + order count
        if ($this->fieldLoadingRequired('has_purchased') || $this->fieldLoadingRequired('order_count')) {
            $customerOrders = Mage::getResourceModel('sales/order_collection')
                ->addFieldToSelect('*')
                ->addFieldToFilter('customer_id', $customer->getId());

            $orderCount = $customerOrders->getSize();
            if ($orderCount > 0) {
                $this->writeValue('has_purchased', '1');
                $this->writeValue('order_count', $orderCount);
            } else {
                $this->writeValue('has_purchased', '0');
                $this->writeValue('order_count', '0');
            }
        }

        // Timestamps of creation/update
        /*if ($this->fieldLoadingRequired('created_at_timestamp')) $this->writeValue('created_at_timestamp', Mage::helper('xtento_orderexport/date')->convertDateToStoreTimestamp($customer->getCreatedAt()));
        if ($this->fieldLoadingRequired('updated_at_timestamp')) $this->writeValue('updated_at_timestamp', Mage::helper('xtento_orderexport/date')->convertDateToStoreTimestamp($customer->getUpdatedAt()));*/

        // Customer addresses
        $addressCollection = $customer->getAddressesCollection();
        if (!empty($addressCollection) && $this->fieldLoadingRequired('addresses')) {
            foreach ($addressCollection as $customerAddress) {
                if ($entityType == Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER) {
                    $this->_writeArray = & $returnArray['addresses'][];
                } else {
                    $this->_writeArray = & $returnArray['customer']['addresses'][];
                }
                $customerAddress->explodeStreetAddress();
                foreach ($customerAddress->getData() as $key => $value) {
                    $this->writeValue($key, $value);
                }
                if ($customerAddress->getId() === $customer->getDefaultBilling() && $customerAddress->getId() === $customer->getDefaultShipping()) {
                    $this->writeValue('address_type', 'default_billing_shipping');
                } else if ($customerAddress->getId() === $customer->getDefaultBilling()) {
                    $this->writeValue('address_type', 'default_billing');
                } else if ($customerAddress->getId() === $customer->getDefaultShipping()) {
                    $this->writeValue('address_type', 'default_shipping');
                } else {
                    $this->writeValue('address_type', 'address');
                }
            }
        }

        // Done
        return $returnArray;
    }
}