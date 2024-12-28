



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
        $this->role = $this->role ?? 'user'; // Default role is 'user'

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
 // Delete a user
 public function deleteUser() {
    $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
    return $stmt->execute();
}
public function deleteTUserById($user_id) {
    $query = "DELETE FROM users WHERE user_id = :user_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id,PDO::PARAM_INT);
    return $stmt->execute();
}

public function updateUserById($user_id, $username, $email, $role) {
    $query = "UPDATE users SET username= :username, email = :email, role = :role WHERE user_id = :user_id";

    $stmt = $this->conn->prepare($query);

    
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':user_id', $user_id);

    
    return $stmt->execute();
}

// Update user details

   

   
  
  

    
}

