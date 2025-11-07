<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id', 
        'match_date',
        'venue',
        'home_team_score',
        'away_team_score',
        'status',
        'referee',
        'match_notes'
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    /**
     * Get the home team for the fixture.
     */
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * Get the away team for the fixture.
     */
    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}
