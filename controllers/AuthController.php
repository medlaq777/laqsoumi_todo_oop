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

    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if($this->user->emailExists()) {
                if(password_verify($password, $this->user->password)) {
                    session_start();
                    $_SESSION['user_id'] = $this->user->id;
                    $_SESSION['username'] = $this->user->username;
                    $_SESSION['role'] = $this->user->role;
                
                    if($this->user->role === 'admin') {
                        header("Location: index.php?action=admin_dashboard");
                    } else {
                        header("Location: index.php?action=user_dashboard");
                    }
                    exit();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "Email not found.";
            }
            
            include 'views/login.php';
        } else {
            include 'views/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}

