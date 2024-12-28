<?php
include_once 'models/Task.php';
include_once 'models/Tag.php';
include_once 'config/Database.php';

class TaskController {
    private $db;
    private $task;
    private $taskModel;
    private $tagModel;
    
   
    
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->task = new Task($this->db);
        $this->taskModel = new Task($this->db);
        $this->tagModel = new Tag($this->db);
    }
    public function index() {
        $tasks_by_status = [
            'todo' => $this->taskModel->getTasksByStatus('todo'),
            'doing' => $this->taskModel->getTasksByStatus('doing'),
            'done' => $this->taskModel->getTasksByStatus('done')
        ];
        
        require 'views/user_dashboard.php';
    }
    
   
    
   
  
    public function addTask($title, $description, $status) {
        if (empty($title) || empty($description) || empty($status)) {
            $this->errorResponse("All fields are required.");
        }

        if ($this->task->createTask($title, $description, $status)) {
            $this->redirect("index.php", ["success" => 1]);
        } else {
            $this->errorResponse("Failed to add task.");
        }
    }

   

    
    public function updateTaskStatus() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->redirect("index.php?action=user_dashboard");
            return;
        }
    
        $task_id = $_POST['task_id'] ?? '';
        $status = $_POST['status'] ?? '';
        $user_id = $_SESSION['user_id'] ?? '';
        $csrf_token = $_POST['csrf_token'] ?? '';
    
        // Check CSRF token
        if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
            $this->errorResponse("Invalid CSRF token.");
        }
    
        // Validate input
        if (empty($task_id) || empty($status) || empty($user_id)) {
            $this->errorResponse("Invalid input.");
        }
    
        // Update task status
        if ($this->task->updateTaskStatus($task_id, $status, $user_id)) {
            $this->redirect("index.php?action=user_dashboard", ["task_updated" => 1]);
        } else {
            $error = "Unable to update task status.";
            include 'views/user_dashboard.php';
        }
    }

  
    

 

public function createUserTask() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? 'todo';
        $userId = $_SESSION['user_id'] ?? null;

        if (empty($title) || empty($description) || empty($userId)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: index.php?action=user_dashboard");
            exit();
        }

        if ($this->taskModel->createUserTask($title, $description, $status, $userId)) {
            $_SESSION['success'] = "Task created successfully.";
        } else {
            $_SESSION['error'] = "Failed to create task.";
        }
        header("Location: index.php?action=user_dashboard");
        exit();
    }
    
    include 'views/create_user_task.php';
}


}
?>
