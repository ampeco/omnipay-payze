<?php

namespace Ampeco\OmnipayPayze\Message;

use Ampeco\OmnipayPayze\CommonParameters;
use Ampeco\OmnipayPayze\Gateway;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;

abstract class AbstractRequest extends OmniPayAbstractRequest
{
    use CommonParameters;
    protected const API_URL = 'https://payze.io/v2/api';
    protected const PARAM_TRANSACTION_ID = '{transactionId}';

    protected ?Gateway $gateway;

    abstract protected function createResponse(array $data, int $statusCode): Response;

    public function setGateway(Gateway $gateway): self
    {
        $this->gateway = $gateway;
        return $this;
    }

    public function getBaseUrl(): string
    {
        return self::API_URL;
    }

    public function getRequestMethod(): string
    {
        return 'PUT';
    }

    public function getEndpoint(): string
    {
        return '/payment';
    }

    public function sendData($data): Response
    {
        $endpointAdditionalParams = $this->addEndpointAdditionalParams($data);

        $payload = $this->unsetUnnecessaryParams($data);

        $response = $this->httpClient->request(
            $this->getRequestMethod(),
            $this->getBaseUrl() . $endpointAdditionalParams,
            $this->getHeaders(),
            $this->getRequestMethod() !== 'GET' ? json_encode($data) : '',
        );

        $contents = $response->getBody()->getContents();

        return $this->createResponse(
            $contents !== '' ? json_decode($contents, true, flags: JSON_THROW_ON_ERROR) : [],
            $response->getStatusCode(),
        );
    }

    private function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/*+json',
            'Authorization' => sprintf('%s:%s', $this->getApiKey(), $this->getApiSecret()),
        ];
    }

    private function addEndpointAdditionalParams(array $data): string
    {
        $endpoint = $this->getEndpoint();
        if (isset($data['transactionId'])) {
            $endpoint = str_replace(self::PARAM_TRANSACTION_ID, $data['transactionId'], $endpoint);
        }

        return $endpoint;
    }

    private function unsetUnnecessaryParams(array $data): array
    {
        unset($data['transactionId']);

        return $data;
    }
}
