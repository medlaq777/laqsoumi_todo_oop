



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

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                username = :username,
                email = :email,
                password = :password,
                role = :role";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->role = $this->role ?? 'user'; 

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
 
 public function deleteUser() {
    $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
    return $stmt->execute();
}



   

   
  
  

    
}

