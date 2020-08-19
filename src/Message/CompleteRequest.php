<?php

namespace Omnipay\Concardis\Message;

class CompleteRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompleteResponse($this, $data);
    }
}
