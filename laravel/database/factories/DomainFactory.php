<?php

namespace Database\Factories;

use App\Services\CheckDomains\DomainStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domain>
 */
class DomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->domainName(),
            'status' => DomainStatus::UNCHECKED,
            'check_rate' => 1,
        ];
    }
}
