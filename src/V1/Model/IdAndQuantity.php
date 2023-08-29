<?php

namespace ReydenX\V1\Model;

class IdAndQuantity implements IDecoder
{
    public int $id = 0;
    public int $quantity = 0;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = intval($data['id']);
        if (isset($data['quantity']))
            $this->quantity = intval($data['quantity']);
        return $this;
    }
}
