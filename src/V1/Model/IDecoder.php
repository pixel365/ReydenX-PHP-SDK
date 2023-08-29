<?php

namespace ReydenX\V1\Model;

interface IDecoder
{
    public function decode(array $data, string $model): IDecoder;
}
