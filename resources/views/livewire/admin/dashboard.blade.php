<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            {{-- Total Pages Card --}}
            <div class="bg-white p-4 rounded-lg shadow flex flex-col items-center justify-center">
                <div class="text-3xl font-bold text-blue-600">
                    {{ $totalPages }}
                </div>
                <p class="text-gray-600 mt-1">Total Pages</p>
            </div>
            {{-- Total Services Card --}}
            <div class="bg-white p-4 rounded-lg shadow flex flex-col items-center justify-center">
                <div class="text-3xl font-bold text-green-600">
                    {{ $totalServices }}
                </div>
                <p class="text-gray-600 mt-1">Total Services</p>
            </div>
            {{-- Total Portfolios Card --}}
            <div class="bg-white p-4 rounded-lg shadow flex flex-col items-center justify-center">
                <div class="text-3xl font-bold text-indigo-600">
                    {{ $totalPortfolios }}
                </div>
                <p class="text-gray-600 mt-1">Total Portfolios</p>
            </div>
            {{-- Total Posts Card --}}
            <div class="bg-white p-4 rounded-lg shadow flex flex-col items-center justify-center">
                <div class="text-3xl font-bold text-red-600">
                    {{ $totalPosts }}
                </div>
                <p class="text-gray-600 mt-1">Total Posts</p>
            </div>
            {{-- Total Users Card --}}
            <div class="bg-white p-4 rounded-lg shadow flex flex-col items-center justify-center">
                <div class="text-3xl font-bold text-purple-600">
                    {{ $totalUsers }}
                </div>
                <p class="text-gray-600 mt-1">Total Users</p>
            </div>
        </div>
    </div>
</body>
</html>