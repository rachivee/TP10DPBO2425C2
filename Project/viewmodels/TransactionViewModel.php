<?php
require_once 'models/Transaction.php';
require_once 'models/Wallet.php';
require_once 'models/Category.php';

class TransactionViewModel
{
    private $transaction;
    private $wallet;
    private $category;

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->wallet = new Wallet();
        $this->category = new Category();
    }

    public function getTransactionList()
    {
        return $this->transaction->getAll();
    }

    public function getTransactionById($id)
    {
        return $this->transaction->getById($id);
    }

    public function getWallets()
    {
        return $this->wallet->getAll();
    }

    public function getCategories()
    {
        return $this->category->getAll();
    }

    public function addTransaction($wallet_id, $category_id, $amount, $description, $transaction_date)
    {
        return $this->transaction->create($wallet_id, $category_id, $amount, $description, $transaction_date);
    }

    public function updateTransaction($id, $wallet_id, $category_id, $amount, $description, $transaction_date)
    {
        return $this->transaction->update($id, $wallet_id, $category_id, $amount, $description, $transaction_date);
    }

    public function deleteTransaction($id)
    {
        return $this->transaction->delete($id);
    }

    public function getDashboardSummary() {
        return $this->transaction->getSummary();
    }

    public function getRecentTransactions() {
        return $this->transaction->getRecent(5);
    }
}
