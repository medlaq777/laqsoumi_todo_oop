<?php
class Task {
    private $conn;
    private $table_name = "tasks";
    private $usertask_table = "usertasks"; 

    public $id;
    public $title;
    public $description;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllTaskstag() {
        $stmt = $this->conn->prepare("
            SELECT t.*, GROUP_CONCAT(tg.NAME) as tags 
            FROM Tasks t 
            LEFT JOIN TagsTasks tt ON t.task_id = tt.tasks_id 
            LEFT JOIN Tags tg ON tt.tags_id = tg.id_tags 
            GROUP BY t.task_id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTasksByStatus($status) {
        $stmt = $this->conn->prepare("
            SELECT t.*, GROUP_CONCAT(tg.NAME) as tags 
            FROM Tasks t 
            LEFT JOIN TagsTasks tt ON t.task_id = tt.tasks_id 
            LEFT JOIN Tags tg ON tt.tags_id = tg.id_tags 
            WHERE t.status = :status 
            GROUP BY t.task_id
        ");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTaskDetails($taskId) {
        $stmt = $this->conn->prepare("
            SELECT t.*, GROUP_CONCAT(tg.NAME) as tags 
            FROM Tasks t 
            LEFT JOIN TagsTasks tt ON t.task_id = tt.tasks_id 
            LEFT JOIN Tags tg ON tt.tags_id = tg.id_tags 
            WHERE t.task_id = :task_id
            GROUP BY t.task_id
        ");
        $stmt->bindParam(':task_id', $taskId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
  
    public function getAllTasks() {
        $query = "SELECT task_id, title,description ,status FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching all tasks: " . $e->getMessage());
            return [];
        }
    }

    public function getTasksByUserId($user_id) {
        $query = "SELECT t.task_id, t.title, t.description, t.status 
                  FROM " . $this->usertask_table . " AS ut
                  INNER JOIN " . $this->table_name . " AS t 
                  ON ut.task_id = t.task_id
                  WHERE ut.user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching tasks for user ID $user_id: " . $e->getMessage());
            return [];
        }
    }

    
    public function getUsersByTaskId($task_id) {
        $query = "SELECT u.id, u.name 
                  FROM " . $this->usertask_table . " AS ut
                  INNER JOIN users AS u 
                  ON ut.user_id = u.id
                  WHERE ut.task_id = :task_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching users for task ID $task_id: " . $e->getMessage());
            return [];
        }
    }

    public function assignTaskToUser($task_id, $user_id) {
        $userQuery = "SELECT * FROM users WHERE user_id = :user_id";  // Ensure correct column name
        $stmt = $this->conn->prepare($userQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->rowCount() === 0) {
            return 'User does not exist';
        }
    
        $taskQuery = "SELECT * FROM tasks WHERE task_id = :task_id";  // Ensure correct column name
        $stmt = $this->conn->prepare($taskQuery);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->rowCount() === 0) {
            return 'Task does not exist';
        }
    
        $insertQuery = "INSERT INTO usertasks (user_id, task_id) VALUES (:user_id, :task_id)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return 'Task successfully assigned';
        } else {
            return 'Error assigning task';
        }
    }
    
    
    
  

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title, description, status) 
                  VALUES (:title, :description, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

   
    public function deleteTaskById($task_id) {
        $query = "DELETE FROM tasks WHERE task_id = :task_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task_id', $task_id,PDO::PARAM_INT);
        return $stmt->execute();
    }
   
    
   
   

       
        
    
}
?>
