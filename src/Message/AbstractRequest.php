<?php

namespace Omnipay\Concardis\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    public function sendData($data)
    {
        return new RedirectResponse($this, $data);
    }

    public function setMerchantId($value)
    {
        $this->setParameter('merchantId', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setLanguage($value)
    {
        $this->setParameter('lang', $value);
    }

    public function getLanguage()
    {
        return $this->getParameter('lang');
    }

    public function setPaymentUrl($value)
    {
        $this->setParameter('paymentUrl', $value);
    }

    public function getPaymentUrl()
    {
        return $this->getParameter('paymentUrl');
    }
}
