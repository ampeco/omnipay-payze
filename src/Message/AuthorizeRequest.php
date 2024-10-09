<?php

namespace Ampeco\OmnipayPayze\Message;

class AuthorizeRequest extends PurchaseRequest
{
    public function getData(): array
    {
        return [
            ...parent::getData(),
            'cardPayment' => [
                'preauthorize' => true,
                'tokenizeCard' => false,
            ],
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
