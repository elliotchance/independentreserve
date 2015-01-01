<?php

namespace IndependentReserve;

use Concise\TestCase;

class TransactionTypeTest extends TestCase
{
    public function testBrokerage()
    {
        $this->assert(TransactionType::BROKERAGE, equals, 'Brokerage');
    }
}
