<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
</head>
<body>
    <h1>Task Management</h1>

    <!-- Form to add a new task -->
    <form action="../index.php?action=add" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
        </select><br>

        <button type="submit">Add Task</button>
    </form>

