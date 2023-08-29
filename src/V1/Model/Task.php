<?php

namespace ReydenX\V1\Model;

class Task implements IDecoder
{
    public string $id = '';
    public string $url = '';
    public string $expiresAt = '';

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = $data['id'];
        if (isset($data['url']))
            $this->url = $data['url'];
        if (isset($data['expires_at']))
            $this->expiresAt = $data['expires_at'];
        return $this;
    }
}
