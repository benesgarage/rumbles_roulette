<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription {

    private $CI;
    private $summoner_data;

    public function __construct() {

        $this->CI                =& get_instance();
        $this->summoner_data     = new stdClass();

    }

    public function __destruct() {

        if (isset($this->summoner_data)) {

            unset($this->summoner_data);

        }

    }

    public function set($param, $value = null) {

        $this->summoner_data->{$param} = $value;

    }

    public function get($param = null) {

        return $this->summoner_data->{$param};

    }

    public function get_all() {

        return isset($this->summoner_data) ? $this->summoner_data : null;

    }

}

/* End of file Summoner.php */
/* Location: ./application/libraries/Summoner.php */