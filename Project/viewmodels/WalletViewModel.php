<?php
require_once 'models/Wallet.php';

class WalletViewModel
{
    private $wallet;

    public function __construct()
    {
        $this->wallet = new Wallet();
    }

    public function getWalletList()
    {
        return $this->wallet->getAll();
    }

    public function getWalletById($id)
    {
        return $this->wallet->getById($id);
    }

    public function addWallet($name, $initial_balance, $created_at)
    {
        return $this->wallet->create($name, $initial_balance, $created_at);
    }

    public function updateWallet($id, $name, $initial_balance)
    {
        return $this->wallet->update($id, $name, $initial_balance);
    }

    public function deleteWallet($id)
    {
        return $this->wallet->delete($id);
    }

    public function getWalletsWithBalance() {
        return $this->wallet->getWalletListWithBalance();
    }
}
