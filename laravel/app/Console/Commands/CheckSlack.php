<?php

namespace App\Console\Commands;

use App\Services\SlackConnector\SlackConnector;
use Illuminate\Console\Command;

class CheckSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(
        SlackConnector $slackConnector
    )
    {
        $result = $slackConnector->send('*Test* messages from bot to ```Slack channel```.');
        echo $result->success ? "OK" : $result->error;
        echo "\r\n";
    }
}
