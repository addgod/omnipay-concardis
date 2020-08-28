<?php

namespace Omnipay\Concardis\Tests;

use Omnipay\Concardis\Gateway;
use Omnipay\Concardis\Message\CompleteRequest;
use Omnipay\Concardis\Message\RedirectResponse;
use Omnipay\Concardis\Message\PurchaseRequest;
use Omnipay\Tests\GatewayTestCase;

class TestCase extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );

        $this->gateway->initialize([
            'merchantId' => 12345,
            'language'   => 'dk',
        ]);
    }

    public function testGatewayInitialization()
    {
        $this->assertSame(12345, $this->gateway->getMerchantId());

        $this->gateway->setMerchantId(4321);
        $this->assertSame(4321, $this->gateway->getMerchantId());

        $this->assertSame('dk', $this->gateway->getLanguage());

        $this->gateway->setLanguage('se');
        $this->assertSame('se', $this->gateway->getLanguage());
    }

    public function testPurchase()
    {
        $params = [
            'amount'    => 100,
            'returnUrl' => 'http://test.com/return',
            'notifyUrl' => 'http://test.com/notify',
        ];

        $request = $this->gateway->purchase($params);
        $this->assertInstanceOf(PurchaseRequest::class, $request);

        $response = $request->sendData($request->getData());
        $this->assertInstanceOf(RedirectResponse::class, $response);

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());

        $this->assertSame($request->getData(), $response->getRedirectData());
    }

    public function testCompletePurchase()
    {
        $this->getHttpRequest()->request->replace([
            'paymentInstrumentId'      => 'payment_Instrument',
            'orderId'                  => 500,
            'amount'                   => 100.00,
        ]);
        $request = $this->gateway->completePurchase();
        $this->assertInstanceOf(CompleteRequest::class, $request);

        $response = $request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('payment_Instrument', $response->getTransactionId());
        $this->assertSame(500, $response->getTransactionReference());
    }

    public function testCompleteResponse()
    {
        $this->getHttpRequest()->request->replace([
            'paymentInstrumentId' => '',
            'transactionId'       => 1,
        ]);
        $request = $this->gateway->completePurchase();
        $this->assertInstanceOf(CompleteRequest::class, $request);

        $response = $request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('250525', $response->getTransactionReference());
    }
}
