<?php

require 'BinSearchTree.php';

$tree = new BinSearchTree();
$tree->insert(3);
$tree->insert(1);
$tree->insert(2);
$tree->insert(7);
$tree->insert(9);
$tree->insert(4);

var_dump($tree->search(3));
var_dump($tree->search(1));
var_dump($tree->search(5));
var_dump($tree->search(4));
