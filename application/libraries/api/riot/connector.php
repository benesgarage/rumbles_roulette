<?php

class Connector {
    
    public function __construct() {
        log_message('debug', 'Connector loaded');
    }

    public function get_data(string $url) : stdClass {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }
}