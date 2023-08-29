<?php

namespace ReydenX\V1\Model;

class MinMaxStep
{
    public int $min = 0;
    public int $max = 0;
    public int $step = 0;

    public function __construct(array $data)
    {
        if (isset($data['min']))
            $this->min = intval($data['min']);
        if (isset($data['max']))
            $this->max = intval($data['max']);
        if (isset($data['step']))
            $this->step = intval($data['step']);
    }
}
