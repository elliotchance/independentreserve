<?php

namespace IndependentReserve\Object;

class Transaction extends AbstractObject
{
    /**
     * Running balance in account.
     * @return double
     */
    public function getBalance()
    {
        return $this->object->Balance;
    }
}
