<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcademyLeague Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-blue-900 min-h-screen" style="font-family: 'Exo 2', sans-serif;">
    
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
        <div class="absolute top-1/4 right-20 w-6 h-6 bg-green-400 rounded-full animate-bounce"></div>
        <div class="absolute bottom-20 left-1/4 w-3 h-3 bg-red-400 rounded-full animate-pulse"></div>
        <div class="absolute top-3/4 right-1/3 w-5 h-5 bg-blue-400 rounded-full animate-ping"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-8">
        
        <!-- Header with Glitch Effect -->
        <div class="text-center mb-12 relative">
            <div class="glitch-wrapper">
                <h1 class="glitch text-6xl font-black text-white mb-4" data-text="ACADEMY COMMAND">
                    ACADEMY COMMAND
                </h1>
            </div>
            <p class="text-xl text-cyan-300 mb-2 font-light tracking-wider">REAL-TIME FOOTBALL INTELLIGENCE DASHBOARD</p>
            <div class="flex justify-center space-x-6 text-sm text-gray-300">
                <span class="flex items-center"><div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div> SYSTEMS ONLINE</span>
                <span class="flex items-center"><div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div> DATA STREAMING</span>
                <span class="flex items-center"><div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div> AI ANALYSIS ACTIVE</span>
            </div>
        </div>

        <!-- Main Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Teams Stat -->
            <div class="stats-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 shadow-2xl">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-4xl font-bold font-orbitron">{{ $totalTeams }}</div>
                        <div class="text-blue-100 text-sm uppercase tracking-wider">ACADEMY TEAMS</div>
                    </div>
                    <i class="fas fa-users text-3xl opacity-80"></i>
                </div>
                <div class="mt-4 w-full bg-blue-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full" style="width: {{ ($totalTeams/10)*100 }}%"></div>
                </div>
            </div>

            <!-- Players Stat -->
            <div class="stats-card bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 shadow-2xl">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-4xl font-bold font-orbitron">{{ $totalPlayers }}</div>
                        <div class="text-green-100 text-sm uppercase tracking-wider">YOUNG STARS</div>
                    </div>
                    <i class="fas fa-running text-3xl opacity-80"></i>
                </div>
                <div class="mt-4 w-full bg-green-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full" style="width: {{ ($totalPlayers/50)*100 }}%"></div>
                </div>
            </div>

            <!-- Leagues Stat -->
            <div class="stats-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 shadow-2xl">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-4xl font-bold font-orbitron">{{ $totalLeagues }}</div>
                        <div class="text-purple-100 text-sm uppercase tracking-wider">TOURNAMENTS</div>
                    </div>
                    <i class="fas fa-trophy text-3xl opacity-80"></i>
                </div>
                <div class="mt-4 w-full bg-purple-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full" style="width: {{ ($totalLeagues/5)*100 }}%"></div>
                </div>
            </div>

            <!-- Goals Stat -->
            <div class="stats-card bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 shadow-2xl">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-4xl font-bold font-orbitron">{{ $totalGoals }}</div>
                        <div class="text-red-100 text-sm uppercase tracking-wider">GOALS SCORED</div>
                    </div>
                    <i class="fas fa-futbol text-3xl opacity-80"></i>
                </div>
                <div class="mt-4 w-full bg-red-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full" style="width: {{ ($totalGoals/100)*100 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
            
            <!-- Left Column: Live Matches & Top Players -->
            <div class="xl:col-span-2 space-y-8">
                
                <!-- Live Matches Section -->
                <div class="bg-gray-800 bg-opacity-50 rounded-2xl p-6 border border-cyan-500 border-opacity-30">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-cyan-400 flex items-center">
                            <i class="fas fa-satellite-dish mr-3 text-yellow-400"></i>
                            LIVE MATCH TRACKER
                        </h2>
                        <div class="flex items-center bg-red-500 px-3 py-1 rounded-full">
                            <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                            <span class="text-white text-sm font-bold">LIVE FEED</span>
                        </div>
                    </div>

                    @if($liveMatches->count() > 0)
                    <div class="space-y-4">
                        @foreach($liveMatches as $match)
                        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl p-4 border border-green-500 border-opacity-50 transform hover:scale-105 transition-all duration-300">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-green-400 text-sm font-bold">{{ $match->venue }}</span>
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold animate-pulse">
                                    LIVE • {{ \Carbon\Carbon::parse($match->match_date)->diffForHumans() }}
                                </span>
                            </div>
                            <div class="grid grid-cols-3 items-center text-center">
                                <div class="text-white font-bold text-lg">{{ $match->homeTeam->team_name }}</div>
                                <div class="text-3xl font-black text-yellow-400">
                                    {{ $match->home_team_score ?? '0' }} - {{ $match->away_team_score ?? '0' }}
                                </div>
                                <div class="text-white font-bold text-lg">{{ $match->awayTeam->team_name }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <i class="fas fa-clock text-4xl text-gray-500 mb-4"></i>
                        <p class="text-gray-400">No live matches at the moment</p>
                        <p class="text-gray-500 text-sm">Next match starts soon</p>
                    </div>
                    @endif
                </div>

                <!-- Top Players Carousel -->
                <div class="bg-gray-800 bg-opacity-50 rounded-2xl p-6 border border-purple-500 border-opacity-30">
                    <h2 class="text-2xl font-bold text-purple-400 flex items-center mb-6">
                        <i class="fas fa-star mr-3 text-yellow-400"></i>
                        ELITE PROSPECTS
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($topPlayers as $player)
                        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-xl p-4 text-center transform hover:scale-110 transition-all duration-300 border border-yellow-500 border-opacity-30">
                            <div class="w-16 h-16 bg-yellow-500 rounded-full mx-auto mb-3 flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($player->player_name, 0, 1) }}
                            </div>
                            <h3 class="text-white font-bold text-sm mb-1">{{ $player->player_name }}</h3>
                            <p class="text-yellow-400 text-xs mb-2">{{ $player->position }}</p>
                            <p class="text-gray-400 text-xs">{{ $player->team->team_name }}</p>
                            <div class="mt-2 bg-gray-600 rounded-full h-1">
                                <div class="bg-green-400 h-1 rounded-full" style="width: {{ rand(70, 95) }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Upcoming & Quick Stats -->
            <div class="space-y-8">
                
                <!-- Upcoming Matches -->
                <div class="bg-gray-800 bg-opacity-50 rounded-2xl p-6 border border-blue-500 border-opacity-30">
                    <h2 class="text-2xl font-bold text-blue-400 flex items-center mb-6">
                        <i class="fas fa-rocket mr-3"></i>
                        NEXT LAUNCHES
                    </h2>
                    <div class="space-y-4">
                        @foreach($upcomingMatches as $match)
                        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl p-4 border border-blue-500 border-opacity-30">
                            <div class="text-center text-blue-300 text-sm mb-2">
                                {{ \Carbon\Carbon::parse($match->match_date)->format('M j • H:i') }}
                            </div>
                            <div class="text-center space-y-2">
                                <div class="text-white font-semibold">{{ $match->homeTeam->team_name }}</div>
                                <div class="text-gray-400 text-lg">VS</div>
                                <div class="text-white font-semibold">{{ $match->awayTeam->team_name }}</div>
                            </div>
                            <div class="text-center mt-3">
                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs">
                                    {{ $match->venue }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gray-800 bg-opacity-50 rounded-2xl p-6 border border-green-500 border-opacity-30">
                    <h2 class="text-2xl font-bold text-green-400 flex items-center mb-6">
                        <i class="fas fa-bolt mr-3"></i>
                        QUICK COMMANDS
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/teams" class="cmd-btn bg-blue-600 hover:bg-blue-700 rounded-xl p-4 text-white text-center transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-users text-2xl mb-2"></i>
                            <div class="font-bold">TEAMS</div>
                        </a>
                        <a href="/players" class="cmd-btn bg-green-600 hover:bg-green-700 rounded-xl p-4 text-white text-center transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-running text-2xl mb-2"></i>
                            <div class="font-bold">PLAYERS</div>
                        </a>
                        <a href="/fixtures" class="cmd-btn bg-red-600 hover:bg-red-700 rounded-xl p-4 text-white text-center transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-calendar text-2xl mb-2"></i>
                            <div class="font-bold">FIXTURES</div>
                        </a>
                        <a href="/leagues" class="cmd-btn bg-purple-600 hover:bg-purple-700 rounded-xl p-4 text-white text-center transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-trophy text-2xl mb-2"></i>
                            <div class="font-bold">LEAGUES</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Results -->
        <div class="bg-gray-800 bg-opacity-50 rounded-2xl p-6 border border-yellow-500 border-opacity-30 mb-8">
            <h2 class="text-2xl font-bold text-yellow-400 flex items-center mb-6">
                <i class="fas fa-chart-line mr-3"></i>
                RECENT BATTLE RESULTS
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recentMatches as $match)
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl p-4 border border-gray-600">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($match->match_date)->format('M j, Y') }}</span>
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">COMPLETED</span>
                    </div>
                    <div class="grid grid-cols-3 items-center text-center">
                        <div class="text-white font-semibold">{{ $match->homeTeam->team_name }}</div>
                        <div class="text-2xl font-bold text-white">
                            {{ $match->home_team_score }} - {{ $match->away_team_score }}
                        </div>
                        <div class="text-white font-semibold">{{ $match->awayTeam->team_name }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-gray-500 text-sm">
            <div class="flex justify-center space-x-6 mb-4">
                <span class="flex items-center"><i class="fas fa-database mr-2"></i> DATA STREAM ACTIVE</span>
                <span class="flex items-center"><i class="fas fa-shield-alt mr-2"></i> SYSTEMS SECURE</span>
                <span class="flex items-center"><i class="fas fa-sync-alt mr-2 animate-spin"></i> REAL-TIME SYNC</span>
            </div>
            <p>ACADEMY COMMAND CENTER • POWERED BY LARAVEL 12 • {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <!-- Glitch Effect Styles -->
    <style>
        .glitch-wrapper {
            position: relative;
            display: inline-block;
        }
        .glitch {
            position: relative;
            font-family: 'Orbitron', monospace;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .glitch::before,
        .glitch::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .glitch::before {
            left: 2px;
            text-shadow: -2px 0 #ff00c1;
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim 5s infinite linear alternate-reverse;
        }
        .glitch::after {
            left: -2px;
            text-shadow: -2px 0 #00fff9, 2px 2px #ff00c1;
            animation: glitch-anim2 5s infinite linear alternate-reverse;
        }
        @keyframes glitch-anim {
            0% { clip: rect(31px, 9999px, 13px, 0); }
            5% { clip: rect(2px, 9999px, 20px, 0); }
            10% { clip: rect(29px, 9999px, 37px, 0); }
            15% { clip: rect(42px, 9999px, 22px, 0); }
            20% { clip: rect(15px, 9999px, 11px, 0); }
            25% { clip: rect(49px, 9999px, 30px, 0); }
            30% { clip: rect(19px, 9999px, 21px, 0); }
            35% { clip: rect(13px, 9999px, 27px, 0); }
            40% { clip: rect(21px, 9999px, 45px, 0); }
            45% { clip: rect(50px, 9999px, 5px, 0); }
            50% { clip: rect(13px, 9999px, 35px, 0); }
            55% { clip: rect(42px, 9999px, 31px, 0); }
            60% { clip: rect(18px, 9999px, 22px, 0); }
            65% { clip: rect(9px, 9999px, 35px, 0); }
            70% { clip: rect(11px, 9999px, 29px, 0); }
            75% { clip: rect(25px, 9999px, 33px, 0); }
            80% { clip: rect(20px, 9999px, 7px, 0); }
            85% { clip: rect(44px, 9999px, 24px, 0); }
            90% { clip: rect(27px, 9999px, 49px, 0); }
            95% { clip: rect(50px, 9999px, 15px, 0); }
            100% { clip: rect(37px, 9999px, 50px, 0); }
        }
        @keyframes glitch-anim2 {
            0% { clip: rect(26px, 9999px, 33px, 0); }
            5% { clip: rect(42px, 9999px, 17px, 0); }
            10% { clip: rect(19px, 9999px, 44px, 0); }
            15% { clip: rect(14px, 9999px, 26px, 0); }
            20% { clip: rect(31px, 9999px, 41px, 0); }
            25% { clip: rect(22px, 9999px, 8px, 0); }
            30% { clip: rect(12px, 9999px, 43px, 0); }
            35% { clip: rect(50px, 9999px, 11px, 0); }
            40% { clip: rect(33px, 9999px, 25px, 0); }
            45% { clip: rect(9px, 9999px, 35px, 0); }
            50% { clip: rect(41px, 9999px, 29px, 0); }
            55% { clip: rect(15px, 9999px, 47px, 0); }
            60% { clip: rect(28px, 9999px, 5px, 0); }
            65% { clip: rect(45px, 9999px, 13px, 0); }
            70% { clip: rect(7px, 9999px, 39px, 0); }
            75% { clip: rect(23px, 9999px, 16px, 0); }
            80% { clip: rect(38px, 9999px, 50px, 0); }
            85% { clip: rect(4px, 9999px, 21px, 0); }
            90% { clip: rect(47px, 9999px, 32px, 0); }
            95% { clip: rect(19px, 9999px, 9px, 0); }
            100% { clip: rect(11px, 9999px, 27px, 0); }
        }

        .stats-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .cmd-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }
    </style>

    <script>
        // Add real-time updates simulation
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats cards on load
            const statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, index * 200);
            });

            // Simulate live data updates
            setInterval(() => {
                const liveIndicators = document.querySelectorAll('.animate-pulse');
                liveIndicators.forEach(indicator => {
                    indicator.style.animation = 'none';
                    setTimeout(() => {
                        indicator.style.animation = '';
                    }, 10);
                });
            }, 3000);
        });
    </script>
</body>
</html>
