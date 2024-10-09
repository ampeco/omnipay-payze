<?php

namespace Ampeco\OmnipayPayze\Message;

class GetTransactionResponse extends Response
{
    public function isSuccessful() : bool
    {
        return parent::isSuccessful()
            && $this->getDataKey()
            && $this->getDataValue()
            && isset($this->getDataValue()[0])
            && isset($this->getDataValue()[0]['transactionId'])
            && isset($this->getDataValue()[0]['status'])
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

    public function getTransactionStatus(): string
    {
        return $this->getDataValue()[0]['status'];
    }

    private function getDataValue(): ?array
    {
        return $this->getDataKey()['value'] ?? null;
    }
}
