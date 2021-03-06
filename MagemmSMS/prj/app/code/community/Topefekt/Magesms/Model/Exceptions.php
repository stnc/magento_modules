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
class Topefekt_Magesms_Model_Exceptions extends Mage_Core_Model_Abstract
{
    private $v148194b5b9cc653ce2e35e9709e441dc6fd4123a;

    protected function _construct()
    {
        $this->_init('magesms/exceptions');
    }

    public function updateData()
    {
        $Db_kaydet = $this->getCollection();
        $user_info = 'action=showexc&username=' . urlencode(Mage::getSingleton('magesms/smsprofile')->user->user);
      //  $user_info_arr=array('username'=>$this->user->user,'pass'=>$this->user->passwd);
        $i55dd4e7042a1f9031b84f07f04c37165ce3d0720 = Mage::getModel('magesms/api')->serverPost($user_info);
       print_r($i55dd4e7042a1f9031b84f07f04c37165ce3d0720);
       // die("exception die");
        if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 1 && !empty($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'])) {
            $if2363dc4f19bfec9b2f6c8c836b58e55c25e6997 = array();
            foreach ($Db_kaydet as $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f) $if2363dc4f19bfec9b2f6c8c836b58e55c25e6997[$i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getId()] = 1;
            foreach ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'] as $user_info) {
                list($if0177bfe4bf22cfbb3da2ac06eca557829f0a4cd, $i5bf792bc27965e6366ed7dd55d8a4f1216ffd4bc, $i4616676bff4c07942c8542e6b4e0ccf29d473424, $i4de11663a9306b410e28ff008f89a06a42664d88) = explode(',', $user_info);
                $i5bf407a3ecf35ff195a9c7e8f546cfc606253fad = true;
                foreach ($Db_kaydet as $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f) {
                    if ($i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getPrefix() == $if0177bfe4bf22cfbb3da2ac06eca557829f0a4cd && $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getFirstPrefix() == $i5bf792bc27965e6366ed7dd55d8a4f1216ffd4bc && $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getLength() == $i4616676bff4c07942c8542e6b4e0ccf29d473424 && $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getTrim() == $i4de11663a9306b410e28ff008f89a06a42664d88) {
                        unset($if2363dc4f19bfec9b2f6c8c836b58e55c25e6997[$i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getId()]);
                        $i5bf407a3ecf35ff195a9c7e8f546cfc606253fad = false;
                        break;
                    }
                }
                if ($i5bf407a3ecf35ff195a9c7e8f546cfc606253fad === true) {
                    $i7c94c9b9e96dc295bc0fe1b03a5f04b0633533e0 = Mage::getModel('magesms/exceptions');
                    $i7c94c9b9e96dc295bc0fe1b03a5f04b0633533e0->setPrefix($if0177bfe4bf22cfbb3da2ac06eca557829f0a4cd);
                    $i7c94c9b9e96dc295bc0fe1b03a5f04b0633533e0->setFirstPrefix($i5bf792bc27965e6366ed7dd55d8a4f1216ffd4bc);
                    $i7c94c9b9e96dc295bc0fe1b03a5f04b0633533e0->setLength($i4616676bff4c07942c8542e6b4e0ccf29d473424);
                    $i7c94c9b9e96dc295bc0fe1b03a5f04b0633533e0->setTrim($i4de11663a9306b410e28ff008f89a06a42664d88);
                    $i7c94c9b9e96dc295bc0fe1b03a5f04b0633533e0->save();
                }
            }
            foreach ($if2363dc4f19bfec9b2f6c8c836b58e55c25e6997 as $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 => $i3ca4aff6918962dee4a8054ca52f13ef3b6bab08) Mage::getModel('magesms/exceptions')->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538)->delete();
        }
    }

    public function number($i39404799a9171a012cb8b15cd8f27b347aa44a5f, $if0177bfe4bf22cfbb3da2ac06eca557829f0a4cd)
    {
        if ($this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a) $Db_kaydet = $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a; else $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a = $Db_kaydet = $this->getCollection();
        foreach ($Db_kaydet as $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f) {
            if ($i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getPrefix() == $if0177bfe4bf22cfbb3da2ac06eca557829f0a4cd && $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getLength() == strlen($i39404799a9171a012cb8b15cd8f27b347aa44a5f) && $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getFirstPrefix() == substr($i39404799a9171a012cb8b15cd8f27b347aa44a5f, 0, 2)) {
                return $if0177bfe4bf22cfbb3da2ac06eca557829f0a4cd . ($i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getTrim() ? substr($i39404799a9171a012cb8b15cd8f27b347aa44a5f, $i3f4f633cf43d2d0313bcae3ea42defdb5a5dbf8f->getTrim()) : $i39404799a9171a012cb8b15cd8f27b347aa44a5f);
            }
        }
        return $i39404799a9171a012cb8b15cd8f27b347aa44a5f;
    }
}