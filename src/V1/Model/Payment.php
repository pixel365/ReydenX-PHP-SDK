<?php

namespace ReydenX\V1\Model;

class Payment implements IDecoder
{
    public int $id = 0;
    public string $createdAt = '';
    public string $updatedAt = '';
    public string $payedAt = '';
    public int $orderId = 0;
    public int $amount = 0;

    public string $externalId = '';
    public string $uuid = '';
    public string $receipt = '';

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = intval($data['id']);
        if (isset($data['created_at']))
            $this->createdAt = $data['created_at'];
        if (isset($data['updated_at']))
            $this->updatedAt = $data['updated_at'];
        if (isset($data['payed_at']))
            $this->payedAt = $data['payed_at'];
        if (isset($data['order_id']))
            $this->orderId = intval($data['order_id']);
        if (isset($data['amount']))
            $this->amount = intval($data['amount']);
        if (isset($data['external_id']))
            $this->externalId = $data['external_id'];
        if (isset($data['uuid']))
            $this->uuid = $data['uuid'];
        if (isset($data['receipt']))
            $this->receipt = $data['receipt'];
        return $this;
    }
}
