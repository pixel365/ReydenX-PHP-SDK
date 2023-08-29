<?php

namespace ReydenX\V1\Model;

class Price implements IDecoder
{
    public int $id = 0;
    public string $name = '';
    public string $format = '';
    public float $price = 0.0;
    public string $description = '';
    public ?MinMaxStep $views = null;
    public ?MinMaxStep $onlineViewers = null;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = intval($data['id']);
        if (isset($data['name']))
            $this->name = $data['name'];
        if (isset($data['format']))
            $this->format = $data['format'];
        if (isset($data['price']))
            $this->price = floatval($data['price']);
        if (isset($data['description']))
            $this->description = $data['description'];
        if (isset($data['views']))
            $this->views = new MinMaxStep($data['views']);
        if (isset($data['online_viewers']))
            $this->onlineViewers = new MinMaxStep($data['online_viewers']);
        return $this;
    }
}
