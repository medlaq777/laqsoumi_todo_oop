<?php
class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->username = $_POST['username'] ?? '';
            $this->user->email = $_POST['email'] ?? '';
            $this->user->password = $_POST['password'] ?? '';

            $errors = $this->user->validate();

            if(empty($errors)) {
                if($this->user->create()) {
                    header("Location: index.php?action=login&registered=1");
                    exit();
                } else {
                    $errors[] = "Unable to create user.";
                }
            }
            
            include 'views/register.php';
        } else {
            include 'views/register.php';
        }
    }

    
}

