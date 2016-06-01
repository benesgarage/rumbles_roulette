<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Api {
    private $url;
    private $query;
    private $api_config_file;

    public function __construct(stdClass $data) {
        $this->CI      =& get_instance();
    }

    public function load(string $api_config_file) {
        if($this->api_config_file !== $api_config_file) {
            $this->api_config_file = $api_config_file;
            $this->config->load($this->api_config_file,true);
            $this->url = $this->CI->config->item('endpoint',$this->api_config_file);
        }
    }
}