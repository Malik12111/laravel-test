<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            [
                'team_name' => 'Arsenal Youth Academy U12',
                'coach_name' => 'Mikel Arteta Jr',
                'age_group' => 'U12',
                'location' => 'London Colney',
                'founded_year' => 2010,
                'contact_email' => 'u12academy@arsenal.com',
                'description' => 'Future Gunners in development'
            ],
            [
                'team_name' => 'Chelsea Blue Lions U14',
                'coach_name' => 'Frank Lampard Jr',
                'age_group' => 'U14', 
                'location' => 'Cobham Training Centre',
                'founded_year' => 2012,
                'contact_email' => 'bluelions@chelseafc.com',
                'description' => 'Developing technical excellence'
            ],
            [
                'team_name' => 'Manchester United Red Devils U16',
                'coach_name' => 'Alex Ferguson Jr',
                'age_group' => 'U16',
                'location' => 'Carrington Training Complex',
                'founded_year' => 2008,
                'contact_email' => 'reddevils@manutd.com',
                'description' => 'The class of future champions'
            ],
            [
                'team_name' => 'Liverpool Young Reds U10',
                'coach_name' => 'Jurgen Klopp Jr', 
                'age_group' => 'U10',
                'location' => 'Kirkby Academy',
                'founded_year' => 2015,
                'contact_email' => 'youngreds@liverpoolfc.com',
                'description' => 'Youll Never Walk Alone - future stars'
            ],
            [
                'team_name' => 'Manchester City Sky Blues U18',
                'coach_name' => 'Pep Guardiola Jr',
                'age_group' => 'U18',
                'location' => 'City Football Academy',
                'founded_year' => 2006,
                'contact_email' => 'skyblues@mancity.com',
                'description' => 'Developing the next generation of champions'
            ]
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
