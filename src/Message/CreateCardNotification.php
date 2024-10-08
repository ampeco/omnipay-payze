<?php

namespace Ampeco\OmnipayPayze\Message;

use Ampeco\OmnipayKapitalbankJson\Message\Response;
use Omnipay\Common\Message\NotificationInterface;

class CreateCardNotification implements NotificationInterface
{
    public function __construct(protected array $data)
    {
    }

    public function getData(): string
    {
        return json_encode($this->data);
    }

    public function getTransactionReference(): ?string
    {
        return $this->data['payment_transaction_id'] ?? null;
    }

    public function getTransactionStatus(): string
    {
        return isset($this->data['payment_transaction_id']) ? self::STATUS_COMPLETED : self::STATUS_FAILED;
    }

    public function getMessage(): string
    {
        return json_encode($this->data);
    }
}

