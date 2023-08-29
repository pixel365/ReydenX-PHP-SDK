<?php

namespace ReydenX\V1\Model;

class ActionResult implements IDecoder
{
    public string $requestId = '';
    public int $orderId = 0;
    public string $action = '';
    public int $value = 0;

    public ?Task $task = null;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['request_id']))
            $this->requestId = $data['request_id'];
        if (isset($data['order_id']))
            $this->orderId = intval($data['order_id']);
        if (isset($data['action']))
            $this->action = $data['action'];
        if (isset($data['value']))
            $this->value = intval($data['value']);
        if (isset($data['task']))
            $this->task = new Task($data['task']);
        return $this;
    }
}
