<?php

namespace Database\Factories;

use App\Services\CheckDomains\DomainCheckStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DomainCheckLog>
 */
class DomainCheckLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => DomainCheckStatus::FINISHED,
            'code' => 200,
            'content_size' => 100,
            'error' => '',
        ];
    }
}
