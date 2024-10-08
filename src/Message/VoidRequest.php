<?php

namespace Ampeco\OmnipayPayze\Message;

class VoidRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return sprintf(
            '%s/refund',
            parent::getEndpoint(),
        );
    }

    public function getData(): array
    {
        return [
            'transactionId' => $this->getTransactionId(),
            'amount' =>  $this->getAmount(),
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new VoidResponse($this, $data, $statusCode);
    }
}
