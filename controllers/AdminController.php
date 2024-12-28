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

   

   

    

   
    
   
    
}
?>
