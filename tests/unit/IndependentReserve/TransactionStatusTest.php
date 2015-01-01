<?php

namespace IndependentReserve;

use Concise\TestCase;

class TransactionStatusTest extends TestCase
{
    public function testConfirmed()
    {
        $this->assert(TransactionStatus::CONFIRMED, equals, 'Confirmed');
    }
}
