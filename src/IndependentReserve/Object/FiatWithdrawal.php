<?php

namespace IndependentReserve\Object;

class FiatWithdrawal extends AbstractTimestampedObject
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

    /**
     * Total amount being withdrawn by the user (inlcusive of any fees).
     * @return double
     */
    public function getTotalWithdrawalAmount()
    {
        return $this->object->TotalWithdrawalAmount;
    }
}
