<?php

namespace IndependentReserve\Object;

class FiatWithdrawal extends AbstractObject
{
    /**
     * Unique identifier of this request.
     * @return string
     */
    public function getGuid()
    {
        return $this->object->FiatWithdrawalRequestGuid;
    }
}
