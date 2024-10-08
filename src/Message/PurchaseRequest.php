<?php

namespace Ampeco\OmnipayPayze\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData(): array
    {
        return [
            'source' => 'Card',
            'amount' =>  $this->getAmount(),
            'currency' => $this->getCurrency(),
            'language' => $this->getLanguage(),
            'idempotencyKey' => $this->getIdempotencyKey(),
            'cardPayment' => [
                'preauthorize' => false,
                'tokenizeCard' => false,
            ],
            'hooks' => [
                'webhookGateway' => $this->getWebhookGateway(),
                'successRedirectGateway' => $this->getSuccessRedirectGateway(),
                'errorRedirectGateway' => $this->getErrorRedirectGateway(),
            ],
            ...$this->getAdditionalData(),
        ];
    }

    protected function getAdditionalData(): array
    {
        return [
            'token' => $this->getToken(),
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }
}
