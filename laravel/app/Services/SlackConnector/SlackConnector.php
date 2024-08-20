<?php

namespace App\Services\SlackConnector;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SlackConnector
{
    public const SLACK_POST_MESSAGE_URL =  'https://slack.com/api/chat.postMessage';

    public function send(string $message): SlackResponseDto
    {
        $post = [
            "channel" => config('services.slack.notifications.channel'),
            'blocks' => [
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => $message,
                    ]
                ]
            ]
        ];
        try {
            $response = Http::withToken(config('services.slack.notifications.bot_user_oauth_token'))
                ->withBody(json_encode($post))
                ->timeout(10)
                ->post(self::SLACK_POST_MESSAGE_URL);
        } catch (ConnectionException $e) {
            return new SlackResponseDto(false, 'ConnectionException: '.$e->getMessage());
        }

        return SlackResponseDto::createFromHttpResponse($response);
    }
}
