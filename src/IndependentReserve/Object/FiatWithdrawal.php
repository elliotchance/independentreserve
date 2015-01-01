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

    /**
     * Independent Reserve account to withdraw from.
     * @return string
     */
    public function getAccountGuid()
    {
        return $this->object->AccountGuid;
    }

    /**
     * Request status in the workflow.
     * @return string
     */
    public function getStatus()
    {
        return $this->object->Status;
    }
}
