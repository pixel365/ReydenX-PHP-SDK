<?php

namespace ReydenX\V1\Model;

class SmothGain
{
    public bool $enabled = false;
    public int $minutes = 0;

    /**
     * @param bool $enabled
     * @param int $minutes
     */
    public function __construct(bool $enabled, int $minutes)
    {
        $this->enabled = $enabled;
        $this->minutes = $minutes;
    }
}
