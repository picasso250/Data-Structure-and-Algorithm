<?php
set_time_limit(0);

$arr = array(4, 1, 3, 7, 5);
$test = HeapSort($arr);
echo '<pre>';print_r($test);exit;

/**
 * 将堆调整为大顶堆
 * @param $arr
 * @param $length
 * @param $index
 * @return void
 */
function HeapAdjust(&$arr, $length, $index) {
    $left = 2 * $index + 1;
    $right = 2 * $index + 2;
    $max = $index;
    while ($left < $length || $right < $length) {
        if ($left < $length && $arr[$max] < $arr[$left]) {
            $max = $left;
        }

        if ($right < $length && $arr[$max] < $arr[$right]) {
            $max = $right;
        }

        if ($max != $index) {
            $tmp = $arr[$index];
            $arr[$index] = $arr[$max];
            $arr[$max] = $tmp;

            $index = $max;
            $left = 2 * $index + 1;
            $right = 2 * $index + 2;
        } else {
            break;
        }
    }
}

function HeapSort($arr) {
    $length = count($arr);
    $begin = floor($length / 2 - 1);

    for ($x = $begin; $x >= 0; $x--) {
        HeapAdjust($arr, $length, $x);
    }

    $i = $length;
    while($i > 1) {
        $tmp = $arr[0];
        $arr[0] = $arr[$i - 1];
        $arr[$i - 1] = $tmp;
        $i--;
        HeapAdjust($arr, $i, 0);
    }

    return $arr;
}



/**
 * 插入排序
 * @param $arr
 * @return array
 */
function insertSort($arr) {
    $num = count($arr);
    if($num <= 1) return $arr;
    for ($i = 1; $i < $num; $i++) {
        $x = $arr[$i];
        $j = $i - 1;
        while($j >= 0 && $x < $arr[$j]) {
            $arr[$j + 1] = $arr[$j];
            $j--;
        }
        $arr[$j + 1] = $x;
    }
    return $arr;
}

// 测试代码
$arr = range(1, 10000);
shuffle($arr);
echo '<hr>';
$start = microtime(true);
$res = insertSort($arr);
echo number_format((microtime(true) - $start) * 1000);
echo '<pre>';print_r($res);exit;
