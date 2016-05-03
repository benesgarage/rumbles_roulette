<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class User {
    
    private $CI;
    private $user_data;

    public function __construct() {
        $this->CI =& get_instance();
        $this->user_data = new stdClass();
    }

    public function __destruct() {

        if (isset($this->user_data)) {

            unset($this->user_data);

        }
    }

    public function set($key, $value = null) {

        $this->user_data->{$key} = $value;

    }

    public function get($key = null) {

        return isset($this->user_data->{$key}) ? $this->user_data->{$key} : null;

    }

    public function get_all() {

        return isset($this->user_data) ? $this->user_data : null;
    }

}

/* End of file User.php */
/* Location: ./application/libraries/User.php */