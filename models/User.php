



<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    
   

   
  
  

    
}

