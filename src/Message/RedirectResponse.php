<?php

namespace Omnipay\Concardis\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class RedirectResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function __construct($purchaseRequest, $data)
    {
        parent::__construct($purchaseRequest, $data);
    }

    /**
     * Gets the redirect target url.
     */
    public function getRedirectUrl()
    {
        return $this->getData()['paymentUrl'] ?? null;
    }

    /**
     * Get the required redirect method (either GET or POST).
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     */
    public function getRedirectData()
    {
        return $this->getData();
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }
}
