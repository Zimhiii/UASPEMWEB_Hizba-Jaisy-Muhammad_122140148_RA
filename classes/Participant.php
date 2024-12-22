<?php
// Bagian 2.2: OOP Implementation
class Participant {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    // Method to register new participant
    public function register($data) {
        try {
            // Bagian 2.1: Server-side validation
            if (empty($data['name']) || empty($data['education_level']) || 
                empty($data['memorization_level']) || empty($data['phone'])) {
                return ['success' => false, 'message' => 'Semua field harus diisi'];
            }
            
            // Bagian 3.3: Database Manipulation
            $stmt = $this->db->prepare("
                INSERT INTO participants (name, education_level, memorization_level, phone, browser, ip_address)
                VALUES (:name, :education_level, :memorization_level, :phone, :browser, :ip_address)
            ");
            
            $stmt->execute([
                ':name' => $data['name'],
                ':education_level' => $data['education_level'],
                ':memorization_level' => $data['memorization_level'],
                ':phone' => $data['phone'],
                ':browser' => $_SESSION['browser'] ?? '',
                ':ip_address' => $_SESSION['ip_address'] ?? ''
            ]);
            
            return ['success' => true, 'message' => 'Pendaftaran berhasil'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    
    // Method to get all participants
    public function getAllParticipants() {
        try {
            $stmt = $this->db->query("SELECT * FROM participants ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function filterParticipants($filter) {
        $query = "SELECT * FROM participants WHERE 
                  name LIKE :filter OR 
                  education_level LIKE :filter OR 
                  memorization_level LIKE :filter";
        $stmt = $this->db->prepare($query); // Menggunakan $this->db
        $stmt->execute(['filter' => '%' . $filter . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
?>