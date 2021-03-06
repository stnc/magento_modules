<?php

/**
 * Mage SMS - SMS notification & SMS marketing
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the BSD 3-Clause License
 * It is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/BSD-3-Clause
 *
 * @category    TOPefekt
 * @package     TOPefekt_Magesms
 * @copyright   Copyright (c) 2012-2015 TOPefekt s.r.o. (http://www.mage-sms.com)
 * @license     http://opensource.org/licenses/BSD-3-Clause
 */
class Topefekt_Magesms_Model_Observer
{
    public function updateOrderTrackingNumber(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        $i5e65dd16263683749d16a84171f719e768ed14b5 = $i417760717250c854293598d2ff07a66629a1946d->getEvent()->getTrack();
        if ($i5e65dd16263683749d16a84171f719e768ed14b5->hasDataChanges() && ($i5e65dd16263683749d16a84171f719e768ed14b5->getData('created_at') == $i5e65dd16263683749d16a84171f719e768ed14b5->getData('updated_at') || $i5e65dd16263683749d16a84171f719e768ed14b5->dataHasChangedFor('track_number'))) {
            if (Mage::registry('magesms_track_obj')) Mage::unregister('magesms_track_obj');
            Mage::register('magesms_track_obj', $i5e65dd16263683749d16a84171f719e768ed14b5);
            Mage::getSingleton('magesms/hooks')->send('updateOrderTrackingNumber', $i5e65dd16263683749d16a84171f719e768ed14b5->getShipment()->getOrder());
        }
        return $this;
    }

    public function newOrder(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        if (!Mage::helper('magesms')->isActive()) return $this;
        if ($i417760717250c854293598d2ff07a66629a1946d->getEvent()->getOrder()->getRelationParentId()) {
            Mage::register('magesms_edit_order', true, true);
            return $this;
        }
        $i69a1201e93806d55c970dfb18feec53d221ba37b = Mage::helper('magesms')->getOptoutProduct();
        if ($i69a1201e93806d55c970dfb18feec53d221ba37b) {
            $if80f0cbea56595a4489db73147386c11bb406a7e = $i417760717250c854293598d2ff07a66629a1946d->getEvent()->getOrder();
            $i705fa7c9639d497e1179d7d5691c212668a8c9c8 = $if80f0cbea56595a4489db73147386c11bb406a7e->getQuote()->getItemByProduct($i69a1201e93806d55c970dfb18feec53d221ba37b);
            if (!$i705fa7c9639d497e1179d7d5691c212668a8c9c8) {
                $ib8129b89cda7dae2cfe1b114353de8ba2385974e = Mage::getModel('magesms/optout_order');
                $ib8129b89cda7dae2cfe1b114353de8ba2385974e->setOrderId($if80f0cbea56595a4489db73147386c11bb406a7e->getId())->setDisabled(1);
                $ib8129b89cda7dae2cfe1b114353de8ba2385974e->save();
            }
        }
        Mage::getSingleton('magesms/hooks')->send('newOrder', $i417760717250c854293598d2ff07a66629a1946d->getOrder());
        return $this;
    }

    public function updateOrderStatus(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        if (Mage::registry('magesms_edit_order')) return $this;
        if ($i417760717250c854293598d2ff07a66629a1946d->getOrder()->getOrigData('status') != $i417760717250c854293598d2ff07a66629a1946d->getOrder()->getData('status')) {
            Mage::getSingleton('magesms/hooks')->send('updateOrderStatus', $i417760717250c854293598d2ff07a66629a1946d->getOrder());
        }
        return $this;
    }

    public function createCreditMemo(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        Mage::getSingleton('magesms/hooks')->send('createCreditMemo', $i417760717250c854293598d2ff07a66629a1946d);
        return $this;
    }

    public function customerRegisterSuccess(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        Mage::getSingleton('magesms/hooks')->send('customerRegisterSuccess', $i417760717250c854293598d2ff07a66629a1946d['customer']);
        return $this;
    }

