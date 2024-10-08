<?php

namespace Ampeco\OmnipayPayze\Message;

class CaptureResponse extends PurchaseResponse
{
    protected function getPayment(): ?array
    {
        return $this->getDataKey()['capture'] ?? null;
    }
}
