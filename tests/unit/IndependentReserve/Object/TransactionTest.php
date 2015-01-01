<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class TransationTest extends TestCase
{
    /**
     * @var Transaction
     */
    protected $transaction;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "Balance" => 199954.27000000,
            "BitcoinTransactionId" => null,
            "BitcoinTransactionOutputIndex" => null,
            "Comment" => null,
            "CreatedTimestampUtc" => "2014-08-03T05:33:48.2354125Z",
            "Credit" => null,
            "CurrencyCode" => "Usd",
            "Debit" => 6.98000000,
            "SettleTimestampUtc" => "2014-08-03T05:36:24.5532653Z",
            "Status" => "Confirmed",
            "Type" => "Brokerage",
        ];

        $this->transaction = Transaction::createFromObject($obj);
    }

    public function testFactorySetsBalance()
    {
        $this->assert($this->transaction->getBalance(), equals, 199954.27);
    }

    public function testFactorySetsBitcoinTransactionId()
    {
        $this->assert($this->transaction->getBitcoinTransactionId(), is_null);
    }
}
