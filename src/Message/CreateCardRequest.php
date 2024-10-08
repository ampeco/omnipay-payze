<?php

namespace Ampeco\OmnipayPayze\Message;

class CreateCardRequest extends PurchaseRequest
{
    public function getData(): array
    {
        return [
            ...parent::getData(),
            'cardPayment' => [
                'preauthorize' => false,
                'tokenizeCard' => true,
            ],
        ];
    }

    protected function getAdditionalData(): array
    {
        return [];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new CreateCardResponse($this, $data, $statusCode);
    }
}
