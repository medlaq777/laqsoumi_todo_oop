<?php
class Tag {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllTags() {
        $stmt = $this->conn->prepare("SELECT * FROM Tags");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTaskTags($taskId) {
        $stmt = $this->conn->prepare("
            SELECT t.* 
            FROM Tags t 
            JOIN TagsTasks tt ON t.id_tags = tt.tags_id 
            WHERE tt.tasks_id = :taskId
        ");
        $stmt->bindParam(':taskId', $taskId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

