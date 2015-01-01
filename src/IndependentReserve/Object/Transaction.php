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

    /**
     * Related Bitcoin network transaction.
     * @return string|null
     */
    public function getBitcoinTransactionId()
    {
        return $this->object->BitcoinTransactionId;
    }

    /**
     * Related Bitcoin network transaction output index.
     * @return string|null
     */
    public function getBitcoinTransactionOutputIndex()
    {
        return $this->object->BitcoinTransactionOutputIndex;
    }

    /**
     * Comments related to transaction.
     * @return string|null
     */
    public function getComment()
    {
        return $this->object->Comment;
    }
}
