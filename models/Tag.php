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
    
   
}
?>

