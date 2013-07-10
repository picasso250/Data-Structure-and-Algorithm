<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//快速排序   0.0023760795593262
function quick_sort($arr) {
    $a_count = count($arr);
    if ($a_count <= 1) {
        return $arr;
    }
    $k = $arr[0];
    $left = array();
    $right = array();
    for ($i = 1; $i < $a_count; $i++) {
        if ($arr[$i] <= $k) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }
    $left = quick_sort($left);
    $right = quick_sort($right);
    return array_merge($left, array($k), $right);
}

//选择排序 float 0.0042159557342529
function select_sort($arr) {
    $a_count = count($arr);
    if ($a_count <= 1) {
        return $arr;
    }
    for ($i = 0; $i < $a_count - 1; $i++) {
        $min = $arr[$i];
        for ($j = $i + 1; $j < $a_count; $j++) {
            if ($arr[$j] < $min) {
                $min = $arr[$j];
                $key = $j;
            }
        }
        if ($min != $arr[$i]) {
            $temp = $arr[$i];
            $arr[$i] = $arr[$key];
            $arr[$key] = $temp;
        }
    }
    return $arr;
}

for ($i = 0; $i < n; $i++) {
    for ($j = 0; $j < n - i; $j++) {

    }
}

//冒泡排序 float 0.0074238777160645
function bubble_sort($arr) {
    $a_count = count($arr);
    if ($a_count <= 1) {
        return $arr;
    }
    for ($i = 0; $i < $a_count; $i++) {
        for ($j = $a_count - 1; $j > $i; $j--) {
            if ($arr[$j] < $arr[$j - 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j - 1];
                $arr[$j - 1] = $temp;
            }
        }
    }
    return $arr;
}

//插入排序 float 0.0036120414733887
function insert_sort($arr) {
    $a_count = count($arr);
    if ($a_count <= 1) {
        return $arr;
    }
    for ($i = 1; $i < $a_count; $i++) {
        $temp = $arr[$i];
        $j = $i - 1;
        while ($arr[$j] > $temp) {
            $arr[$j + 1] = $arr[$j];
            $arr[$j] = $temp;
            $j--;
        }
    }
    return $arr;
}


//归并排序  float 0.0035130977630615
function merge_sort(&$arr) {
    $a_count = count($arr);
    if ($a_count <= 1) {
        return $arr;
    }
    $m = intval($a_count / 2);
    $arr1 = array_slice($arr, 0, $m);
    $arr2 = array_slice($arr, $m);
    merge_sort($arr1);
    merge_sort($arr2);
    merge($arr1, $arr2, $arr);
    return $arr;
}

function merge(&$arr1, &$arr2, &$arr) {
    $i = $j = $k = 0;
    $arr1_count = count($arr1);
    $arr2_count = count($arr2);
    while ($i < $arr1_count && $j < $arr2_count) {
        if ($arr1[$i] < $arr2[$j]) {
            $arr[$k] = $arr1[$i];
            $i++;
        } else {
            $arr[$k] = $arr2[$j];
            $j++;
        }
        $k++;
    }
    if ($i == $arr1_count) {
        while ($j < $arr2_count) {
            $arr[$k] = $arr2[$j];
            $j++;
            $k++;
        }
    } else {
        while ($i < $arr1_count) {
            $arr[$k] = $arr1[$i];
            $i++;
            $k++;
        }
    }
}











