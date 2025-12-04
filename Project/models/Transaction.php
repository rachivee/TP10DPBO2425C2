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
        $query = "SELECT 
                    t.id, 
                    t.amount, 
                    t.description, 
                    t.transaction_date,
                    t.wallet_id,
                    t.category_id,
                    w.name as wallet_name, 
                    c.name as category_name, 
                    c.type as category_type
                  FROM " . $this->table . " t
                  JOIN wallets w ON t.wallet_id = w.id
                  JOIN categories c ON t.category_id = c.id
                  ORDER BY t.transaction_date DESC, t.id DESC";
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

    public function create($wallet_id, $category_id, $amount, $description, $transaction_date)
    {
        $query = "INSERT INTO " . $this->table . " (wallet_id, category_id, amount, description, transaction_date) VALUES (:wallet_id, :category_id, :amount, :description, :transaction_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':wallet_id', $wallet_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':transaction_date', $transaction_date);
        return $stmt->execute();

    }

    public function update($id, $wallet_id, $category_id, $amount, $description, $transaction_date)
    {
        $query = "UPDATE " . $this->table . " SET wallet_id = :wallet_id, category_id = :category_id, amount = :amount, description = :description, transaction_date = :transaction_date WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':wallet_id', $wallet_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':transaction_date', $transaction_date);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getSummary() {
        $queryIncome = "SELECT SUM(t.amount) as total FROM " . $this->table . " t 
                        JOIN categories c ON t.category_id = c.id 
                        WHERE c.type = 'income'";
        $stmt = $this->conn->prepare($queryIncome);
        $stmt->execute();
        $income = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        $queryExpense = "SELECT SUM(t.amount) as total FROM " . $this->table . " t 
                         JOIN categories c ON t.category_id = c.id 
                         WHERE c.type = 'expense'";
        $stmt = $this->conn->prepare($queryExpense);
        $stmt->execute();
        $expense = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        return [
            'income' => $income,
            'expense' => $expense,
            'balance' => $income - $expense
        ];
    }

    public function getRecent($limit = 5) {
        $query = "SELECT t.*, w.name as wallet_name, c.name as category_name, c.type as category_type
                  FROM " . $this->table . " t
                  JOIN wallets w ON t.wallet_id = w.id
                  JOIN categories c ON t.category_id = c.id
                  ORDER BY t.transaction_date DESC, t.id DESC
                  LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyStats($month, $year)
    {
        $queryIncome = "SELECT SUM(t.amount) as total FROM " . $this->table . " t 
                        JOIN categories c ON t.category_id = c.id 
                        WHERE c.type = 'income' 
                        AND MONTH(t.transaction_date) = :m AND YEAR(t.transaction_date) = :y";
        
        $stmt = $this->conn->prepare($queryIncome);
        $stmt->bindParam(':m', $month);
        $stmt->bindParam(':y', $year);
        $stmt->execute();
        $income = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        $queryExpense = "SELECT SUM(t.amount) as total FROM " . $this->table . " t 
                         JOIN categories c ON t.category_id = c.id 
                         WHERE c.type = 'expense' 
                         AND MONTH(t.transaction_date) = :m AND YEAR(t.transaction_date) = :y";
        
        $stmt = $this->conn->prepare($queryExpense);
        $stmt->bindParam(':m', $month);
        $stmt->bindParam(':y', $year);
        $stmt->execute();
        $expense = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        return [
            'income' => $income,
            'expense' => $expense
        ];
    }
}
