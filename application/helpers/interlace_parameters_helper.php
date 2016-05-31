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

function parameterise_url(&$url, $data) {
    $data = is_array($data) ? $data : array($data);
    foreach ($data as $param) {
        $url .= "/" . $param;
    }
}

function querialise_url(&$url, $data) {
    $data            = is_object($data) ? $data : new stdClass();
    $url            .= '?'.http_build_query($data);
}

function form_url(string &$url, stdClass $query, mixed $params = null){
    parameterise_url($url, $params);
    querialise_url($url, $query);
}