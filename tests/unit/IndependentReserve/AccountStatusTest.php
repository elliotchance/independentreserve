<?php

namespace IndependentReserve;

use Concise\TestCase;

class AccountStatusTest extends TestCase
{
    public function testActive()
    {
        $this->assert(AccountStatus::ACTIVE, equals, 'Active');
    }
}
