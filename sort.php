<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// 检验正确性
for ($i=0; $i < 10; $i++) { 
    $g = $f = $e = $d = $c = $b = $a = make_random_array(10);
    sort($a);

    insert_sort($b);
    assert($a==$b);

    select_sort($c);
    assert($a==$c);

    merge_sort($d);
    assert($a==$d);

    quick_sort($e);
    assert($a==$e);

    heap_sort($f);
    assert($a==$f);

    $g = quick_sort2($g);
    assert($a==$g);
}
$a = array(40, 30, 20, 10, 50,);

// 插入排序
// 假设之前的序列已经有序，将待排元素插入至合适位置
function insert_sort(&$a)
{
    $n = count($a);
    for ($i=1; $i < $n; $i++) { // i 是待插入的元素 从 1 到 n-1
        $t = $a[$i]; // 暂存待插入的元素
        $j = $i - 1; // 从待插入的前一个元素比较
        while ($j >= 0 && $a[$j] > $t) { // 如还未到应插入的位置
            $a[$j+1] = $a[$j]; // 移动至下一个元素
            $j--;
        }
        $a[$j+1] = $t; // 终于，插入这个元素
    }
}

// 选择排序
// 选出最小的，放入未有序的序列的最前面
function select_sort(&$a)
{
    $n = count($a);
    $n_1 = $n - 1;
    for ($i=0; $i < $n_1; $i++) { // i 是待交换的
        $min = $a[$i+1];
        $min_i = $i+1;
        for ($j=$i+2; $j < $n; $j++) { 
            // 选出最小的值
            if ($a[$j] < $min) {
                $min = $a[$j];
                $min_i = $j;
            }
        }
        if ($a[$i] > $a[$min_i]) {
            // 交换
            list($a[$i], $a[$min_i]) = array($a[$min_i], $a[$i]);
        }
    }
}

// 归并排序
// 将一个序列划分为两个序列，假设这两个数列已经有序
// 则问题转化为将这两个有序序列归并
function merge_sort(&$a)
{
    // 分组
    $n = count($a);
    if ($n > 1) {
        $n1 = floor($n / 2);
        $n2 = $n - $n1;
        $a1 = array_slice($a, 0, $n1);
        $a2 = array_slice($a, $n1);

        // 确保有序
        merge_sort($a1);
        merge_sort($a2);

        // 归并
        $i = $i1 = $i2 = 0;
        while ($i1 < $n1 && $i2 < $n2) {
            if ($a1[$i1] < $a2[$i2]) {
                $a[$i] = $a1[$i1];
                $i1++;
            } else {
                $a[$i] = $a2[$i2];
                $i2++;
            }
            $i++;
        }

        // 如果还有剩余，一概填入队尾
        while ($i1 < $n1) {
            $a[$i++] = $a1[$i1++];
        }
        while ($i2 < $n2) {
            $a[$i++] = $a2[$i2++];
        }
    }
}

// 快速排序
// 找一个基准点，将序列中小于此基准点的全部移到基准点的前面
// 对前半部分序列和后半部分序列继续运用此策略
function quick_sort(&$a, $start = 0, $end = null)
{
    if ($end === null) {
        $end = count($a);
    }
    if ($start+1 >= $end)
        return;
    $p = $start; // 基准点
    $i = $p + 1;
    while ($i < $end) {
        if ($a[$p] > $a[$i]) {
            // 如果 基准点 大于这个元素
            // 则将基准点及右侧大的元素整体右移一格
            $j = $i;
            $t = $a[$i];
            while ($j > $p) {
                $a[$j] = $a[$j-1];
                $j--;
            }
            $a[$p] = $t;
            $p++;
        }
        $i++;
    }
    quick_sort($a, $start, $p);
    quick_sort($a, $p+1, $end);
}

function quick_sort2($a)
{
    $n = count($a);
    if ($n <= 1) {
        return $a;
    }
    $pivot = $a[0];
    $left = $right = array();
    for ($i=1; $i < $n; $i++) { 
        if ($a[$i] < $pivot) {
            $left[] = $a[$i];
        } else {
            $right[] = $a[$i];
        }
    }
    return array_merge(quick_sort2($left), array($pivot), quick_sort2($right));
}

// 堆排序
// 构建大顶堆，则首层是最大数，将之移到序列的末尾
function heap_sort(&$a)
{
    $n = count($a);
    if ($n <= 1) {
        return;
    }
    $i = $n-1; // 将大顶与之交换
    while ($i >= 1) {
        // 构建大顶堆
        for ($j=1; $j <= $i; $j++) {
            // 冒泡至最上层
            $t = $a[$j];
            $c_i = $j;
            $f_i = ceil($j/2) - 1;
            while ($f_i >= 0 && $a[$f_i] < $t) {
                $a[$c_i] = $a[$f_i];
                $c_i = $f_i;
                $f_i = ceil($f_i/2) - 1;
            }
            $a[$c_i] = $t;
        }

        // 交换
        list($a[0], $a[$i]) = array($a[$i], $a[0]);
        $i--;
    }
}

function make_random_array($n)
{
    for ($i=0; $i < $n; $i++) { 
        $ret[] = rand();
    }
    return $ret;
}

die('ok');
