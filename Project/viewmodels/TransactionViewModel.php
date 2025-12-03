<?php
require_once 'models/Transaction.php';

class TransactionViewModel
{
    private $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function getTransactionList()
    {
        return $this->transaction->getAll();
    }

    public function getTransactionById($id)
    {
        return $this->transaction->getById($id);
    }

    public function addTransaction($wallet_id, $category_id, $amount, $description, $transaction_date, $created_at)
    {
        return $this->transaction->create($wallet_id, $category_id, $amount, $description, $transaction_date, $created_at);
    }

    public function updateTransaction($id, $wallet_id, $category_id, $amount, $description, $transaction_date, $created_at)
    {
        return $this->transaction->update($id, $wallet_id, $category_id, $amount, $description, $transaction_date, $created_at);
    }

    public function deleteTransaction($id)
    {
        return $this->transaction->delete($id);
    }
}
