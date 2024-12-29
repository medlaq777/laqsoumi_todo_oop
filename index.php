<?php
// Start session
session_start();
require_once 'config/Database.php';
require_once 'models/User.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/TaskController.php';
require_once 'models/Task.php';
require_once 'models/Tag.php';
$auth = new AuthController();
$admin = new AdminController();
$task = new TaskController();

$action = $_GET['action'] ?? 'login';

switch($action) {
    case 'register':
        $auth->register();
        break;
    case 'login':
        $auth->login();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'admin_dashboard':
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
        $admin->dashboard();
        break;
    case 'user_dashboard':
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        $task->listUserTasks($_SESSION['user_id']);
        break;
    case 'create_task':
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
        $admin->createTask();
        break; 
       
        break;
    case 'delete_task':
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
        $admin->deleteTask();
        break;case 'edit_task':
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
        $admin->updateTask() ;
        break;
    case 'update_task_status':
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        $task->updateTaskStatus();
        break;
    case 'dashboard':
        if(!isset($_SESSION['user_id'])|| $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
        include 'views/admin_dashboard.php';
        break;

        case 'update_task':
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                header("Location: index.php?action=login");
                exit();
            }
            $admin->updateTask(); 
            break;
            case 'assign_task':
                $admin->assignTask();
                break;
            case"delete_user":
                
                    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                        header("Location: index.php?action=login");
                        exit();
                    }
                    $admin->deleteUser(); 
                    break; 
          case"update_user":
                
                    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                        header("Location: index.php?action=login");
                        exit();
                    }
                    $admin->updateUser();
                    break;
                    case 'task_details':
                        if (!isset($_SESSION['user_id'])) {
                            header("Location: index.php?action=login");
                            exit();
                        }
                        $taskId = $_GET['task_id'] ?? null;
                        if ($taskId) {
                            $task->details($taskId);
                        } else {
                            header("Location: index.php?action=user_dashboard");
                        }
                        break;

                        case 'create_user_task':
                            if (!isset($_SESSION['user_id'])) {
                                header("Location: index.php?action=login");
                                exit();
                            }
                            $task->createUserTask();
                            break;
           default:
    
        $auth->login();
        break;
}



?>

