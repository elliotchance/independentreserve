<?php

namespace IndependentReserve\Object;

use Concise\TestCase;

class FiatWithdrawalTest extends TestCase
{
    /**
     * @var FiatWithdrawal
     */
    protected $withdrawal;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "FiatWithdrawalRequestGuid" => "2e9ad56c-1954-4b0f-b3d8-2ade7fad93ff",
            "AccountGuid" => "eda82a84-57fe-4ce6-9ee5-45a41063ee23",
            "Status" => "Pending",
            "CreatedTimestampUtc" => "2014-12-18T14:08:47.4032405Z",
            "TotalWithdrawalAmount" => 50.00,
            "FeeAmount" => 20.00,
            "Currency" => "Usd",
        ];

        $this->withdrawal = FiatWithdrawal::createFromObject($obj);
    }

    public function testFactorySetsGuid()
    {
        $this->assert($this->withdrawal->getGuid(), equals, '2e9ad56c-1954-4b0f-b3d8-2ade7fad93ff');
    }
}