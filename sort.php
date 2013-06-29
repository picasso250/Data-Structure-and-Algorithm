<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

$functions = array(
    'sort',
    'array_bubble_sort',
    'array_insert_sort',
    'array_select_sort',
    'array_merge_sort',
    'array_quick_sort',
    'array_heap_sort',
);
foreach ($functions as $sort_func) {
    echo "<h2>$sort_func</h2>";
    foreach (array(100, 1000) as $n) {
        echo ' ', $n, ' 个元素 ';
        if ($t = test_sort_func_time($sort_func, $n)) {
            echo $t, ' ms<hr>';
        } else {
            echo 'error<hr>';
        }
    }
}

/****************************************************************/
function array_bubble_sort(&$a)
{
    $n = count($a);
    for ($i=0; $i < $n; $i++) {
        $swap = false;
        for ($j=$n-1; $j > $i; $j--) {
            if ($a[$j-1] > $a[$j]) {
                $swap = true;
                list($a[$j-1], $a[$j]) = array($a[$j], $a[$j-1]);
            }
        }
        if (!$swap) {
            return;
        }
    }
}

// 插入排序
// 假设之前的序列已经有序，将待排元素插入至合适位置
function array_insert_sort(&$a)
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
function array_select_sort(&$a)
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
function array_merge_sort(&$a)
{
    // 分组
    $n = count($a);
    if ($n > 1) {
        $n1 = floor($n / 2);
        $n2 = $n - $n1;
        $a1 = array_slice($a, 0, $n1);
        $a2 = array_slice($a, $n1);

        // 确保有序
        array_merge_sort($a1);
        array_merge_sort($a2);

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
function array_quick_sort(&$a)
{
    $n = count($a);
    if ($n <= 1) {
        return $a;
    }
    $pivot = $a[0]; // 轴点
    $left = $right = array();
    for ($i=1; $i < $n; $i++) { 
        if ($a[$i] < $pivot) {
            $left[] = $a[$i];
        } else {
            $right[] = $a[$i];
        }
    }
    return $a = array_merge(array_quick_sort($left), array($pivot), array_quick_sort($right));
}


// 堆排序
// 构建大顶堆，则首层是最大数，将之移到序列的末尾
function array_heap_sort(&$a)
{
    $n = count($a);
    if ($n <= 1) {
        return;
    }

    // 构建大根堆
    array_build_heap($a);

    for ($i=$n-1; $i >= 1; $i--) { 
        // 将最大的数交换到有序列的头部（也就是无序列的尾部）
        // 然后向下冒泡
        list($a[0], $a[$i]) = array($a[$i], $a[0]);
        shift_down($a, $i-1);
    }
}
// 构建大根堆
function array_build_heap(&$a)
{
    $n = count($a);
    if ($n <= 1) {
        return;
    }
    for ($i=1; $i < $n; $i++) { 
        // 如果子节点比父节点大，就持续上位
        $tmp = $a[$i];
        $j = $i;
        while ($j > 0) {
            $f_i = ceil($j/2)-1;
            if ($tmp > $a[$f_i]) {
                $a[$j] = $a[$f_i];
            } else {
                break;
            }
            $j = $f_i;
        }
        if ($a[$j] < $tmp) {
            $a[$j] = $tmp;
        }
    }
}
// 大根堆的向下冒泡
// 0 -- n
function shift_down(&$a, $n)
{
    $tmp = $a[0];
    $i = 0;
    while (true) {
        // 找出最有潜力的子节点
        if ($i * 2 + 2 <= $n) {
            $c_i = $a[$i*2+1] > $a[$i*2+2] ? $i*2+1 : $i*2+2;
        } elseif ($i * 2 + 1 <= $n) {
            $c_i = $i*2+1;
        } else {
            break; // 到最末了
        }

        // 向下冒泡
        if ($tmp < $a[$c_i]) {
            $a[$i] = $a[$c_i];
        } else {
            break;
        }
        $i = $c_i;
    }
    if (isset($i) && $tmp < $a[$i]) {
        $a[$i] = $tmp;
    }
}

function make_random_array($size)
{
    for ($i=0; $i < $size; $i++) { 
        $a[] = rand();
    }
    return $a;
}

function test_sort_func_time($sort_func, $n)
{
    $a = make_random_array($n);
    $b = $a;
    $t = -microtime(true);
    $sort_func($a);
    $t += microtime(true);
    sort($b);
    if ($a != $b) {
        return false;
    } else {
        return round($t * 1000, 3); // ms
    }
}
