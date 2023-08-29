<?php

namespace ReydenX\V1\Model;

enum Platform
{
    case Twitch;
    case YouTube;
    case Trovo;
    case GoodGame;
    case VkPlay;

    public function getName(): string
    {
        return strtolower($this->name);
    }
}
