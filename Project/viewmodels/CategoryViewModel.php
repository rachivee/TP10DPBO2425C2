<?php
require_once 'models/Category.php';

class CategoryViewModel
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function getCategoryList()
    {
        return $this->category->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->category->getById($id);
    }

    public function addCategory($name, $type)
    {
        return $this->category->create($name, $type);
    }

    public function updateCategory($id, $name, $type)
    {
        return $this->category->update($id, $name, $type);
    }

    public function deleteCategory($id)
    {
        return $this->category->delete($id);
    }
}
