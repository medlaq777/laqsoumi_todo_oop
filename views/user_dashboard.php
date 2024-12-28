<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</h1>
            <a href="index.php?action=logout" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Logout
            </a>
        </div>

        <!-- Task Overview -->
        <div class="flex justify-between items-center mb-6">
            <a href="index.php?action=create_user_task" class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                New Task
            </a>
            <p class="text-lg font-semibold">Total des Tâches: <?php echo array_sum(array_map('count', $tasks_by_status)); ?></p>
            <select class="border border-gray-300 rounded px-4 py-2 shadow-sm">
                <option>Filter by Priority</option>
                <option value="P1">P1</option>
                <option value="P2">P2</option>
                <option value="P3">P3</option>
            </select>
        </div>

      
        <div class="grid grid-cols-3 gap-6">
          
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm text-gray-600">
                                Échéance: 
                               
                </div>
            </div>
           
        </div>
    </div>
</body>
</html>