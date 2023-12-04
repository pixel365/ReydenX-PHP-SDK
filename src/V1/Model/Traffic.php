<?php

namespace ReydenX\V1\Model;

class Traffic implements IDecoder
{
    public string $code = '';

    public int $quantity = 0;

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['code']))
            $this->code = $data['code'];
        if (isset($data['quantity']))
            $this->quantity = intval($data['quantity']);
        return $this;
    }
}
