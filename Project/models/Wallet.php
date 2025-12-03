<?php
require_once "config/Database.php";

class Wallet
{
    private $conn;
    private $table = "wallets";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $initial_balance, $created_at)
    {
        $query = "INSERT INTO " . $this->table . " (name, initial_balance, created_at) VALUES (:name, :initial_balance, :created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':initial_balance', $initial_balance);
        $stmt->bindParam(':created_at', $created_at);
        return $stmt->execute();
    }

    public function update($id, $name, $initial_balance, $created_at)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, initial_balance = :initial_balance, created_at = :created_at WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $id_menu);
        $stmt->bindParam(':initial_balance', $id_pelanggan);
        $stmt->bindParam(':created_at', $jumlah);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
