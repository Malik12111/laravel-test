<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        'coach_name',
        'age_group',
        'location',
        'founded_year',
        'team_logo',
        'description',
        'contact_email',
        'contact_phone'
    ];

    /**
     * Get the players for the team.
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * Get the home fixtures for the team.
     */
    public function homeFixtures()
    {
        return $this->hasMany(Fixture::class, 'home_team_id');
    }

    /**
     * Get the away fixtures for the team.
     */
    public function awayFixtures()
    {
        return $this->hasMany(Fixture::class, 'away_team_id');
    }

    /**
     * Get all fixtures for the team.
     */
    public function fixtures()
    {
        return $this->homeFixtures->merge($this->awayFixtures);
    }

    /**
     * Get the leagues that the team belongs to.
     */
    public function leagues()
    {
        return $this->belongsToMany(League::class, 'league_team')
                    ->withTimestamps();
    }
}
