<?php

namespace Ampeco\OmnipayPayze\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends PurchaseResponse implements RedirectResponseInterface
{
    public function isSuccessful() : bool
    {
        return parent::isSuccessful() && isset($this->getPayment()['paymentUrl']);
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    public function getRedirectUrl(): string
    {
        return $this->getPayment()['paymentUrl'];
    }
}
