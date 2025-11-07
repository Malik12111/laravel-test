<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use App\Models\Fixture;
use App\Models\League;

class DashboardController extends Controller
{
    public function index()
    {
        // Get live data for the dashboard
        $totalTeams = Team::count();
        $totalPlayers = Player::count();
        $totalLeagues = League::count();
        
        // Live matches (matches happening today or status live)
        $liveMatches = Fixture::with(['homeTeam', 'awayTeam'])
                            ->where('status', 'live')
                            ->orWhereDate('match_date', today())
                            ->orderBy('match_date', 'asc')
                            ->limit(3)
                            ->get();

        // Recent completed matches
        $recentMatches = Fixture::with(['homeTeam', 'awayTeam'])
                              ->where('status', 'completed')
                              ->orderBy('match_date', 'desc')
                              ->limit(4)
                              ->get();

        // Upcoming matches
        $upcomingMatches = Fixture::with(['homeTeam', 'awayTeam'])
                                ->where('status', 'scheduled')
                                ->where('match_date', '>', now())
                                ->orderBy('match_date', 'asc')
                                ->limit(4)
                                ->get();

        // Top players (mock data for now - would be based on real stats)
        $topPlayers = Player::with('team')
                          ->inRandomOrder() // For demo - would be based on goals/assists
                          ->limit(6)
                          ->get();

        // League standings (active leagues)
        $activeLeagues = League::with(['teams'])
                             ->where('status', 'active')
                             ->get();

        // Quick stats
        $totalGoals = Fixture::where('status', 'completed')
                           ->sum(\DB::raw('COALESCE(home_team_score, 0) + COALESCE(away_team_score, 0)'));
        
        $matchesPlayed = Fixture::where('status', 'completed')->count();
        $matchesLive = Fixture::where('status', 'live')->count();

        return view('dashboard', compact(
            'totalTeams',
            'totalPlayers', 
            'totalLeagues',
            'liveMatches',
            'recentMatches',
            'upcomingMatches',
            'topPlayers',
            'activeLeagues',
            'totalGoals',
            'matchesPlayed',
            'matchesLive'
        ));
    }
}
