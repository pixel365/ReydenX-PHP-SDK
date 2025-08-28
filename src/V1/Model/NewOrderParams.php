<?php

namespace ReydenX\V1\Model;

use GuzzleHttp\Psr7\Uri;
use ReydenX\V1\Exceptions\InvalidParamsException;
use ReydenX\V1\Exceptions\InvalidUriException;
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
    public int $fixedAllocation = 0;
    public bool $noOverflow = false;

    /**
     * @throws NotImplementedException
     * @throws InvalidParamsException|InvalidUriException
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
            Platform::YouTube, Platform::Kick => 'channel_url',
            default => '',
        };
    }

    /**
     * @throws InvalidParamsException|NotImplementedException|InvalidUriException
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
        if (isset($data['fixed_allocation']))
            $this->fixedAllocation = intval($data['fixed_allocation']);
        if (isset($data['no_overflow']))
            $this->noOverflow = boolval($data['no_overflow']);

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
            case Platform::Kick:
                if (!isset($data['channel_url']))
                    throw new InvalidParamsException('`channel_url` is required');

                $this->contentId = $data['channel_url'];
                if (!strlen($this->contentId))
                    throw new InvalidParamsException('`channel_url` is required');
                break;
            default:
                throw new NotImplementedException();
        }

        if ($this->platform == Platform::YouTube || $this->platform == Platform::Kick) {
            $uri = new Uri($this->contentId);
            if ($uri->getScheme() !== 'https')
                throw new InvalidUriException('invalid URI scheme');
            if (strlen($uri->getPath()) < 1)
                throw new InvalidUriException('invalid URI path');

            if ($this->platform == Platform::YouTube) {
                if (!($uri->getHost() == 'youtube.com' || $uri->getHost() == 'www.youtube.com'))
                    throw new InvalidUriException('invalid URI host');
            }

            if ($this->platform == Platform::Kick) {
                if (!($uri->getHost() == 'kick.com' || $uri->getHost() == 'www.kick.com'))
                    throw new InvalidUriException('invalid URI host');
            }
        }

        return $this;
    }
}
