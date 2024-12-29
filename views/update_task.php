<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update Task</h1>

       
        <!-- Form -->
        <form action="index.php?action=update_task&id=<?= $task['task_id']; ?>" method="POST" class="space-y-4">
            <!-- Task Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="<?= htmlspecialchars($task['title']); ?>" 
                    required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 sm:text-sm p-2"
                >
            </div>
            
            <!-- Task Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    required 
                    rows="4" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 sm:text-sm p-2"
                ><?= htmlspecialchars($task['description']); ?></textarea>
            </div>
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select 
                    id="status" 
                    name="status" 
                    required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 sm:text-sm p-2"
                >
                    <option value="todo" <?= $task['status'] == 'todo' ? 'selected' : ''; ?>>To Do</option>
                    <option value="doing" <?= $task['status'] == 'doing' ? 'selected' : ''; ?>>Doing</option>
                    <option value="done" <?= $task['status'] == 'done' ? 'selected' : ''; ?>>Done</option>
                </select>
            </div>
            
            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Update Task
                </button>
            </div>
        </form>
    </div>
</body>
</html>
