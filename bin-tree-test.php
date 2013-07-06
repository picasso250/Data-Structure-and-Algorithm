<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

require 'BinTree.php';

$tree = new BinTree(
    2,
    new BinTree(1, new BinTree(4)),
    new BinTree(
        3, 
        new BinTree(6), 
        new BinTree(5)
    )
);

var_dump($tree);

$echo = function ($node_data){
    echo "$node_data ";
};
echo "<hr>pre_order_walk<br>";
$tree->pre_order_walk($echo);
echo "<hr>in_order_walk<br>";
$tree->in_order_walk($echo);
echo "<hr>post_order_walk<br>";
$tree->post_order_walk($echo);
echo "<hr>";

echo "height<br>";
echo $tree->height();
echo "<hr>";

echo "size<br>";
echo $tree->size();
echo "<hr>";

