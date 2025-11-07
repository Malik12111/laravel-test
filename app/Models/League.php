<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_name',
        'season',
        'age_group',
        'start_date',
        'end_date',
        'status',
        'teams_per_group',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the teams for the league.
     * This is a many-to-many relationship since leagues can have multiple teams
     * and teams can be in multiple leagues
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'league_team')
                    ->withTimestamps();
    }

    /**
     * Get the fixtures for the league.
     */
    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }
}
