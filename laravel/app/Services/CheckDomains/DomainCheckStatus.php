<?php

namespace App\Services\CheckDomains;

enum DomainCheckStatus: string
{
    case STARTED = 'started';
    case FINISHED = 'finished';
    case ERROR = 'error';
}
