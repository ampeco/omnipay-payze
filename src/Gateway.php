<?php

namespace Ampeco\OmnipayPayze;

use Ampeco\OmnipayPayze\Message\AuthorizeRequest;
use Ampeco\OmnipayPayze\Message\CaptureRequest;
use Ampeco\OmnipayPayze\Message\CreateCardNotification;
use Ampeco\OmnipayPayze\Message\CreateCardRequest;
use Ampeco\OmnipayPayze\Message\GetTransactionRequest;
use Ampeco\OmnipayPayze\Message\PurchaseRequest;
use Ampeco\OmnipayPayze\Message\Response;
use Ampeco\OmnipayPayze\Message\VoidRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'Payze';
    }

    public function createCard(array $options = array()): RequestInterface
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function acceptNotification(array $options = array()): CreateCardNotification
    {
        return new CreateCardNotification($options);
    }

    public function void(array $options = array()): RequestInterface
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function purchase(array $options = array()): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function authorize(array $options = array()): RequestInterface
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function capture(array $options = array()): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function getTransaction(array $options = array()): RequestInterface
    {
        return $this->createRequest(GetTransactionRequest::class, $options);
    }

    public function getCreateCardAmount(): float
    {
        return 1;
    }

    public function getCreateCardCurrency(): string
    {
        return 'GEL';
    }

    public function getAvailableCurrencies(): array
    {
        return ['GEL'];
    }

    public function getCapturedTransactionStatus(): string
    {
        return Response::EXPECTED_STATUS_CAPTURED;
    }

    public function getVoidedTransactionStatus(): string
    {
        return Response::EXPECTED_STATUS_REFUNDED;
    }

    public function getAuthorizedTransactionStatus(): string
    {
        return Response::EXPECTED_STATUS_BLOCKED;
    }
}
