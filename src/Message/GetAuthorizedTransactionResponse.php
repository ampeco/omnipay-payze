<?php

namespace Ampeco\OmnipayPayze\Message;

class GetAuthorizedTransactionResponse extends GetTransactionResponse
{
    protected const EXPECTED_STATUS = 'Blocked';
}
