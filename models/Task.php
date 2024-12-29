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

    
   
  
    
    
    
  

   

   
  
   
    
  

   

      
     
    
}
?>
