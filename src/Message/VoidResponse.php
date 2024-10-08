<?php

namespace Ampeco\OmnipayPayze\Message;

class VoidResponse extends Response
{
    public function isSuccessful(): bool
    {
        return parent::isSuccessful()
            && $this->getDataKey()
            && isset($this->getDataKey()['id']);
    }
}
