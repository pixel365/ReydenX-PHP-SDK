<?php

namespace ReydenX\V1\Model;

class User implements IDecoder
{
    public int $id;
    public string $userName;
    public string $dateJoined;
    public string $email;
    public bool $isActive;
    public bool $isBlocked;
    public bool $isReseller;
    public string $imageUrl;
    public int $currencyId;
    public int $discountValue;
    public int $twitchId = 0;
    public string $twitchLogin = '';

    public function __construct(array $data)
    {
        $this->decode($data);
    }

    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['id']))
            $this->id = intval($data['id']);
        if (isset($data['username']))
            $this->userName = $data['username'];
        if (isset($data['date_joined']))
            $this->dateJoined = $data['date_joined'];
        if (isset($data['email']))
            $this->email = $data['email'];
        if (isset($data['is_active']))
            $this->isActive = $data['is_active'];
        if (isset($data['is_blocked']))
            $this->isBlocked = $data['is_blocked'];
        if (isset($data['is_reseller']))
            $this->isReseller = $data['is_reseller'];
        if (isset($data['image_url']))
            $this->imageUrl = $data['image_url'];
        if (isset($data['currency_id']))
            $this->currencyId = intval($data['currency_id']);
        if (isset($data['discount_value']))
            $this->discountValue = intval($data['discount_value']);
        if (isset($data['twitch_id']))
            $this->twitchId = intval($data['twitch_id']);
        if (isset($data['twitch_login']))
            $this->twitchLogin = $data['twitch_login'];
        return $this;
    }
}
