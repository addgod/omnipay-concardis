<?php

namespace Omnipay\Concardis\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return [
            'merchantId'      => $this->getMerchantId(),
            'transactionId'   => $this->getTransactionReference(),
            'language'        => $this->getLanguage(),
            'notificationUrl' => $this->getNotifyUrl(),
            'successUrl'      => $this->getReturnUrl(),
            'failureUrl'      => $this->getCancelUrl(),
            'paymentUrl'      => $this->getPaymentUrl(),
            'test'            => $this->getTestMode() ? 'test' : '',
        ];
    }
}
