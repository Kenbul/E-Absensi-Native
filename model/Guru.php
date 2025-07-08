<?php
require_once 'config/database.php';

class Guru
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fungsi untuk mendapatkan semua data guru
    public function getAll()
    {
        $query = "SELECT gurus.*, users.username, users.email FROM gurus 
                  JOIN users ON gurus.users_id = users.id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $query = "SELECT gurus.*, users.username, users.email 
                  FROM gurus 
                  JOIN users ON gurus.users_id = users.id 
                  WHERE gurus.id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function nameById($id)
    {
        $query = "SELECT users.username As Nama, gurus.users_id FROM gurus JOIN users ON gurus.users_id = users.id WHERE gurus.id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Fungsi menampilkan nama guru berdasarkan id guuru
    public function getAllWithUsername()
    {
        $query = "SELECT gurus.id, users.username 
              FROM gurus 
              JOIN users ON gurus.users_id = users.id
              ORDER BY users.username ASC";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGuruByEmail($email)
    {
        $sql = "SELECT u.id,
               u.role,
               g.id,
               u.username,
               u.password
        FROM users u
        LEFT JOIN gurus g ON g.users_id = u.id
        WHERE u.email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getGuruByName() {}
}
