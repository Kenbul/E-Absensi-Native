<?php
require_once 'config/database.php';
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findUser($email, $password)
    {
        $query = "SELECT id,role FROM users WHERE email = :email AND password = :password";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($username, $email, $password)
    {
        $role = 'Guru';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // var_dump($hashedPassword);
        // exit();
        $query = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role' => $role
        ]);
        return $this->pdo->lastInsertId();
    }
}
