<?php

namespace IndependentReserve\Object;

class Account extends AbstractObject
{
    /**
     * Unique identifier of account.
     * @return string
     */
    public function getGuid()
    {
        return $this->object->AccountGuid;
    }

    /**
     * Status of account.
     * @return string
     * @see \IndependentReserve\AccountStatus
     */
    public function getStatus()
    {
        return $this->object->AccountStatus;
    }

    /**
     * Available balance in account to trade or withdraw.
     * @return double
     */
    public function getAvailableBalance()
    {
        return $this->object->AvailableBalance;
    }
}
