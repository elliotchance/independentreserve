<?php

namespace IndependentReserve\Object;

use DateTime;

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

    /**
     * Timestamp in UTC when fiat withdrawal request was created.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime();
    }
}
