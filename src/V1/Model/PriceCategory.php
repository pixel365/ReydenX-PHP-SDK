<?php

namespace ReydenX\V1\Model;

class PriceCategory implements IDecoder
{
    public int $id = 0;
    public bool $isActive = false;
    public string $name = '';
    public string $description = '';

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = intval($data['id']);
        if (isset($data['is_active']))
            $this->isActive = $data['is_active'];
        if (isset($data['name']))
            $this->name = $data['name'];
        if (isset($data['description']))
            $this->description = $data['description'];
        return $this;
    }
}
