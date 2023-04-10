<?php
define('PHP_ROUND_UP',   11);
define('PHP_ROUND_DOWN', 12);

function fround($number, $precision = 0, $mode = PHP_ROUND_HALF_UP) {
    if (is_numeric($number) && !empty($number)) {
        switch($mode) {
            case PHP_ROUND_UP:
            case PHP_ROUND_DOWN:
                if (!empty($precision)) {
                    $precision = pow(10, (int) $precision);
                    $number *= $precision;
                }
                if ($mode == PHP_ROUND_UP xor ($number < 0)) {
                    $number = ceil($number);
                } else {
                    $number = floor($number);
                }
                if (!empty($precision) && !empty($number)) {
                    $number /= $precision;
                }
                break;
            default:
                $number = round($number, $precision, $mode);
                break;
        }
    }
    return (float) $number;
}


function hround($number, $precision = 0, $mode = PHP_ROUND_HALF_UP) {
    if (is_numeric($number) && !empty($number)) {
        switch($mode) {
            case PHP_ROUND_UP:
            case PHP_ROUND_DOWN:
                if (!empty($precision)) {
                    $factor = 10 ** (int) $precision;
                    $number *= $factor;
                }
                if ($mode == PHP_ROUND_UP xor ($number < 0)) {
                    $number = ceil($number);
                } else {
                    $number = floor($number);
                }
                if (!empty($precision) && !empty($number)) {
                    $number /= $factor;
                }
                break;
            default:
                $number = round($number, $precision, $mode);
                break;
        }
    }
    return (float) $number;
}
foreach ([1.1, 2.22, 4.444] as $num) {
    foreach (range(0,4) as $precision) {
        $start = microtime(true);
        $fround = fround($num, $precision, PHP_ROUND_DOWN);
        $split = microtime(true);
        $hround = hround($num, $precision, PHP_ROUND_DOWN);
        $end = microtime(true);
        $t1 = $split - $start;
        $t2 = $end - $split;
        echo "$num fround: $fround hround: $hround time fround: $t1 time hround: $t2".PHP_EOL;
    }
}