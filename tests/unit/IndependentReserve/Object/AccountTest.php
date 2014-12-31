<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;
use IndependentReserve\AccountStatus;
use IndependentReserve\Currency;

class AccountTest extends TestCase
{
    /**
     * @var Account
     */
    protected $account;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "AccountGuid" => "66dcac65-bf07-4e68-ad46-838f51100424",
            "AccountStatus" => "Active",
            "AvailableBalance" => 45.33400000,
            "CurrencyCode" => "Xbt",
            "TotalBalance" => 46.81000000,
        ];

        $this->account = Account::createFromObject($obj);
    }

    public function testFactorySetsGuid()
    {
        $this->assert($this->account->getGuid(), equals, '66dcac65-bf07-4e68-ad46-838f51100424');
    }

    public function testFactorySetsStatus()
    {
        $this->assert($this->account->getStatus(), equals, AccountStatus::ACTIVE);
    }

    public function testFactorySetsAvailableBalance()
    {
        $this->assert($this->account->getAvailableBalance(), equals, 45.334);
    }

    public function testFactorySetsCurrencyCode()
    {
        $this->assert($this->account->getCurrencyCode(), equals, Currency::XBT);
    }

    public function testFactorySetsTotalBalance()
    {
        $this->assert($this->account->getTotalBalance(), equals, 46.81);
    }
}
