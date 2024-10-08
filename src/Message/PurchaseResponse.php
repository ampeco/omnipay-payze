<?php

namespace Ampeco\OmnipayPayze\Message;

class PurchaseResponse extends Response
{
    public function isSuccessful() : bool
    {
        return parent::isSuccessful()
            && $this->getPayment()
            && isset($this->getPayment()['transactionId'])
            && isset($this->getPayment()['status'])
            && $this->getPayment()['status'] === self::PAYMENT_STATUS_DRAFT;
    }

    public function getTransactionReference(): string
    {
        return $this->getPayment()['transactionId'];
    }

    protected function getPayment(): ?array
    {
        return $this->getDataKey()['payment'] ?? null;
    }
}
