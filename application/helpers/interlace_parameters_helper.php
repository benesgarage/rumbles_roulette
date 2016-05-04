<?php

function interlace_parameters(&$original,$inserted) {
    if(is_array($inserted)) {
        for ($i = 0, $k = 0; $i <= count($original); $i++, $k++) {
            if (isset($inserted[$k])) {
                array_splice($original, $i + 1, 0, $inserted[$k]);
                $i++;
            } else {
                break;
            }
        }
    }else{
        array_splice($original, 1, 0, $inserted);
    }
}