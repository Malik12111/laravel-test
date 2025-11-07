<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young Football Stars - AcademyLeague</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-futbol text-4xl text-green-600 mr-4"></i>
                <h1 class="text-4xl font-bold text-green-800">Young Football Stars</h1>
            </div>
            <p class="text-xl text-gray-600 mb-2">Developing the Next Generation of Champions</p>
            <div class="flex justify-center space-x-2 text-sm text-gray-500">
                <span>🏴󠁧󠁢󠁥󠁮󠁧󠁿 Premier League Academies</span>
                <span>•</span>
                <span>⭐ Future Internationals</span>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg p-4 text-center shadow-md">
                <div class="text-2xl font-bold text-blue-600">{{ $players->count() }}</div>
                <div class="text-sm text-gray-600">Total Players</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md">
                <div class="text-2xl font-bold text-green-600">{{ $players->where('position', 'Forward')->count() }}</div>
                <div class="text-sm text-gray-600">Forwards</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md">
                <div class="text-2xl font-bold text-purple-600">{{ $players->where('position', 'Midfielder')->count() }}</div>
                <div class="text-sm text-gray-600">Midfielders</div>
            </div>
            <div class="bg-white rounded-lg p-4 text-center shadow-md">
                <div class="text-2xl font-bold text-red-600">{{ $players->where('position', 'Defender')->count() }}</div>
                <div class="text-sm text-gray-600">Defenders</div>
            </div>
        </div>

        <!-- Position Filters -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors filter-btn" data-position="all">
                <i class="fas fa-users mr-2"></i>All Players
            </button>
            <button class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors filter-btn" data-position="Forward">
                <i class="fas fa-bullseye mr-2"></i>Forwards
            </button>
            <button class="px-4 py-2 bg-purple-500 text-white rounded-full hover:bg-purple-600 transition-colors filter-btn" data-position="Midfielder">
                <i class="fas fa-compass mr-2"></i>Midfielders
            </button>
            <button class="px-4 py-2 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition-colors filter-btn" data-position="Defender">
                <i class="fas fa-shield-alt mr-2"></i>Defenders
            </button>
            <button class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors filter-btn" data-position="Goalkeeper">
                <i class="fas fa-hand-paper mr-2"></i>Goalkeepers
            </button>
        </div>

        <!-- Players Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="playersGrid">
            @foreach($players as $player)
            <div class="player-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1" data-position="{{ $player->position }}">
                <!-- Player Header with Team Colors -->
                <div class="h-2 
                    @if(str_contains($player->team->team_name, 'Arsenal')) bg-red-600
                    @elseif(str_contains($player->team->team_name, 'Chelsea')) bg-blue-600
                    @elseif(str_contains($player->team->team_name, 'United')) bg-red-600
                    @elseif(str_contains($player->team->team_name, 'Liverpool')) bg-red-600
                    @elseif(str_contains($player->team->team_name, 'City')) bg-sky-400
                    @else bg-green-600 @endif">
                </div>
                
                <div class="p-6">
                    <!-- Player Name and Number -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $player->player_name }}</h3>
                            <p class="text-gray-600">{{ $player->team->team_name }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block bg-gray-800 text-white px-3 py-1 rounded-full text-sm font-bold">
                                #{{ $player->jersey_number }}
                            </span>
                        </div>
                    </div>

                    <!-- Player Details -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-map-marker-alt w-5 text-red-500"></i>
                            <span class="ml-2">{{ $player->team->location }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-calendar w-5 text-blue-500"></i>
                            <span class="ml-2">Age: {{ \Carbon\Carbon::parse($player->date_of_birth)->age }} • {{ $player->team->age_group }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-user-shield w-5 text-green-500"></i>
                            <span class="ml-2">Coach: {{ $player->team->coach_name }}</span>
                        </div>
                    </div>

                    <!-- Position Badge -->
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            @if($player->position == 'Forward') bg-orange-100 text-orange-800
                            @elseif($player->position == 'Midfielder') bg-purple-100 text-purple-800
                            @elseif($player->position == 'Defender') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800 @endif">
                            <i class="fas 
                                @if($player->position == 'Forward') fa-bullseye
                                @elseif($player->position == 'Midfielder') fa-compass
                                @elseif($player->position == 'Defender') fa-shield-alt
                                @else fa-hand-paper @endif mr-1">
                            </i>
                            {{ $player->position }}
                        </span>
                    </div>

                    <!-- Potential Stars -->
                    @if(in_array($player->player_name, ['Ethan Wright', 'Lucas Martinez', 'James Wilson']))
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                            <span class="text-yellow-800 font-semibold">Academy Prospect</span>
                        </div>
                        <p class="text-yellow-700 text-sm mt-1">Top talent in {{ $player->team->age_group }} category</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-3 rounded-lg text-sm font-semibold transition-colors">
                            <i class="fas fa-chart-line mr-1"></i>Stats
                        </button>
                        <button class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded-lg text-sm font-semibold transition-colors">
                            <i class="fas fa-eye mr-1"></i>Profile
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
            const filterButtons = document.querySelectorAll('.filter-btn');
            const playerCards = document.querySelectorAll('.player-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const position = this.getAttribute('data-position');
                    
                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('ring-2', 'ring-offset-2'));
                    this.classList.add('ring-2', 'ring-offset-2', 'ring-white');
                    
                    // Filter players
                    playerCards.forEach(card => {
                        if (position === 'all' || card.getAttribute('data-position') === position) {
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
