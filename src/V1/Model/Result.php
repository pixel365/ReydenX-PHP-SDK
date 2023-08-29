<?php

namespace ReydenX\V1\Model;

class Result implements IDecoder
{
    public ?string $requestId = null;
    public bool $isCached = false;
    public ?string $cacheExpiresAt = null;
    public array|null $result = null;
    public ?string $cursor = null;

    public function hasNext(): bool
    {
        return !is_null($this->cursor) && strlen($this->cursor) > 0;
    }

    public function __construct(array $data, string $model)
    {
        $this->decode($data, $model);
    }

    public function decode(array $data, string $model): static
    {
        if (isset($data['request_id']))
            $this->requestId = $data['request_id'];
        if (isset($data['cached']))
            $this->isCached = $data['cached'];
        if (isset($data['cache_expires_at']))
            $this->cacheExpiresAt = $data['cache_expires_at'];
        $this->cursor = null;
        $this->result = [];

        if (isset($data['result']) && is_array($data['result'])) {
            if (is_array($data['result'][0])) {
                if (isset($data['cursor']))
                    $this->cursor = $data['cursor'];

                if (count($data['result'][0]) > 0) {
                    foreach ($data['result'] as $item)
                        $this->result[] = new $model($item);
                }
            } else {
                $this->result[] = new $model($data['result']);
            }
        }
        return $this;
    }
}
