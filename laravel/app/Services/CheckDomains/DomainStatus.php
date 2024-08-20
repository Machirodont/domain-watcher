<?php

namespace App\Services\CheckDomains;

enum DomainStatus: string
{
    case UNCHECKED = 'unchecked';
    case ONLINE = 'online';
    case OFFLINE = 'offline';

}
