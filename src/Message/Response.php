<?php

namespace Ampeco\OmnipayPayze\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    protected const PAYMENT_STATUS_DRAFT = 'Draft';

    public function __construct(RequestInterface $request, array $data, protected int $code)
    {
        parent::__construct($request, $data);
    }

    public function isSuccessful(): bool
    {
        return $this->code == 200
            && $this->getStatusKey()
            && !isset($this->getStatusKey()['errors']);
    }

    protected function getDataKey(): ?array
    {
        return $this->data['data'] ?? null;
    }

    protected function getStatusKey(): ?array
    {
        return $this->data['status'] ?? null;
    }
}
