<?php

namespace Ampeco\OmnipayPayze\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    public const EXPECTED_STATUS_CAPTURED = 'Captured';
    public const EXPECTED_STATUS_BLOCKED = 'Blocked';
    public const EXPECTED_STATUS_REFUNDED = 'Refunded';
    public const EXPECTED_STATUS_REJECTED = 'Rejected';
    protected const EXPECTED_STATUS_DRAFT = 'Draft';

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
