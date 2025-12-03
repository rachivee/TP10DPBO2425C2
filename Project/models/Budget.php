<?php
require_once "config/Database.php";

class Budget
{
    private $conn;
    private $table = "budgets";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // PERBAIKAN: Ditambahkan JOIN agar View bisa menampilkan Nama & Icon Kategori
    public function getAll()
    {
        $query = "SELECT b.*, c.name as category_name
                  FROM " . $this->table . " b
                  JOIN categories c ON b.category_id = c.id
                  ORDER BY b.month_year DESC"; 
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

    public function create($category_id, $amount_limit, $month_year)
    {
        $query = "INSERT INTO " . $this->table . " (category_id, amount_limit, month_year) VALUES (:category_id, :amount_limit, :month_year)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':amount_limit', $amount_limit);
        $stmt->bindParam(':month_year', $month_year);
        return $stmt->execute();
    }

    public function update($id, $category_id, $amount_limit, $month_year)
    {
        $query = "UPDATE " . $this->table . " SET category_id = :category_id, amount_limit = :amount_limit, month_year = :month_year WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':amount_limit', $amount_limit);
        $stmt->bindParam(':month_year', $month_year);
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