<?php

namespace ReydenX\V1\Model;

enum Platform
{
    case Twitch;
    case YouTube;
    case Trovo;
    case GoodGame;
    case VkPlay;

    case Kick;

    public function getName(): string
    {
        return strtolower($this->name);
    }
}
