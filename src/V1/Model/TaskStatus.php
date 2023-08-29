<?php

namespace ReydenX\V1\Model;

enum TaskStatus
{
    case Unknown;
    case Pending;
    case Error;
    case InProgress;
    case Completed;
    case ActionRequired;
}
