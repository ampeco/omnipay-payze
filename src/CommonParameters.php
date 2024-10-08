<?php

namespace Ampeco\OmnipayPayze;

trait CommonParameters
{
    public function setApiKey($value): void
    {
        $this->setParameter('apiKey', $value);
    }

    public function getApiKey(): string
    {
        return $this->getParameter('apiKey');
    }

    public function setApiSecret($value): void
    {
        $this->setParameter('apiSecret', $value);
    }

    public function getApiSecret(): string
    {
        return $this->getParameter('apiSecret');
    }

    public function setLanguage($value): void
    {
        $this->setParameter('language', $value);
    }

    public function getLanguage(): string
    {
        return strtoupper($this->getParameter('language'));
    }

    public function setIdempotencyKey($value): void
    {
        $this->setParameter('idempotencyKey', $value);
    }

    public function getIdempotencyKey(): string
    {
        return $this->getParameter('idempotencyKey');
    }

    public function setWebhookGateway($value): void
    {
        $this->setParameter('webhookGateway', $value);
    }

    public function getWebhookGateway(): string
    {
        return $this->getParameter('webhookGateway');
    }

    public function setSuccessRedirectGateway($value): void
    {
        $this->setParameter('successRedirectGateway', $value);
    }

    public function getSuccessRedirectGateway(): string
    {
        return $this->getParameter('successRedirectGateway');
    }

    public function setErrorRedirectGateway($value): void
    {
        $this->setParameter('errorRedirectGateway', $value);
    }

    public function getErrorRedirectGateway(): string
    {
        return $this->getParameter('errorRedirectGateway');
    }
}
