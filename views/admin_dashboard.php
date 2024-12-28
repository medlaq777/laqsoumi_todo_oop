<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <div class="bg-gray-800 text-white w-64 p-6 space-y-6">
        <h2 class="text-3xl font-semibold text-center">Admin Panel</h2>
    </div>

    
    <div class="flex-1 p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Admin Dashboard</h1>
                <button class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded" onclick="window.location.href='index.php?action=logout'">Logout</button>
            </div>
            <section id="usersSection" class="mb-8 hidden">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Users</h2>
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Username</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Role</th>
                            <th class="py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </section>

            <section id="tasksSection" class="hidden">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Tasks</h2>
                
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Title</th>
                            <th class="py-3 px-4">Description</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Assigned User</th>
                            <th class="py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</div>


</body>
</html>
