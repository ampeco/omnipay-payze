<?php

namespace Ampeco\OmnipayPayze\Message;

class GetAuthorizedTransactionRequest extends GetTransactionRequest
{
    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new GetAuthorizedTransactionResponse($this, $data, $statusCode);
    }
}
