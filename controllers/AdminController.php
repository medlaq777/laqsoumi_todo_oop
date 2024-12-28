<?php
class AdminController {
    private $db;
    private $user;
    private $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        $this->task = new Task($this->db);
    }

    public function dashboard() {
        $users = $this->user->getAllUsers();
        $tasks = $this->task->getAllTasks();
        include 'views/admin_dashboard.php';
    }

   
    

    public function createTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? 'todo';

            $task = new Task($this->db);
            $task->title = $title;
            $task->description = $description;
            $task->status = $status;

            if ($task->create()) {
                echo "Task created successfully.";
            } else {
                echo "Failed to create task.";
            }
        } else {
            include 'views/create_task.php';
        }
    }

    public function deleteTask() {
        $task_id = $_GET['id'] ?? '';

        if (empty($task_id)) {
            $this->dashboard('Task ID is required.');
            return;
        }

        if ($this->task->deleteTaskById($task_id)) {
            header("Location: index.php?action=admin_dashboard&task_deleted=1");
            exit();
        } else {
            $this->dashboard('Failed to delete task.');
        }
    }

   

    public function updateTask() {
        $task_id = $_GET['id'] ?? '';

        if (empty($task_id)) {
            $this->dashboard('Task ID is required.');
            return;
        }

        $task = $this->task->getTaskById($task_id);

        if (!$task) {
            $this->dashboard('Task not found.');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? '';

            $validStatuses = ['todo', 'doing', 'done'];

            if (empty($title) || empty($description) || empty($status)) {
                $this->showUpdateTaskForm($task, 'All fields are required.');
                return;
            }

            if (!in_array($status, $validStatuses)) {
                $this->showUpdateTaskForm($task, 'Invalid status value. Allowed values: todo, doing, done.');
                return;
            }

            if ($this->task->updateTaskById($task_id, $title, $description, $status)) {
                header("Location: index.php?action=admin_dashboard&task_updated=1");
                exit();
            } else {
                $this->showUpdateTaskForm($task, 'Failed to update task.');
            }
        } else {
            $this->showUpdateTaskForm($task);
        }
    }

    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $this->user->username = $username;
            $this->user->email = $email;
            $this->user->password = $password;
            $this->user->role = $role;

            $errors = $this->user->validate();
            if (!empty($errors)) {
                include 'views/create_user.php';
                return;
            }

            if ($this->user->create()) {
                header("Location: index.php?action=admin_dashboard&user_created=1");
                exit();
            } else {
                include 'views/create_user.php';
            }
        } else {
            include 'views/create_user.php';
        }
    }

    
    public function updateUser() {
        $user_id = $_GET['id'] ?? '';

        if (empty($user_id)) {
            $this->dashboard('User ID is required.');
            return;
        }

        $user = $this->user->getUserById($user_id);

        if (!$user) {
            $this->dashboard('User not found.');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($this->user->updateUserById($user_id, $username, $email, $role)) {
                header("Location: index.php?action=admin_dashboard&user_updated=1");
                exit();
            } else {
                $this->showUpdateUserForm($user, 'Failed to update user.');
            }
        } else {
            $this->showUpdateUserForm($user);
        }
    }

    public function deleteUser() {
        $user_id = $_GET['id'] ?? '';

        if (empty($user_id)) {
            $this->dashboard('User ID is required.');
            return;
        }

        if ($this->user->deleteTUserById($user_id)) {
            header("Location: index.php?action=admin_dashboard&user_deleted=1");
            exit();
        } else {
            $this->dashboard('Failed to delete user.');
        }
    }
}
?>
