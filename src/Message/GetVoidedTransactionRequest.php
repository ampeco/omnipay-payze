<?php

namespace Ampeco\OmnipayPayze\Message;

class GetVoidedTransactionRequest extends GetTransactionRequest
{
    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new GetVoidedTransactionResponse($this, $data, $statusCode);
    }
}
