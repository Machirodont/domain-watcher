<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:check-domains')->everyMinute()->withoutOverlapping();
Schedule::command('app:clear-old-logs')->hourly()->withoutOverlapping();