    public function productStock(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        $i5e65dd16263683749d16a84171f719e768ed14b5 = $i417760717250c854293598d2ff07a66629a1946d->getEvent()->getItem();
        if ($i5e65dd16263683749d16a84171f719e768ed14b5->getManageStock()) {
            if (!($i34b2041d68b0c6d2dfd61d3d36f96caad687688c = Mage::registry('magesms_stock_item_' . $i5e65dd16263683749d16a84171f719e768ed14b5->getProductId()))) {
                $i34b2041d68b0c6d2dfd61d3d36f96caad687688c = $i5e65dd16263683749d16a84171f719e768ed14b5->getOrigData();
            }
            if (!$i34b2041d68b0c6d2dfd61d3d36f96caad687688c) return $this;
            if ($i5e65dd16263683749d16a84171f719e768ed14b5->hasDataChanges()) {
                if ($i34b2041d68b0c6d2dfd61d3d36f96caad687688c['qty'] > 0 && $i5e65dd16263683749d16a84171f719e768ed14b5->getQty() <= 0) Mage::getSingleton('magesms/hooks')->send('productOutOfStock', $i5e65dd16263683749d16a84171f719e768ed14b5);
                if ($i5e65dd16263683749d16a84171f719e768ed14b5->getNotifyStockQty() > $i5e65dd16263683749d16a84171f719e768ed14b5->getQty() && $i34b2041d68b0c6d2dfd61d3d36f96caad687688c['qty'] >= $i5e65dd16263683749d16a84171f719e768ed14b5->getNotifyStockQty()) Mage::getSingleton('magesms/hooks')->send('productLowStock', $i5e65dd16263683749d16a84171f719e768ed14b5);
            }
        }
        return $this;
    }

    public function contactForm(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        if (!Mage::helper('magesms')->isActive()) return $this;
        Mage::getSingleton('magesms/hooks')->send('contactForm', $i417760717250c854293598d2ff07a66629a1946d);
        return $this;
    }

    public function cartAddProductAddOptout(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        if (!Mage::helper('magesms')->isActive()) return $this;
        Mage::helper('magesms')->addOptoutProduct(true);
        return $this;
    }

    public function cartRemoveProductClearOptout(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        if (!Mage::helper('magesms')->isActive()) return $this;
        Mage::helper('magesms')->removeOptoutProduct(true);
        return $this;
    }

    public function lockSkuAttribute(Varien_Event_Observer $i417760717250c854293598d2ff07a66629a1946d)
    {
        if (!Mage::helper('magesms')->isActive()) return $this;
        $ic010a5d08128ec6abcd0a1a16cb1d8abe7bf2142 = Mage::getConfig()->getNode('default/config/optout')->sku;
        $i7fff76b02be2f63877a1782ca871e62a287fa16f = $i417760717250c854293598d2ff07a66629a1946d->getEvent();
        $i69a1201e93806d55c970dfb18feec53d221ba37b = $i7fff76b02be2f63877a1782ca871e62a287fa16f->getProduct();
        if ($i69a1201e93806d55c970dfb18feec53d221ba37b->getSku() == $ic010a5d08128ec6abcd0a1a16cb1d8abe7bf2142) $i69a1201e93806d55c970dfb18feec53d221ba37b->lockAttribute('sku');
        return $this;
    }

    public function cronUpdate()
    {

        if (!Mage::helper('magesms')->isActive()) return $this;
        $last_check = Mage::app()->loadCache('magesms_update_lastcheck');
        $zman = 24 * 3600;
        if (($zman + $last_check) > time()) {
            return $this;
        }
        $SMSuser_profile = Mage::getSingleton('magesms/smsprofile');
       // $user_info = 'action=showlastversion&username=' . urlencode($SMSuser_profile->user->user);
        $user_send_info = array('username' => $SMSuser_profile->user->user, 'pass' => $SMSuser_profile->user->passwd);

        $api_run = Mage::getModel('magesms/api')->serverPost($user_send_info);
        //belki ilerde çalışabilri
     /*if (!empty($api_run) && !empty($api_run['data'][0])) {
            if (version_compare($api_run['data'][0], Mage::getConfig()->getModuleConfig('Topefekt_Magesms')->version) > 0) {
                Mage::app()->saveCache($api_run['data'][0], 'magesms_update_available');
                Mage::log("MageSms cron - new version {$api_run['data'][0]} available");
            } else Mage::app()->saveCache('', 'magesms_update_available');
        }*/
        Mage::app()->saveCache(time(), 'magesms_update_lastcheck');
        Mage::getSingleton('magesms/routes')->updatepricelist();
        Mage::getSingleton('magesms/exceptions')->updateData();
        return $this;
    }
}