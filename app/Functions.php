<?php

function orderArraysByKey ($matriz, $key) {
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

function maxIndex ($matriz, $max_index) {
    $array = [];
    for ($i = 0; $i < $max_index; $i++) {
        $array[] = $matriz[$i];
    }
    return $array;
}