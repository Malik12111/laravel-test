<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy Teams - AcademyLeague</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-800 mb-4">⚽ Academy League</h1>
            <p class="text-xl text-gray-600">Developing Future Football Stars</p>
        </div>

        <!-- Teams Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teams as $team)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-blue-600 p-4">
                    <h3 class="text-xl font-bold text-white">{{ $team->team_name }}</h3>
                    <p class="text-blue-200">{{ $team->age_group }} • {{ $team->location }}</p>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-gray-700"><strong>Coach:</strong> {{ $team->coach_name }}</p>
                        <p class="text-gray-700"><strong>Founded:</strong> {{ $team->founded_year }}</p>
                        <p class="text-gray-700"><strong>Contact:</strong> {{ $team->contact_email }}</p>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4">{{ $team->description }}</p>
                    
                    <div class="flex justify-between items-center">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                            Active
                        </span>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                            View Team
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <div class="mt-12 text-center">
            <div class="flex justify-center space-x-4">
                <a href="/teams" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
                    Teams
                </a>
                <a href="/players" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700">
                    Players
                </a>
                <a href="/fixtures" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700">
                    Fixtures
                </a>
                <a href="/leagues" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700">
                    Leagues
                </a>
            </div>
        </div>
    </div>
</body>
</html>
