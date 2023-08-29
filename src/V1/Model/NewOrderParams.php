<?php

namespace ReydenX\V1\Model;

use ReydenX\V1\Exceptions\InvalidParamsException;
use ReydenX\V1\Exceptions\NotImplementedException;

class NewOrderParams implements IDecoder
{
    public Platform $platform;
    public int $priceId = 0;
    public int $numberOfViews = 0;
    public int $numberOfViewers = 0;
    public LaunchMode $launchMode = LaunchMode::Auto;
    public ?SmothGain $smothGain = null;
    public int $delayTime = 0;
    public string|int $contentId = 0;

    /**
     * @throws NotImplementedException
     * @throws InvalidParamsException
     */
    public function __construct(array $data, string $model = self::class)
    {
        $this->decode($data, $model);
    }

    /**
     * @return string Platform slug
     */
    public function contentIdKey(): string
    {
        return match ($this->platform) {
            Platform::Twitch => 'twitch_id',
            Platform::YouTube => 'channel_url',
            default => '',
        };
    }

    /**
     * @throws InvalidParamsException
     * @throws NotImplementedException
     */
    public function decode(array $data, string $model = self::class): static
    {
        if (isset($data['platform']))
            $this->platform = $data['platform'];
        if (isset($data['price_id']))
            $this->priceId = intval($data['price_id']);
        if (isset($data['number_of_views']))
            $this->numberOfViews = intval($data['number_of_views']);
        if (isset($data['number_of_viewers']))
            $this->numberOfViewers = intval($data['number_of_viewers']);
        if (isset($data['launch_mode']))
            $this->launchMode = $data['launch_mode'];
        if (isset($data['smooth_gain'])) {
            $this->smothGain = $data['smooth_gain'];
        } else {
            $this->smothGain = new SmothGain(false, 0);
        }
        if (isset($data['delay_time']))
            $this->delayTime = intval($data['delay_time']);

        switch ($this->platform) {
            case Platform::Twitch:
                if (!isset($data['twitch_id']))
                    throw new InvalidParamsException('`twitch_id` is required');

                $this->contentId = intval($data['twitch_id']);
                if ($this->contentId < 1) {
                    throw new InvalidParamsException('`twitch_id` must be greater than zero');
                }
                break;
            case Platform::YouTube:
                if (!isset($data['channel_url']))
                    throw new InvalidParamsException('`channel_url` is required');

                $this->contentId = $data['channel_url'];
                if (!strlen($this->contentId))
                    throw new InvalidParamsException('`channel_url` is required');
                break;
            default:
                throw new NotImplementedException();
        }
        return $this;
    }
}
