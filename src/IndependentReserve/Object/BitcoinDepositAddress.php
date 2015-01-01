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

    public function getLastCheckedTimestamp()
    {
        return new DateTime();
    }
}
