<?php

namespace Omnipay\Concardis\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompleteResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['paymentInstrumentId']) && is_string($this->data['paymentInstrumentId']);
    }

    public function getTransactionReference()
    {
        return $this->data['paymentInstrumentId'] ?? null;
    }

    public function getTransactionId()
    {
        return $this->data['transactionId'] ?? null;
    }
}
