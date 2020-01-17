<?php

$arr = preg_split("/[\s,]+/", $argv[1]);

foreach ($arr as $key => $value){
    if (!is_numeric($value) || !is_int($value + 0) || $value === '-0'){
        unset($arr[$key]);
    }
}
$arr = array_unique($arr);
sort($arr);
print_r(implode(" ", $arr)."\n");
