<?php
require_once 'viewmodels/TransactionViewModel.php';
require_once 'viewmodels/WalletViewModel.php';
require_once 'viewmodels/CategoryViewModel.php';
require_once 'viewmodels/BudgetViewModel.php';

$entity = isset($_GET['entity']) ? $_GET['entity'] : 'category';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

if ($entity === 'transaction') {
    $transactionVM = new TransactionViewModel();

} elseif ($entity === 'wallet') {
    $walletVM = new WalletViewModel();

    switch ($action) {
        case 'list':
            $walletList = $walletVM->getWalletList();
            require_once 'views/walletList.php';
            break;
        case 'add':
            require_once 'views/walletForm.php';
            break;
        case 'edit':
            $id = $_GET['id'];
            $wallet = $walletVM->getwalletById($id);
            require_once 'views/walletForm.php';
            break;
        case 'save':
            $name = $_POST['name'];
            $initial_balance = $_POST['initial_balance'];
            $created_at = $_POST['created_at'];
            $walletVM->addWallet($name, $initial_balance, $created_at);
            header('Location: index.php?entity=wallet&action=list');
            break;
        case 'update':
            $id = $_POST['id'];
            $name = $_POST['name'];
            $initial_balance = $_POST['initial_balance'];
            $walletVM->updateWallet($id, $name, $initial_balance);
            header('Location: index.php?entity=wallet&action=list');
            break;
        case 'delete':
            $id = $_GET['id'];
            $walletVM->deleteWallet($id);
            header('Location: index.php?entity=wallet&action=list');
            break;
        default:
            echo "Invalid action.";
            break;
    }
} elseif ($entity === 'category') {
    $categoryVM = new CategoryViewModel();

    switch ($action) {
        case 'list':
            $categoryList = $categoryVM->getCategoryList();
            require_once 'views/categoryList.php';
            break;
        case 'add':
            require_once 'views/categoryForm.php';
            break;
        case 'edit':
            $id = $_GET['id'];
            $category = $categoryVM->getCategoryById($id);
            require_once 'views/categoryForm.php';
            break;
        case 'save':
            $name = $_POST['name'];
            $type = $_POST['type'];
            $categoryVM->addCategory($name, $type);
            header('Location: index.php?entity=category&action=list');
            break;
        case 'update':
            $id = $_POST['id'];
            $name = $_POST['name'];
            $type = $_POST['type'];
            $categoryVM->updateCategory($id, $name, $type);
            header('Location: index.php?entity=category&action=list');
            break;
        case 'delete':
            $id = $_GET['id'];
            $categoryVM->deleteCategory($id);
            header('Location: index.php?entity=category&action=list');
            break;
        default:
            echo "Invalid action.";
            break;
    }
} elseif ($entity === 'budget') {
    $budgetVM = new BudgetViewModel();

} else {
    echo "Invalid entity.";
}
