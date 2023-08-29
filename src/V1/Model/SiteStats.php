<?php

namespace ReydenX\V1\Model;

class SiteStats implements IDecoder
{
    public string $domain = '';
    public int $views = 0;
    public int $clicks = 0;
    public float $ctr = 0.0;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['domain']))
            $this->domain = $data['domain'];
        if (isset($data['views']))
            $this->views = intval($data['views']);
        if (isset($data['clicks']))
            $this->clicks = intval($data['clicks']);
        if (isset($data['ctr']))
            $this->ctr = floatval($data['ctr']);
        return $this;
    }
}
