<?php

namespace Ampeco\OmnipayPayze\Message;

class GetVoidedTransactionResponse extends GetTransactionResponse
{
    protected const EXPECTED_STATUS = 'Refunded';
}
