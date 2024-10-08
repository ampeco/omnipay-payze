<?php

namespace Ampeco\OmnipayPayze\Message;

class GetTransactionResponse extends Response
{
    protected const EXPECTED_STATUS = 'Captured';
    public function isSuccessful() : bool
    {
        return parent::isSuccessful()
            && $this->getDataKey()
            && $this->getDataValue()
            && isset($this->getDataValue()[0])
            && isset($this->getDataValue()[0]['transactionId'])
            && isset($this->getDataValue()[0]['status'])
            && $this->getDataValue()[0]['status'] === static::EXPECTED_STATUS
            && isset($this->getDataValue()[0]['cardPayment']['token'])
            && isset($this->getDataValue()[0]['cardPayment']['cardMask']);
    }

    public function getCardToken(): string
    {
        return $this->getDataValue()[0]['cardPayment']['token'];
    }

    public function getCardMask(): string
    {
        return $this->getDataValue()[0]['cardPayment']['cardMask'];
    }

    public function getCardExpiration(): ?string
    {
        return $this->getDataValue()[0]['cardPayment']['cardExpiration'] ?? null;
    }

    private function getDataValue(): ?array
    {
        return $this->getDataKey()['value'] ?? null;
    }
}
