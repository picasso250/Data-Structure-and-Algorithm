<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

$tree = new BinTree(
    2,
    new BinTree(1, new BinTree(4)),
    new BinTree(
        3, 
        new BinTree(6), 
        new BinTree(5)
    )
);

$echo = function ($node_data){
    echo "$node_data ";
};
echo "<hr>first_order_walk<br>";
$tree->first_order_walk($echo);
echo "<hr>mid_order_walk<br>";
$tree->mid_order_walk($echo);
echo "<hr>last_order_walk<br>";
$tree->last_order_walk($echo);
echo "<hr>";

/**
* 
*/
class BinTree
{
    public $root;
    public function __construct($data, $left = null, $right = null)
    {
        $this->root = array($data);
        if ($left instanceof BinTree) {
            $this->root[1] = $left->root;
        } else {
            $this->root[1] = $left;
        }
        if ($right instanceof BinTree) {
            $this->root[2] = $right->root;
        } else {
            $this->root[2] = $right;
        }
    }

    public function left()
    {
        if ($this->root) {
            return $this->root[1];
        }
        return null;
    }
    public function right()
    {
        if ($this->root) {
            return $this->root[2];
        }
        return null;
    }

    public function data()
    {
        if ($this->root) {
            return $this->root[0];
        }
        return null;
    }

    public function is_empty()
    {
        return !$this->root;
    }

    public function first_order_walk($callback)
    {
        self::first_order_walk_iter($this->root, $callback);
    }
    public static function first_order_walk_iter($tree, $callback)
    {
        if ($tree) {
            $callback($tree[0]);
            self::first_order_walk_iter($tree[1], $callback);
            self::first_order_walk_iter($tree[2], $callback);
        }
    }

    public function mid_order_walk($callback)
    {
        self::mid_order_walk_iter($this->root, $callback);
    }
    public static function mid_order_walk_iter($tree, $callback)
    {
        if ($tree) {
            self::mid_order_walk_iter($tree[1], $callback);
            $callback($tree[0]);
            self::mid_order_walk_iter($tree[2], $callback);
        }
    }

    public function last_order_walk($callback)
    {
        self::last_order_walk_iter($this->root, $callback);
    }
    public static function last_order_walk_iter($tree, $callback)
    {
        if ($tree) {
            self::last_order_walk_iter($tree[1], $callback);
            self::last_order_walk_iter($tree[2], $callback);
            $callback($tree[0]);
        }
    }
}
