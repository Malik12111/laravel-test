<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Player;
use App\Models\Fixture;
use App\Models\League;
use Carbon\Carbon;

class AcademyMasterSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data in correct order to handle foreign keys
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Fixture::truncate();
        Player::truncate();
        \Illuminate\Support\Facades\DB::table('league_team')->truncate();
        Team::truncate();
        League::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Real Premier League Academy Teams
        $teams = [
            // North London Academies
            [
                'team_name' => 'Arsenal Hale End Academy U18',
                'coach_name' => 'Per Mertesacker',
                'age_group' => 'U18',
                'location' => 'London Colney, Hertfordshire',
                'founded_year' => 1998,
                'contact_email' => 'haleend.academy@arsenal.com',
                'description' => 'Elite development program producing talents like Bukayo Saka and Emile Smith Rowe'
            ],
            [
                'team_name' => 'Tottenham Hotspur U18',
                'coach_name' => 'Ryan Mason',
                'age_group' => 'U18', 
                'location' => 'Hotspur Way, Enfield',
                'founded_year' => 1998,
                'contact_email' => 'academy@tottenhamhotspur.com',
                'description' => 'Developing the next generation of Spurs stars with modern football philosophy'
            ],

            // Manchester Academies
            [
                'team_name' => 'Manchester United Academy U16',
                'coach_name' => 'Travis Binnion',
                'age_group' => 'U16',
                'location' => 'Carrington Training Complex',
                'founded_year' => 1998,
                'contact_email' => 'academy@manutd.co.uk',
                'description' => 'Class of 92 legacy continues with focus on technical excellence'
            ],
            [
                'team_name' => 'Manchester City EDS U18',
                'coach_name' => 'Brian Barry-Murphy',
                'age_group' => 'U18',
                'location' => 'City Football Academy, Manchester',
                'founded_year' => 1998,
                'contact_email' => 'eds@mancity.com',
                'description' => 'Elite Development Squad focusing on possession-based attacking football'
            ],

            // London Rivals
            [
                'team_name' => 'Chelsea Academy U16',
                'coach_name' => 'Ed Brand',
                'age_group' => 'U16',
                'location' => 'Cobham Training Centre',
                'founded_year' => 1998,
                'contact_email' => 'academy@chelseafc.com',
                'description' => 'World-class academy producing Mason Mount, Reece James, and Callum Hudson-Odoi'
            ],
            [
                'team_name' => 'West Ham United Academy U18',
                'coach_name' => 'Kevin Keen',
                'age_group' => 'U18',
                'location' => 'Chadwell Heath Training Ground',
                'founded_year' => 1998,
                'contact_email' => 'academy@westhamunited.co.uk',
                'description' => 'The Academy of Football continues tradition with Declan Rice and Mark Noble legacy'
            ],

            // Merseyside
            [
                'team_name' => 'Liverpool Academy U16',
                'coach_name' => 'Marc Bridge-Wilkinson',
                'age_group' => 'U16',
                'location' => 'Kirkby Academy, Liverpool',
                'founded_year' => 1998,
                'contact_email' => 'academy@liverpoolfc.com',
                'description' => 'Youll Never Walk Alone - developing future Reds with high-intensity philosophy'
            ],
            [
                'team_name' => 'Everton Academy U18',
                'coach_name' => 'Paul Tait',
                'age_group' => 'U18',
                'location' => 'Finch Farm, Halewood',
                'founded_year' => 1998,
                'contact_email' => 'academy@evertonfc.com',
                'description' => 'The Peoples Club academy focusing on local talent development'
            ]
        ];

        $createdTeams = [];
        foreach ($teams as $teamData) {
            $createdTeams[] = Team::create($teamData);
        }

        // Create Realistic Leagues
        $leagues = [
            [
                'league_name' => 'Premier League U18 National',
                'season' => '2024-2025',
                'age_group' => 'U18',
                'start_date' => '2024-08-15',
                'end_date' => '2025-05-15',
                'status' => 'active',
                'teams_per_group' => 8,
                'description' => 'Elite national competition for U18 academy teams across England'
            ],
            [
                'league_name' => 'Premier League U16 Cup',
                'season' => '2024-2025',
                'age_group' => 'U16', 
                'start_date' => '2024-09-01',
                'end_date' => '2025-04-30',
                'status' => 'active',
                'teams_per_group' => 8,
                'description' => 'Knockout cup competition for U16 academy teams'
            ]
        ];

        $createdLeagues = [];
        foreach ($leagues as $leagueData) {
            $createdLeagues[] = League::create($leagueData);
        }

        // Attach teams to leagues based on age groups
        foreach ($createdLeagues as $league) {
            $matchingTeams = array_filter($createdTeams, function($team) use ($league) {
                return $team->age_group === $league->age_group;
            });
            
            foreach ($matchingTeams as $team) {
                $league->teams()->attach($team->id, [
                    'points' => rand(0, 25),
                    'played' => rand(4, 8),
                    'won' => rand(0, 6),
                    'drawn' => rand(0, 3),
                    'lost' => rand(0, 4),
                    'goals_for' => rand(5, 25),
                    'goals_against' => rand(3, 15),
                    'goal_difference' => 0
                ]);
            }
        }

        // Create Real Youth Players with Actual Potential Names
        $players = [];
        $positions = ['Goalkeeper', 'Defender', 'Midfielder', 'Forward'];
        
        foreach ($createdTeams as $team) {
            $playerCount = rand(15, 22); // Real squad sizes
            
            for ($i = 0; $i < $playerCount; $i++) {
                $firstName = $this->getRandomFirstName();
                $lastName = $this->getRandomLastName();
                
                $players[] = [
                    'player_name' => $firstName . ' ' . $lastName,
                    'date_of_birth' => $this->generateDOB($team->age_group),
                    'team_id' => $team->id,
                    'position' => $positions[array_rand($positions)],
                    'jersey_number' => (string)($i + 1),
                    'parent_phone' => '+44 7' . rand(100, 999) . ' ' . rand(100000, 999999),
                    'parent_email' => strtolower($firstName) . '.' . strtolower($lastName) . '@parent.com',
                    'notes' => $this->getPlayerNotes()
                ];
            }
        }

        foreach ($players as $playerData) {
            Player::create($playerData);
        }

        // Create Exciting Fixtures with Realistic Schedule
        $fixtures = [];
        $venues = [
            'Emirates Stadium', 'Old Trafford', 'Etihad Campus', 'Stamford Bridge',
            'Anfield', 'Tottenham Hotspur Stadium', 'London Stadium', 'Goodison Park'
        ];

        $u18Teams = array_filter($createdTeams, fn($team) => $team->age_group === 'U18');
        $u16Teams = array_filter($createdTeams, fn($team) => $team->age_group === 'U16');

        // Create U18 Fixtures
        $this->createLeagueFixtures($u18Teams, $venues, '2024-08-15', $fixtures);
        
        // Create U16 Fixtures  
        $this->createLeagueFixtures($u16Teams, $venues, '2024-09-01', $fixtures);

        foreach ($fixtures as $fixtureData) {
            Fixture::create($fixtureData);
        }

        $this->command->info('🎯 EPIC Academy Data Created!');
        $this->command->info('🏆 Teams: ' . count($createdTeams));
        $this->command->info('👦 Players: ' . count($players)); 
        $this->command->info('📅 Fixtures: ' . count($fixtures));
        $this->command->info('🏅 Leagues: ' . count($createdLeagues));
    }

    private function getRandomFirstName(): string
    {
        $names = ['Ethan', 'Leo', 'Noah', 'Oliver', 'Jack', 'Harry', 'Charlie', 'Thomas', 'William', 'James', 'Daniel', 'Samuel', 'Joseph', 'Benjamin', 'Lucas', 'Alexander', 'Max', 'Isaac', 'Ryan', 'Adam'];
        return $names[array_rand($names)];
    }

    private function getRandomLastName(): string  
    {
        $names = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Wilson', 'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin'];
        return $names[array_rand($names)];
    }

    private function generateDOB(string $ageGroup): string
    {
        $currentYear = (int)date('Y');
        
        return match($ageGroup) {
            'U18' => Carbon::create($currentYear - 17, rand(1, 12), rand(1, 28))->format('Y-m-d'),
            'U16' => Carbon::create($currentYear - 15, rand(1, 12), rand(1, 28))->format('Y-m-d'),
            default => Carbon::create($currentYear - 16, rand(1, 12), rand(1, 28))->format('Y-m-d')
        };
    }

    private function getPlayerNotes(): string
    {
        $notes = [
            'Excellent technical ability, strong left foot',
            'Rapid pace and good crossing ability',
            'Composed on the ball, great vision',
            'Strong in tackle, good positioning',
            'Clinical finisher, good movement',
            'Creative playmaker, set-piece specialist',
            'Athletic goalkeeper, good distribution',
            'Versatile player, can play multiple positions',
            'Leader on the pitch, good communicator',
            'Hard worker, excellent attitude'
        ];
        return $notes[array_rand($notes)];
    }

    private function createLeagueFixtures(array $teams, array $venues, string $startDate, array &$fixtures): void
    {
        $teamIds = array_map(fn($team) => $team->id, $teams);
        $matchDate = Carbon::parse($startDate);
        
        // Create home and away fixtures for each combination
        foreach ($teamIds as $homeTeamId) {
            foreach ($teamIds as $awayTeamId) {
                if ($homeTeamId !== $awayTeamId) {
                    // Determine match status and scores
                    $isPast = $matchDate->isPast();
                    $status = $isPast ? 'completed' : 'scheduled';
                    $homeScore = $isPast ? rand(0, 5) : null;
                    $awayScore = $isPast ? rand(0, 5) : null;
                    
                    $fixtures[] = [
                        'home_team_id' => $homeTeamId,
                        'away_team_id' => $awayTeamId,
                        'match_date' => $matchDate->copy(),
                        'venue' => $venues[array_rand($venues)],
                        'home_team_score' => $homeScore,
                        'away_team_score' => $awayScore,
                        'status' => $status,
                        'referee' => 'Premier League Official',
                        'match_notes' => $this->getMatchNotes($homeScore, $awayScore)
                    ];

                    $matchDate->addDays(3); // Space out matches
                }
            }
        }
    }

    private function getMatchNotes(?int $homeScore, ?int $awayScore): string
    {
        if ($homeScore === null) return 'Upcoming academy fixture';
        
        $descriptions = [
            'Thrilling encounter with end-to-end action',
            'Tactical battle between two well-drilled sides',
            'Dominant performance from the home team',
            'Great comeback in the second half',
            'Youthful energy on display throughout',
            'Technical quality evident from both academies',
            'Physical contest with plenty of challenges',
            'Entertaining match for the academy scouts'
        ];
        
        return $descriptions[array_rand($descriptions)];
    }
}
