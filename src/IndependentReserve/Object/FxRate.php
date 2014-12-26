<?php

namespace IndependentReserve\Object;

class FxRate extends AbstractObject
{
    /**
     * @return string
     */
    public function getCurrencyCodeA()
    {
        return $this->object->CurrencyCodeA;
    }

    /**
     * @return string
     */
    public function getCurrencyCodeB()
    {
        return $this->object->CurrencyCodeB;
    }
}
