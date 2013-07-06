<?php

require 'BinTree.php';

class BinSearchTree extends BinTree
{
    protected $key;

    public function __construct()
    {
    }

    public function setKeyData($key, $data = null)
    {
        $this->key = $key;
        $this->data = $data;
    }

    public function insert($key, $data = null)
    {
        if ($this->key === null || $this->key == $key) {
            $this->setKeyData($key, $data);
            return;
        }
        if ($this->key > $key) {
            if ($this->left === null) {
                $this->left = new BinSearchTree();
            }
            return $this->left->insert($key, $data);
        }
        if ($this->right === null) {
            $this->right = new BinSearchTree();
        }
        return $this->right->insert($key, $data);
    }

    public function serach($key)
    {
        if ($this->key === null) {
            return false;
        }
        if ($this->key == $key) {
            return true;
        }
        if ($this->key > $key) {
            return $this->left ? $this->left->search($key) : false;
        }
        return $this->right ? $this->right->search($key) : false;
    }

    public function is_empty()
    {
        return parent::is_empty() && $this->key === null;
    }
}