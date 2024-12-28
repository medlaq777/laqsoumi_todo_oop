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
   
    
   
    
   
  

   

    
   

  
    

 




}
?>
