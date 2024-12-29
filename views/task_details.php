
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-6">
        
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold"><?php echo htmlspecialchars($task['title'] ?? 'Task Not Found'); ?></h1>
                <a href="index.php" class="text-blue-600 hover:text-blue-800">← Back</a>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Description</h2>
                    <p class="text-gray-700"><?php echo htmlspecialchars($task['description'] ?? 'No description available'); ?></p>
                </div>
                
                <div>
                    <h2 class="text-lg font-semibold mb-2">Tags</h2>
                    <div class="flex flex-wrap gap-2">
                    
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Priority</h2>
                        <p class="text-gray-700">P<?php echo htmlspecialchars($task['priority'] ?? 'Not set'); ?></p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Due Date</h2>
                        <p class="text-gray-700">
                          
                        </p>
                    </div>
                </div>
                
              
                    <a href="index.php?action=update_user_task" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded"> Modifier</a>

                       
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>