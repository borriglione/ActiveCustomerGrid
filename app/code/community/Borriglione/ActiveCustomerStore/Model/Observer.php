<?php
/**
 * @category   Borriglione
 * @package    Borriglione_ActiveCustomerStore
 * @copyright  Copyright (c) 2014 André Herrn <info@andre-herrn.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Borriglione_ActiveCustomerStore_Model_Observer
{
    /**
     * Save custom store_id configurable in the Magento Admin Backend
     *
     * @param Varien_Event_Observer $observer
     */
    public function saveStoreId($observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $requestParameters = $observer->getEvent()->getRequest()->getParams();

        if (isset($requestParameters['account'])
            && isset($requestParameters['account']['store_id'])) {
            $customer->setStoreId($requestParameters['account']['store_id']);
        }
    }

    /**
     * Add store id to grid
     *
     * @param Varien_Event_Observer $observer
     */
    public function addStoreIdToGrid(Varien_Event_Observer $observer)
    {
        $block = $observer->getBlock();

        if (Mage::app()->getRequest()->getControllerName() !== 'customer') {
            return;
        }

        if ($block->getType() !== 'adminhtml/customer_grid') {
            return;
        }

        $helper = Mage::helper('activecustomerstore');

        $block->addColumnAfter(
            'store_id',
            array(
                'header'    => $helper->__('Create In'),
                'align'     => 'center',
                'width'     => '80px',
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view'=> true,
                'display_deleted' => true,
            ),
            'website_id'
        );

        $block->sortColumnsByOrder();
    }


}