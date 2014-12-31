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
}
