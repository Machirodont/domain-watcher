<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\DomainGroup;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{

    private const DOMAINS = [
        'search' => [
            'https://yandex.ru',
            'https://rambler.ru',
            'https://gmail.com'
        ],
        'other' => [
            'http://localhost:8080/',
            'http://ww01.404.com/favicon.ico',
        ],
    ];

    public function run(): void
    {
        foreach (self::DOMAINS as $group => $domains) {
            $sequenceData = [];
            foreach ($domains as $domain) {
                $sequenceData[] = ['url' => $domain];
            }

            DomainGroup::factory()
                ->has(
                    Domain::factory()->count(count($sequenceData))->state(
                        new Sequence(...$sequenceData)
                    )
                )
                ->create(['name' => $group]);
        }
    }
}
