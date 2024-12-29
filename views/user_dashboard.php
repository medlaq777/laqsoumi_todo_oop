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
            <?php
            $columns = [
                'todo' => ['title' => 'À FAIRE', 'color' => 'blue'],
                'doing' => ['title' => 'EN COURS', 'color' => 'yellow'],
                'done' => ['title' => 'TERMINÉ', 'color' => 'green']
            ];

            foreach ($columns as $status => $column):
            ?>
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-<?php echo $column['color']; ?>-500">
                <h2 class="text-xl font-semibold text-<?php echo $column['color']; ?>-500 mb-4">
                    <?php echo $column['title']; ?> | <?php echo count($tasks_by_status[$status]); ?>
                </h2>
                <div class="space-y-4">
                    <?php foreach ($tasks_by_status[$status] as $task): ?>
                    <div class="border rounded-lg p-4">
                        <h3 class="font-bold mb-2"><?php echo htmlspecialchars($task['title']); ?></h3>
                  
                        <div class="flex flex-wrap gap-2 mb-2">
                            <?php 
                            if (isset($task['tags']) && $task['tags'] !== null) {
                                $tags = explode(',', $task['tags']);
                                foreach ($tags as $tag): 
                                    $tagColor = match($tag) {
                                        'bug' => 'bg-red-100 text-red-800',
                                        'feature' => 'bg-blue-100 text-blue-800',
                                        'basic' => 'bg-gray-100 text-gray-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                            ?>
                            <span class="px-2 py-1 text-sm rounded <?php echo $tagColor; ?>">
                                <?php echo htmlspecialchars($tag); ?>
                            </span>
                            <?php 
                                endforeach;
                            }
                            ?>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm text-gray-600">
                                Échéance: 
                                <?php
                                if (isset($task['due_date']) && $task['due_date'] !== null) {
                                    echo date('Y-m-d', strtotime($task['due_date']));
                                } else {
                                    echo 'Non définie';
                                }
                                ?>
                            </span>
                            <a href="index.php?action=task_details&id=<?php echo $task['task_id']; ?>" 
                               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-3 py-1 rounded text-sm">
                                Détails
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>