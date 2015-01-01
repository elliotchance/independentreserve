<?php

namespace IndependentReserve\Object;

use DateTime;

class BitcoinDepositAddress extends AbstractObject
{
    /**
     * Bitcoin address to use for deposits.
     * @return string
     */
    public function getBitcoinAddress()
    {
        return $this->object->BitcoinAddress;
    }

    /**
     * UTC timestamp of when this address was last checked against Blockchain.
     * @return DateTime
     */
    public function getLastCheckedTimestamp()
    {
        return new DateTime($this->object->LastCheckedTimestampUtc);
    }

    /**
     * UTC timestamp of when this address is scheduled to next be checked against Blockchain.
     * @return DateTime
     */
    public function getNextUpdateTimestamp()
    {
        return new DateTime($this->object->NextUpdateTimestampUtc);
    }
}
