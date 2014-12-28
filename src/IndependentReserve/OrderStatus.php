<?php

namespace IndependentReserve;

class OrderStatus
{
    const OPEN = 'Open';

    const PARTIALLY_FILLED = 'PartiallyFilled';

    const FILLED = 'Filled';

    const PARTIALLY_FILLED_AND_CANCELLED = 'PartiallyFilledAndCancelled';

    const CANCELLED = 'Cancelled';

    const PARTIALLY_FILLED_AND_EXPIRED = 'PartiallyFilledAndExpired';
}
