<?php

namespace ReydenX\V1;

use ReydenX\V1\Exceptions\InvalidParamsException;

trait OrderTrait
{
    protected int $orderId = 0;

    /**
     * @return void
     * @throws InvalidParamsException
     */
    protected function checkOrderId(): void
    {
        if ($this->orderId < 1)
            throw new InvalidParamsException('Order ID is required');
    }
}
