<?php

namespace Omnipay\Concardis;

use Omnipay\Concardis\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Concardis\Message\AuthorizeRequest;
use Omnipay\Concardis\Message\CompleteRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Concardis';
    }

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'merchantId' => '',
            'lang'       => 'en',
            'paymentUrl' => null,
            'testMode'   => false,
        ];
    }

    /**
     * @param array $parameters
     *
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return CompleteRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CompleteRequest::class, $parameters);
    }

    /**
     * @param array $options
     *
     * @return AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return CompleteRequest
     */
    public function completeAuthorize(array $options = [])
    {
        return $this->createRequest(CompleteRequest::class, $options);
    }

    /**
     * @param array $options
     *
     * @return RefundRequest
     */
    public function acceptNotification(array $options = [])
    {
        return $this->createRequest(CompleteRequest::class, $options);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        $this->setParameter('merchantId', $value);
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
