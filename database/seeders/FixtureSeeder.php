<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fixture;
use App\Models\Team;

class FixtureSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::all();
        
        $fixtures = [
            // U12 League Matches
            [
                'home_team_id' => $teams[0]->id, // Arsenal U12
                'away_team_id' => $teams[1]->id, // Chelsea U14 (different age group - will be filtered)
                'match_date' => '2024-11-15 14:00:00',
                'venue' => 'Arsenal Training Centre Pitch 1',
                'home_team_score' => 2,
                'away_team_score' => 1,
                'status' => 'completed',
                'referee' => 'Michael Oliver',
                'match_notes' => 'Excellent technical display from both teams'
            ],
            [
                'home_team_id' => $teams[1]->id, // Chelsea U14
                'away_team_id' => $teams[2]->id, // Man Utd U16
                'match_date' => '2024-11-22 15:30:00',
                'venue' => 'Cobham Training Ground',
                'home_team_score' => 3,
                'away_team_score' => 3,
                'status' => 'completed',
                'referee' => 'Anthony Taylor',
                'match_notes' => 'Thrilling 3-3 draw with late equalizer'
            ],
            [
                'home_team_id' => $teams[2]->id, // Man Utd U16
                'away_team_id' => $teams[3]->id, // Liverpool U10
                'match_date' => '2024-11-29 16:00:00',
                'venue' => 'Carrington Main Pitch',
                'home_team_score' => 4,
                'away_team_score' => 0,
                'status' => 'completed',
                'referee' => 'Paul Tierney',
                'match_notes' => 'Dominant performance from home team'
            ],
            
            // Upcoming Fixtures
            [
                'home_team_id' => $teams[3]->id, // Liverpool U10
                'away_team_id' => $teams[4]->id, // Man City U18
                'match_date' => '2024-12-06 11:00:00',
                'venue' => 'Kirkby Academy Stadium',
                'home_team_score' => null,
                'away_team_score' => null,
                'status' => 'scheduled',
                'referee' => 'Craig Pawson',
                'match_notes' => 'Local derby - expected high intensity'
            ],
            [
                'home_team_id' => $teams[4]->id, // Man City U18
                'away_team_id' => $teams[0]->id, // Arsenal U12
                'match_date' => '2024-12-13 17:00:00',
                'venue' => 'Academy Stadium, Manchester',
                'home_team_score' => null,
                'away_team_score' => null,
                'status' => 'scheduled',
                'referee' => 'Stuart Attwell',
                'match_notes' => 'Top of the table clash'
            ],
            
            // Live Match
            [
                'home_team_id' => $teams[1]->id, // Chelsea U14
                'away_team_id' => $teams[3]->id, // Liverpool U10
                'match_date' => now()->subHours(1),
                'venue' => 'Cobham Training Centre',
                'home_team_score' => 1,
                'away_team_score' => 0,
                'status' => 'live',
                'referee' => 'David Coote',
                'match_notes' => 'Currently in progress - Chelsea leading'
            ],
            
            // Postponed Match
            [
                'home_team_id' => $teams[2]->id, // Man Utd U16
                'away_team_id' => $teams[4]->id, // Man City U18
                'match_date' => '2024-12-20 15:00:00',
                'venue' => 'Old Trafford Academy',
                'home_team_score' => null,
                'away_team_score' => null,
                'status' => 'postponed',
                'referee' => 'Peter Bankes',
                'match_notes' => 'Postponed due to international call-ups'
            ]
        ];

        foreach ($fixtures as $fixture) {
            // Only create fixtures for teams in the same age group
            $homeTeam = Team::find($fixture['home_team_id']);
            $awayTeam = Team::find($fixture['away_team_id']);
            
            if ($homeTeam && $awayTeam && $homeTeam->age_group === $awayTeam->age_group) {
                Fixture::create($fixture);
            }
        }
    }
}
