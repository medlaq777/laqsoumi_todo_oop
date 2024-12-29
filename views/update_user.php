<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update User</h1>

        <!-- Error Message -->
       

        <!-- Form -->
        <form action="index.php?action=update_user&id=<?= $user['user_id']; ?>" method="POST" class="space-y-4">
            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="<?= htmlspecialchars($user['username']); ?>" 
                    required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 sm:text-sm p-2"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="<?= htmlspecialchars($user['email']); ?>" 
                    required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 sm:text-sm p-2"
                >
            </div>
            
            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select 
                    id="role" 
                    name="role" 
                    required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 sm:text-sm p-2"
                >
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
</body>
</html>
