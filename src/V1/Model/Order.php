<?php

namespace ReydenX\V1\Model;

class Order implements IDecoder
{
    public int $id = 0;
    public string $createdAt = '';
    public string $updatedAt = '';
    public string $uuid = '';
    public string $status = '';
    public int $orderedViews = 0;
    public float $pricePerView = 0.0;
    public bool $isAutostart = false;
    public int $onlineUsersLimit = 0;

    public ?Platform $platform = null;
    public ?ContentType $contentType = null;
    public ?array $parameters = null;
    public ?array $extras = null;
    public ?array $statistics = null;

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
        if (isset($data['uuid']))
            $this->uuid = $data['uuid'];
        if (isset($data['status']))
            $this->status = $data['status'];
        if (isset($data['ordered_view_qty']))
            $this->orderedViews = intval($data['ordered_view_qty']);
        if (isset($data['price_per_view']))
            $this->pricePerView = floatval($data['price_per_view']);
        if (isset($data['is_autostart']))
            $this->isAutostart = intval($data['is_autostart']) > 0;
        if (isset($data['online_users_limit']))
            $this->onlineUsersLimit = intval($data['online_users_limit']);
        if (isset($data['platform']))
            switch ($data['platform']) {
                case 'twitch':
                    $this->platform = Platform::Twitch;
                    break;
                case 'youtube':
                    $this->platform = Platform::YouTube;
                    break;
                case 'trovo':
                    $this->platform = Platform::Trovo;
                    break;
                case 'goodgame':
                    $this->platform = Platform::GoodGame;
                    break;
                case 'vkplay':
                    $this->platform = Platform::VkPlay;
                    break;
            }
        if (isset($data['content_type']))
            switch ($data['content_type']) {
                case 'pre-roll':
                    $this->contentType = ContentType::PreRoll;
                    break;
                case 'content-roll':
                    $this->contentType = ContentType::ContentRoll;
                    break;
            }
        if (isset($data['parameters']))
            $this->parameters = $data['parameters'];
        if (isset($data['extras']))
            $this->extras = $data['extras'];
        if (isset($data['statistics']))
            $this->statistics = $data['statistics'];
        return $this;
    }
}
