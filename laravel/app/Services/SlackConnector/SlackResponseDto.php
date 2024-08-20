<?php

namespace App\Services\SlackConnector;


use Illuminate\Http\Client\Response;

class SlackResponseDto
{
    public function __construct(
        public bool $success,
        public ?string $error,

    ) {
    }

    public static function createFromHttpResponse(Response $rawResponse): self
    {
        $response = json_decode($rawResponse, true);
        if(!is_array($response)) {
            return new self(false, 'Slack response is not a valid JSON');
        }

        return new self(
            isset($response['ok']) && $response['ok'] === true,
            $response['error'] ?? null,
        );
    }
}
