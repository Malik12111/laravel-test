<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\Team;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::all();
        
        $players = [
            // Arsenal U12 Players
            ['player_name' => 'Ethan Wright', 'date_of_birth' => '2013-05-15', 'position' => 'Goalkeeper', 'jersey_number' => '1', 'parent_phone' => '+441234567890'],
            ['player_name' => 'Lucas Martinez', 'date_of_birth' => '2013-08-22', 'position' => 'Defender', 'jersey_number' => '4', 'parent_phone' => '+441234567891'],
            ['player_name' => 'Noah Johnson', 'date_of_birth' => '2013-03-10', 'position' => 'Midfielder', 'jersey_number' => '8', 'parent_phone' => '+441234567892'],
            ['player_name' => 'Leo Brown', 'date_of_birth' => '2013-11-05', 'position' => 'Forward', 'jersey_number' => '9', 'parent_phone' => '+441234567893'],
            
            // Chelsea U14 Players  
            ['player_name' => 'James Wilson', 'date_of_birth' => '2011-07-18', 'position' => 'Goalkeeper', 'jersey_number' => '13', 'parent_phone' => '+441234567894'],
            ['player_name' => 'Daniel Taylor', 'date_of_birth' => '2011-04-30', 'position' => 'Defender', 'jersey_number' => '5', 'parent_phone' => '+441234567895'],
            ['player_name' => 'Oliver Davis', 'date_of_birth' => '2011-09-12', 'position' => 'Midfielder', 'jersey_number' => '6', 'parent_phone' => '+441234567896'],
            ['player_name' => 'William Moore', 'date_of_birth' => '2011-12-25', 'position' => 'Forward', 'jersey_number' => '11', 'parent_phone' => '+441234567897'],
            
            // Man Utd U16 Players
            ['player_name' => 'Benjamin Clark', 'date_of_birth' => '2009-02-14', 'position' => 'Goalkeeper', 'jersey_number' => '22', 'parent_phone' => '+441234567898'],
            ['player_name' => 'Samuel Walker', 'date_of_birth' => '2009-06-08', 'position' => 'Defender', 'jersey_number' => '3', 'parent_phone' => '+441234567899'],
            ['player_name' => 'Joseph Hall', 'date_of_birth' => '2009-10-19', 'position' => 'Midfielder', 'jersey_number' => '7', 'parent_phone' => '+441234567800'],
            ['player_name' => 'Henry Lewis', 'date_of_birth' => '2009-01-03', 'position' => 'Forward', 'jersey_number' => '10', 'parent_phone' => '+441234567801'],
        ];

        foreach ($players as $index => $player) {
            $teamIndex = floor($index / 4); // 4 players per team
            if (isset($teams[$teamIndex])) {
                $player['team_id'] = $teams[$teamIndex]->id;
                Player::create($player);
            }
        }
    }
}
