<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Task to User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-lg mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Assign Task to User</h2>

   

    <!-- Form -->
    <form action="index.php?action=assign_task" method="POST" class="space-y-4">
        <!-- Task Selection -->
        <div>
            <label for="task_id" class="block text-sm font-medium text-gray-700">Task:</label>
            <select name="task_id" id="task_id" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a task</option>
             
            </select>
        </div>

        <!-- User Selection -->
        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign to User:</label>
            <select name="user_id" id="user_id" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a user</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['user_id']); ?>"><?= htmlspecialchars($user['username']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Assign Task
            </button>
        </div>
    </form>
</div>

</body>
</html>
