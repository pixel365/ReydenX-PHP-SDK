<?php

namespace ReydenX\V1\Model;

class Balance implements IDecoder
{
    public int $id;
    public int $amount;
    public int $currencyId;
    public int $userId;
    public int $formattedAmount;
    public string $currency;

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = intval($data['id']);
        if (isset($data['amount']))
            $this->amount = intval($data['amount']);
        if (isset($data['currency_id']))
            $this->currencyId = intval($data['currency_id']);
        if (isset($data['user_id']))
            $this->userId = intval($data['user_id']);
        if (isset($data['formatted_amount']))
            $this->formattedAmount = intval($data['formatted_amount']);
        if (isset($data['currency']))
            $this->currency = $data['currency'];

        return $this;
    }
}
