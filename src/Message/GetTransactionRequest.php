<?php

namespace Ampeco\OmnipayPayze\Message;

class GetTransactionRequest extends AbstractRequest
{
    public function getRequestMethod(): string
    {
        return 'GET';
    }

    public function getEndpoint(): string
    {
        return sprintf(
            '%s/query/token-based?$filter=transactionId eq \'%s\'',
            parent::getEndpoint(),
            parent::PARAM_TRANSACTION_ID,
        );
    }

    public function getData(): array
    {
        return [
            'transactionId' => $this->getTransactionId(),
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new GetTransactionResponse($this, $data, $statusCode);
    }
}
