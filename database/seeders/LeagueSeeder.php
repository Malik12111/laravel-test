<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\League;

class LeagueSeeder extends Seeder
{
    public function run(): void
    {
        $leagues = [
            [
                'league_name' => 'Premier Youth Academy League',
                'season' => '2024-2025',
                'age_group' => 'U12',
                'start_date' => '2024-09-01',
                'end_date' => '2025-05-31',
                'status' => 'active',
                'teams_per_group' => 8,
                'description' => 'Elite youth football competition featuring top academy teams'
            ],
            [
                'league_name' => 'Future Stars Development League', 
                'season' => '2024-2025',
                'age_group' => 'U14',
                'start_date' => '2024-08-15',
                'end_date' => '2025-06-15',
                'status' => 'active',
                'teams_per_group' => 12,
                'description' => 'Focus on technical development and sportsmanship'
            ],
            [
                'league_name' => 'Champions Youth Cup',
                'season' => '2024-2025',
                'age_group' => 'U16', 
                'start_date' => '2024-09-10',
                'end_date' => '2025-05-20',
                'status' => 'upcoming',
                'teams_per_group' => 16,
                'description' => 'National youth championship for emerging talents'
            ]
        ];

        foreach ($leagues as $league) {
            League::create($league);
        }
    }
}
