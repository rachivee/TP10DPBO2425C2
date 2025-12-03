<?php
require_once "config/Database.php";

class Transaction
{
    private $conn;
    private $table = "transactions";

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

    public function create($wallet_id, $category_id, $amount, $description, $transaction_date, $created_at)
    {

    }

    public function update($id, $wallet_id, $category_id, $amount, $description, $transaction_date, $created_at)
    {
        
    }

    public function delete($id)
    {
       
    }
}
