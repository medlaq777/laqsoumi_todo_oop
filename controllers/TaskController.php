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

   

    
   

  
    

 




}
?>
