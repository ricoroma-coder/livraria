<?php

function orderArraysByKey ($matriz, $key = '') {
    
    for ($i = 1; $i < sizeof($matriz); $i++) {
        if ($matriz[$i][$key] > $matriz[$i-1][$key]) {
            $aux = $matriz[$i-1];
            $matriz[$i-1] = $matriz[$i];
            $matriz[$i] = $aux;
            $i--;
        }
    }

    return $matriz;
}

function orderArrayValues ($array) {
    for ($i = 1; $i < sizeof($array); $i++) {
        if ($array[$i] > $array[$i-1]) {
            $aux = $array[$i-1];
            $array[$i-1] = $array[$i];
            $array[$i] = $aux;
            $i--;
        }
    }

    return $array;
}

function maxIndex ($matriz, $max_index) {
    $max = (sizeof($matriz) < $max_index) ? sizeof($matriz) : $max_index;
    $array = [];
    for ($i = 0; $i < $max; $i++) {
        $array[] = $matriz[$i];
    }
    return $array;
}