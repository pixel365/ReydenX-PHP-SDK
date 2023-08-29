<?php

namespace ReydenX\V1\Model;

class OnlineStats implements IDecoder
{
    public string $createdAt = '';

    public int $inSettings = 0;
    public int $inFact = 0;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['created_at']))
            $this->createdAt = $data['created_at'];
        if (isset($data['in_settings']))
            $this->inSettings = intval($data['in_settings']);
        if (isset($data['in_fact']))
            $this->inFact = intval($data['in_fact']);
        return $this;
    }
}
