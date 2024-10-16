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

    public function getCardReference(): string
    {
        return $this->getDataValue()[0]['cardPayment']['token'];
    }

    public function getPaymentMethod(): \stdClass
    {
        $paymentMethod = new \stdClass();

        $paymentMethod->imageUrl = '';
        $paymentMethod->last4 = substr($this->getDataValue()[0]['cardPayment']['cardMask'], -4);
        $paymentMethod->cardType = isset($this->getDataValue()[0]['network']) ? $this->getDataValue()[0]['network'] : '';

        if (isset($this->getDataValue()[0]['cardPayment']['cardExpiration'])
            && strlen($this->getDataValue()[0]['cardPayment']['cardExpiration']) === 4) {
            $expireData = $this->getDataValue()[0]['cardPayment']['cardExpiration'];

            $paymentMethod->expirationMonth = (int) substr($expireData, -2);
            $paymentMethod->expirationYear = (int) \DateTime::createFromFormat(
                'y',
                substr($expireData, 0, 2),
            )->format('Y');
        }

        return $paymentMethod;
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
