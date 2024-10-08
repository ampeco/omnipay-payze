<?php

namespace Ampeco\OmnipayPayze\Message;

class CaptureRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return sprintf(
            '%s/capture',
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
        return $this->response = new CaptureResponse($this, $data, $statusCode);
    }
}
