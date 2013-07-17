<?php
header("Content-Type:text/html;charset=utf-8");
/**
* 排序
* @author xiekangwang
* @time 2013.07.03
*/

class MySort {
/*四种排序算法的PHP实现 
1) 插入排序(Insertion Sort)的基本思想是： 
每次将一个待排序的记录，按其关键字大小插入到前面已经排好序的子文件中的适当位置，直到全部记录插入完成为止。 
2) 选择排序(Selection Sort)的基本思想是： 
每一趟从待排序的记录中选出关键字最小的记录，顺序放在已排好序的子文件的最后，直到全部记录排序完毕。 
3) 冒泡排序的基本思想是： 
两两比较待排序记录的关键字，发现两个记录的次序相反时即进行交换，直到没有反序的记录为止。 
4) 快速排序实质上和冒泡排序一样，都是属于交换排序的一种应用。所以基本思想和上面的冒泡排序是一样的。 
*/

    //获取随机数
    function getRand($n) {
        $a = array();
        for ($i = 0; $i < $n; $i++) {
            $a[] = rand();
        }
        return $a;
    }

    //快速排序法
    function quickSort($a) {
        $n = count($a);
        if ($n > 1) {
            $middle = $a[0];
            $left = $right = array();
            for ($i = 1; $i < $n; $i++) {
                if ($a[$i] > $middle) {
                    $right[] = $a[$i];
                } else {
                    $left[] = $a[$i];
                }
            }
            return array_merge($this->quickSort($left), array($middle), $this->quickSort($right));
        } else {
            return $a;
        }
    }
    
    //插入排序
    function insertSort($a){
        $n = count($a);
        if(is_array($n) && $n < 1){
            return $a;
        }
        for($i = 1; $i < $n; $i++){
            $b = $a[$i];
            $j = $i - 1;
            while($a[$j] > $b){
                $a[$j+1] = $a[$j];
                $a[$j] = $b;
                $j--;
            }
        }
        return $a;
    }
    
    //选择排序
    function selectSort($a){
        $n = count($a);
        if($n <= 1){
            return $a;
        }
        for($i = 0; $i < $n ; $i++){
            $k = $i;
            for($j = $i + 1; $j < $n; $j++){
                if($a[$k] > $a[$j]){
                    $k = $j;
                }
            }
            if($k != $i){
                $b = $a[$i];
                $a[$i] = $a[$k];
                $a[$k] = $b;
            }
        }
        return $a;
    }

    //冒泡
    function bubbleSort($a){
        $n = count($a);
        if($n <= 1){
            return $a;
        }
        for($i = 0; $i < $n; $i++){
            for($j = $n -1; $j > $i; $j--){
                if($a[$j] < $a[$j-1]){
                    $b = $a[$j];
                    $a[$j] = $a[$j-1];
                    $a[$j-1] = $b;
                }
            }
        }
        return $a;
    }
    
    //交换法排序
    function exchangeSort($a){
        $n = count($a);
        if($n <= 1){
            return $a;
        }
        for($i=0;$i<$n-1;$i++){
            for($j=$i+1;$j<$n;$j++){
                if($a[$j]<$a[$i]){
                    $b = $a[$i];
                    $a[$i] = $a[$j];
                    $a[$j] = $b;
                }
            }
        }
        return $a;
    }
    
    //堆栈排序(未完成)
    function tuckSort($arr){
        $a = count($arr);
        if($a<=1){
            return $arr;
        }  
        for($i=1;$i<$a;$i++){
           
            $j = floor(($i-1)/2);
            if($arr[$i]<$arr[$j]){
               $iTemp = $arr[$i];
               $arr[$i] = $arr[$j];
               $arr[$j] = $iTemp;
            }
        }
        var_dump($arr);
        //$arr = $this->tuckSort($arr);
    }
}

$sortClass = new MySort();
//$arr = range(1, 100);
//$arr = array_flip($arr);

$arr = $sortClass->getRand(100);
//var_dump($arr);
//echo 'hello world!';
//exit;
$startTime = microtime();
//$arr = array(5,1,3,2,4);
//快速
//$result = $sortClass->quickSort($arr);
//插入
//$result = $sortClass->insertSort($arr);
//选择
//$result = $sortClass->selectSort($arr);
//冒泡
//$result = $sortClass->bubbleSort($arr);
//交换法排序
// $result = $sortClass->exchangeSort($arr);

// $endTime = microtime();
// $runTime = $endTime - $startTime;
// var_dump($result);
// echo '运行时间' . $runTime . 'ms';
$arr = array(3,4,2,1,5,8,7,6);
$ss = $sortClass->tuckSort($arr);

