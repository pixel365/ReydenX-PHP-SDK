<?php

namespace ReydenX\V1\Model;

class DateAndQuantityStats implements IDecoder
{
    public string $date = '';

    public int $quantity = 0;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        var_dump($data);
        if (isset($data['date']))
            $this->date = $data['date'];
        if (isset($data['quantity']))
            $this->quantity = intval($data['quantity']);
        return $this;
    }
}
