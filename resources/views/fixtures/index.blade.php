<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Fixtures - AcademyLeague</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-calendar-alt text-4xl text-red-600 mr-4"></i>
                <h1 class="text-4xl font-bold text-gray-800">Match Fixtures & Results</h1>
            </div>
            <p class="text-xl text-gray-600 mb-2">Youth Academy Football Schedule</p>
            <div class="flex justify-center space-x-4 text-sm text-gray-500">
                <span class="flex items-center"><div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div> Completed</span>
                <span class="flex items-center"><div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div> Live</span>
                <span class="flex items-center"><div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div> Scheduled</span>
                <span class="flex items-center"><div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div> Postponed</span>
            </div>
        </div>

        <!-- Match Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-green-500">
                <div class="text-2xl font-bold text-green-600">{{ $fixtures->where('status', 'completed')->count() }}</div>
                <div class="text-sm text-gray-600">Matches Played</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-blue-500">
                <div class="text-2xl font-bold text-blue-600">{{ $fixtures->where('status', 'scheduled')->count() }}</div>
                <div class="text-sm text-gray-600">Upcoming</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-red-500">
                <div class="text-2xl font-bold text-red-600">{{ $fixtures->where('status', 'live')->count() }}</div>
                <div class="text-sm text-gray-600">Live Now</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md border-l-4 border-purple-500">
                <div class="text-2xl font-bold text-purple-600">{{ $fixtures->sum('home_team_score') + $fixtures->sum('away_team_score') }}</div>
                <div class="text-sm text-gray-600">Total Goals</div>
            </div>
        </div>

        <!-- Status Filters -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button class="status-filter px-4 py-2 bg-gray-600 text-white rounded-full hover:bg-gray-700 transition-colors" data-status="all">
                <i class="fas fa-list mr-2"></i>All Matches
            </button>
            <button class="status-filter px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors" data-status="live">
                <i class="fas fa-broadcast-tower mr-2"></i>Live
            </button>
            <button class="status-filter px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors" data-status="scheduled">
                <i class="fas fa-clock mr-2"></i>Scheduled
            </button>
            <button class="status-filter px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors" data-status="completed">
                <i class="fas fa-check-circle mr-2"></i>Completed
            </button>
        </div>

        <!-- Fixtures Timeline -->
        <div class="space-y-6" id="fixturesContainer">
            @foreach($fixtures as $fixture)
            <div class="fixture-card bg-white rounded-xl shadow-lg overflow-hidden border-l-4 
                @if($fixture->status == 'completed') border-green-500
                @elseif($fixture->status == 'live') border-red-500
                @elseif($fixture->status == 'scheduled') border-blue-500
                @else border-yellow-500 @endif"
                data-status="{{ $fixture->status }}">
                
                <div class="p-6">
                    <!-- Match Header -->
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ $fixture->venue }}
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($fixture->status == 'live')
                            <div class="flex items-center bg-red-100 text-red-800 px-3 py-1 rounded-full">
                                <div class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></div>
                                <span class="text-sm font-bold">LIVE</span>
                            </div>
                            @elseif($fixture->status == 'completed')
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">
                                FT
                            </div>
                            @elseif($fixture->status == 'postponed')
                            <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-bold">
                                POSTPONED
                            </div>
                            @else
                            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-bold">
                                UPCOMING
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Teams and Score -->
                    <div class="grid grid-cols-3 items-center gap-4 mb-4">
                        <!-- Home Team -->
                        <div class="text-right">
                            <div class="font-bold text-lg text-gray-800">{{ $fixture->homeTeam->team_name }}</div>
                            <div class="text-sm text-gray-600">{{ $fixture->homeTeam->age_group }}</div>
                        </div>

                        <!-- Score -->
                        <div class="text-center">
                            @if($fixture->status == 'completed' || $fixture->status == 'live')
                            <div class="flex items-center justify-center space-x-4">
                                <span class="text-3xl font-bold text-gray-800">{{ $fixture->home_team_score ?? 0 }}</span>
                                <span class="text-xl text-gray-500">-</span>
                                <span class="text-3xl font-bold text-gray-800">{{ $fixture->away_team_score ?? 0 }}</span>
                            </div>
                            @if($fixture->status == 'live')
                            <div class="text-xs text-red-600 font-bold mt-1">{{ \Carbon\Carbon::parse($fixture->match_date)->diffForHumans() }}</div>
                            @endif
                            @else
                            <div class="text-lg text-gray-500 font-semibold">
                                {{ \Carbon\Carbon::parse($fixture->match_date)->format('H:i') }}
                            </div>
                            @endif
                        </div>

                        <!-- Away Team -->
                        <div class="text-left">
                            <div class="font-bold text-lg text-gray-800">{{ $fixture->awayTeam->team_name }}</div>
                            <div class="text-sm text-gray-600">{{ $fixture->awayTeam->age_group }}</div>
                        </div>
                    </div>

                    <!-- Match Details -->
                    <div class="flex justify-between items-center text-sm text-gray-600">
                        <div>
                            <i class="fas fa-calendar mr-1"></i>
                            {{ \Carbon\Carbon::parse($fixture->match_date)->format('M j, Y') }}
                        </div>
                        <div>
                            <i class="fas fa-whistle mr-1"></i>
                            {{ $fixture->referee ?? 'TBD' }}
                        </div>
                    </div>

                    <!-- Match Notes -->
                    @if($fixture->match_notes)
                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                        <div class="text-sm text-gray-700">
                            <i class="fas fa-sticky-note mr-1"></i>
                            {{ $fixture->match_notes }}
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex space-x-2 mt-4">
                        @if($fixture->status == 'live')
                        <button class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-play-circle mr-1"></i>Watch Live
                        </button>
                        @elseif($fixture->status == 'scheduled')
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-bell mr-1"></i>Set Reminder
                        </button>
                        @else
                        <button class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Match Stats
                        </button>
                        @endif
                        <button class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Details
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
    </div>

    <!-- JavaScript for Filtering -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilters = document.querySelectorAll('.status-filter');
            const fixtureCards = document.querySelectorAll('.fixture-card');

            statusFilters.forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    
                    // Update active button
                    statusFilters.forEach(btn => {
                        btn.classList.remove('ring-2', 'ring-offset-2', 'ring-white');
                    });
                    this.classList.add('ring-2', 'ring-offset-2', 'ring-white');
                    
                    // Filter fixtures
                    fixtureCards.forEach(card => {
                        if (status === 'all' || card.getAttribute('data-status') === status) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
