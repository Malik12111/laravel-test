<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League Standings - AcademyLeague</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-trophy text-4xl text-yellow-500 mr-4"></i>
                <h1 class="text-4xl font-bold text-gray-800">League Championships</h1>
            </div>
            <p class="text-xl text-gray-600 mb-2">Youth Academy Tournament Standings</p>
            <div class="flex justify-center space-x-4 text-sm text-gray-500">
                <span class="flex items-center"><div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div> Active</span>
                <span class="flex items-center"><div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div> Upcoming</span>
                <span class="flex items-center"><div class="w-3 h-3 bg-gray-500 rounded-full mr-2"></div> Completed</span>
            </div>
        </div>

        <!-- League Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-purple-500">
                <div class="text-2xl font-bold text-purple-600">{{ $leagues->count() }}</div>
                <div class="text-sm text-gray-600">Total Leagues</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-green-500">
                <div class="text-2xl font-bold text-green-600">{{ $leagues->where('status', 'active')->count() }}</div>
                <div class="text-sm text-gray-600">Active</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-blue-500">
                <div class="text-2xl font-bold text-blue-600">{{ $leagues->where('status', 'upcoming')->count() }}</div>
                <div class="text-sm text-gray-600">Upcoming</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-yellow-500">
                <div class="text-2xl font-bold text-yellow-600">{{ $leagues->sum('teams_per_group') }}</div>
                <div class="text-sm text-gray-600">Total Teams</div>
            </div>
        </div>

        <!-- Leagues Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($leagues as $league)
            <div class="league-card bg-white rounded-2xl shadow-xl overflow-hidden border-l-4 
                @if($league->status == 'active') border-green-500
                @elseif($league->status == 'upcoming') border-blue-500
                @elseif($league->status == 'completed') border-gray-500
                @else border-yellow-500 @endif">
                
                <!-- League Header -->
                <div class="bg-gradient-to-r 
                    @if($league->status == 'active') from-green-500 to-green-600
                    @elseif($league->status == 'upcoming') from-blue-500 to-blue-600
                    @elseif($league->status == 'completed') from-gray-500 to-gray-600
                    @else from-yellow-500 to-yellow-600 @endif p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-white">{{ $league->league_name }}</h3>
                            <p class="text-blue-100 text-lg">{{ $league->season }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-sm font-bold">
                                {{ $league->age_group }}
                            </span>
                            <div class="mt-2">
                                <span class="inline-block bg-black bg-opacity-30 text-white px-3 py-1 rounded-full text-sm">
                                    @if($league->status == 'active')
                                    <i class="fas fa-play-circle mr-1"></i>ACTIVE
                                    @elseif($league->status == 'upcoming')
                                    <i class="fas fa-clock mr-1"></i>UPCOMING
                                    @elseif($league->status == 'completed')
                                    <i class="fas fa-check-circle mr-1"></i>COMPLETED
                                    @else
                                    <i class="fas fa-times-circle mr-1"></i>CANCELLED
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- League Details -->
                <div class="p-6">
                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Season Progress</span>
                            <span>
                                @php
                                    $totalDays = \Carbon\Carbon::parse($league->start_date)->diffInDays($league->end_date);
                                    $daysPassed = \Carbon\Carbon::parse($league->start_date)->diffInDays(now());
                                    $progress = min(max(($daysPassed / $totalDays) * 100, 0), 100);
                                @endphp
                                {{ number_format($progress, 1) }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full 
                                @if($league->status == 'active') bg-green-500
                                @elseif($league->status == 'upcoming') bg-blue-500
                                @elseif($league->status == 'completed') bg-gray-500
                                @else bg-yellow-500 @endif" 
                                style="width: {{ $progress }}%">
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Start: {{ \Carbon\Carbon::parse($league->start_date)->format('M j') }}</span>
                            <span>End: {{ \Carbon\Carbon::parse($league->end_date)->format('M j, Y') }}</span>
                        </div>
                    </div>

                    <!-- League Info -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $league->teams_per_group }}</div>
                            <div class="text-sm text-gray-600">Teams</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">
                                @php
                                    $matchDays = \Carbon\Carbon::parse($league->start_date)->diffInWeeks($league->end_date);
                                @endphp
                                {{ $matchDays }}
                            </div>
                            <div class="text-sm text-gray-600">Match Weeks</div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($league->description)
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            {{ $league->description }}
                        </p>
                    </div>
                    @endif

                    <!-- Sample Standings (Would be dynamic in real app) -->
                    <div class="mb-6">
                        <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-table mr-2"></i>
                            Current Standings
                        </h4>
                        <div class="space-y-2">
                            @php
                                $sampleTeams = [
                                    ['name' => 'Arsenal Youth Academy', 'points' => 18, 'played' => 6],
                                    ['name' => 'Chelsea Blue Lions', 'points' => 15, 'played' => 6],
                                    ['name' => 'Manchester United', 'points' => 12, 'played' => 6],
                                    ['name' => 'Liverpool Young Reds', 'points' => 9, 'played' => 6],
                                ];
                            @endphp
                            @foreach($sampleTeams as $index => $team)
                            <div class="flex items-center justify-between p-2 rounded-lg 
                                @if($index == 0) bg-yellow-50 border border-yellow-200
                                @elseif($index < 3) bg-green-50 border border-green-200
                                @else bg-gray-50 @endif">
                                <div class="flex items-center">
                                    <span class="w-6 text-center font-bold 
                                        @if($index == 0) text-yellow-600
                                        @elseif($index < 3) text-green-600
                                        @else text-gray-600 @endif">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="ml-2 text-sm font-semibold">{{ $team['name'] }}</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-xs text-gray-500">{{ $team['played'] }}P</span>
                                    <span class="font-bold text-gray-800">{{ $team['points'] }}pts</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button class="flex-1 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white py-3 px-4 rounded-lg font-semibold transition-all transform hover:-translate-y-0.5">
                            <i class="fas fa-table mr-2"></i>Full Table
                        </button>
                        <button class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-calendar mr-2"></i>Fixtures
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <div class="mt-12 text-center">
            <div class="inline-flex flex-wrap justify-center gap-4 bg-white rounded-2xl shadow-lg p-6">
                <a href="/teams" class="flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    <i class="fas fa-users mr-2"></i>Teams
                </a>
                <a href="/players" class="flex items-center bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                    <i class="fas fa-running mr-2"></i>Players
                </a>
                <a href="/fixtures" class="flex items-center bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    <i class="fas fa-calendar-alt mr-2"></i>Fixtures
                </a>
                <a href="/leagues" class="flex items-center bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                    <i class="fas fa-trophy mr-2"></i>Leagues
                </a>
            </div>
        </div>

        <!-- Championship Info -->
        <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 text-center">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">🏆 Academy Championship Series</h3>
            <p class="text-gray-600 mb-6">Developing future stars through competitive youth tournaments across all age groups from U8 to U18.</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-4">
                    <i class="fas fa-medal text-2xl text-yellow-500 mb-2"></i>
                    <div class="font-bold text-gray-800">Gold Trophy</div>
                    <div class="text-sm text-gray-600">Champions</div>
                </div>
                <div class="p-4">
                    <i class="fas fa-medal text-2xl text-gray-400 mb-2"></i>
                    <div class="font-bold text-gray-800">Silver Medal</div>
                    <div class="text-sm text-gray-600">Runners-up</div>
                </div>
                <div class="p-4">
                    <i class="fas fa-medal text-2xl text-yellow-700 mb-2"></i>
                    <div class="font-bold text-gray-800">Bronze Medal</div>
                    <div class="text-sm text-gray-600">Third Place</div>
                </div>
                <div class="p-4">
                    <i class="fas fa-star text-2xl text-purple-500 mb-2"></i>
                    <div class="font-bold text-gray-800">Top Scorer</div>
                    <div class="text-sm text-gray-600">Golden Boot</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add subtle animations
        document.addEventListener('DOMContentLoaded', function() {
            const leagueCards = document.querySelectorAll('.league-card');
            leagueCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fade-in-up');
            });
        });
    </script>

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
    </style>
</body>
</html>
