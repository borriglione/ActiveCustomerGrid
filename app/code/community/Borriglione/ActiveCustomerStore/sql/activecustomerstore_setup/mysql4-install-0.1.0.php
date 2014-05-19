<?php
/**
 * @category   Borriglione
 * @package    Borriglione_ActiveCustomerStore
 * @copyright  Copyright (c) 2014 André Herrn <info@andre-herrn.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$this->startSetup();
$customer = Mage::getModel('customer/customer');

$this->updateAttribute('customer', 'store_id', 'frontend_input', 'select');

$attrSetId = $customer->getResource()->getEntityType()->getDefaultAttributeSetId();
$this->addAttributeToSet('customer', $attrSetId, 'General', 'store_id');

Mage::getSingleton('eav/config')
        ->getAttribute('customer', 'store_id')
        ->setData('used_in_forms', array('adminhtml_customer'))
        ->save();

$this->endSetup();


