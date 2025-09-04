<?php

declare(strict_types=1);

namespace App;

enum Commands: string
{
    case play = 'start';
    case stop = 'stop';
}
