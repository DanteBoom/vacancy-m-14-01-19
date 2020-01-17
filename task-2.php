<?php

$arr = ['red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato'];
$message = '';

for ($i = 1; $i <= 25; $i++)
{
    $word = $arr[array_rand($arr, 1)];
    $color = $arr[array_rand($arr, 1)];

    if ($word === $color) {
        while ($word === $color) {
            $color = $arr[array_rand($arr, 1)];
        }
    }
    $message .= '<span style="margin: 0 2em; color: '. $color .'">'. $word .'</span>';

    if ($i % 5 === 0){
        $message .= '<br>';
    }
}

echo $message;
