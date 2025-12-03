<?php
require_once 'models/Budget.php';

class BudgetViewModel
{
    private $budget;
    private $category;

    public function __construct()
    {
        $this->budget = new Budget();
        $this->category = new Category();
    }

    public function getBudgetList()
    {
        return $this->budget->getAll();
    }

    public function getBudgetById($id)
    {
        return $this->budget->getById($id);
    }

    public function getCategories()
    {
        return $this->category->getAll();
    }

    public function addBudget($category_id, $amount_limit, $month_year)
    {
        return $this->budget->create($category_id, $amount_limit, $month_year);
    }

    public function updateBudget($id, $category_id, $amount_limit, $month_year)
    {
        return $this->budget->update($id, $category_id, $amount_limit, $month_year);
    }

    public function deleteBudget($id)
    {
        return $this->budget->delete($id);
    }
}
