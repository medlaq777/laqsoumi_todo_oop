<?php
class AdminController {
    private $db;
    private $user;
    private $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        $this->task = new Task($this->db);
    }

    public function dashboard() {
        $users = $this->user->getAllUsers();
        $tasks = $this->task->getAllTasks();
        include 'views/admin_dashboard.php';
    }

}
?>
