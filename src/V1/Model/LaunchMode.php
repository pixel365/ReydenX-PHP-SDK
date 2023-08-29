<?php

namespace ReydenX\V1\Model;

enum LaunchMode
{
    case Auto;
    case Manual;
    case Delay;

    public function getName(): string
    {
        return strtolower($this->name);
    }
}
