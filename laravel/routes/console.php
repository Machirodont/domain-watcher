<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:check-domains')->everyMinute()->withoutOverlapping();
