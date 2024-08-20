<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\DomainCheckLog;
use App\Services\CheckDomains\DomainCheckStatus;
use Illuminate\Database\Seeder;

class DomainCheckLogSeeder extends Seeder
{
    private const CHUNKS = 1;
    private const CHUNK_SIZE = 10;

    public function run(): void
    {
        Domain::query()->get()->each(function (Domain $domain) {
            for ($i = 0; $i < self::CHUNKS; $i++) {
                $data = [];
                for ($j = 0; $j < self::CHUNK_SIZE; $j++) {
                    $data[] = [
                        'domain_id' => $domain->id,
                        'status' => DomainCheckStatus::FINISHED,
                        'code' => 200,
                        'error' => '',
                        'content_size' => mt_rand(100, 1000),
                        'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
                    ];
                }
                DomainCheckLog::query()->insert($data);
            }
        });
    }
}
