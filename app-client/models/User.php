<?php

require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($nombre, $email, $password) {
        try {
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'cliente')");
            return $stmt->execute([$nombre, $email, $password]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
