<?php

/**
 * 二叉树
 */
class BinTree
{
    private $left;
    private $right;
    private $data;

    public function __construct($data = null, $left = null, $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }

    public function left()
    {
        return $this->left;
    }
    public function right()
    {
        return $this->right;
    }

    public function data()
    {
        return $this->data;
    }

    public function is_empty()
    {
        return $this->left === null && $this->right === null && $this->data === null;
    }

    public function pre_order_walk($callback)
    {
        self::pre_order_walk_iter($this, $callback);
    }
    public static function pre_order_walk_iter($tree, $callback)
    {
        if ($tree) {
            $callback($tree->data);
            self::pre_order_walk_iter($tree->left, $callback);
            self::pre_order_walk_iter($tree->right, $callback);
        }
    }

    public function in_order_walk($callback)
    {
        self::in_order_walk_iter($this, $callback);
    }
    public static function in_order_walk_iter($tree, $callback)
    {
        if ($tree) {
            self::in_order_walk_iter($tree->left, $callback);
            $callback($tree->data);
            self::in_order_walk_iter($tree->right, $callback);
        }
    }

    public function post_order_walk($callback)
    {
        self::post_order_walk_iter($this, $callback);
    }
    public static function post_order_walk_iter($tree, $callback)
    {
        if ($tree) {
            self::post_order_walk_iter($tree->left, $callback);
            self::post_order_walk_iter($tree->right, $callback);
            $callback($tree->data);
        }
    }

    public function height()
    {
        if ($this->left && $this->right) {
            return 1 + max($this->left->height(), $this->right->height());
        }
        if ($this->left) {
            return $this->left->height();
        }
        if ($this->right) {
            return $this->right->height();
        }
        return $this->data === null ? 0 : 1;
    }
    public function size()
    {
        $left_size = $right_size = 0;
        if ($this->left) {
            $left_size = $this->left->size();
        }
        if ($this->right) {
            $right_size = $this->right->size();
        }
        return $left_size + $right_size + ($this->data === null ? 0 : 1);
    }
}