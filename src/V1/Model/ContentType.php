<?php

namespace ReydenX\V1\Model;

enum ContentType
{
    case ContentRoll;
    case PreRoll;

    /**
     * @return string
     */
    public function getName(): string
    {
        return match ($this) {
            ContentType::ContentRoll => 'content-roll',
            self::PreRoll => 'pre-roll',
        };
    }
}
