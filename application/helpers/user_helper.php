<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function user($key, $value = null) {
    
    if($value === null) {
        
        return get_user($key);
        
    } else {
        
        set_user($key,$value);
        
    }
}

function get_user($key) {
    
    return CI_Controller::get_instance()->user->get($key);
    
}

function get_all_user() {

    return CI_Controller::get_instance()->user->get_all();

}

function set_user($key,$value) {

    if($key) {

        CI_Controller::get_instance()->use->set($key,$value);

    }

}

function batch_set_user($data) {

    if (is_object($data) || is_array($data)) {

        $data = (object) $data;

    }

    foreach (get_object_vars($data) as $key => $value) {

        CI_Controller::get_instance()->user->set($key,$value);

    }

}

/* End of file user_helper.php */
/* Location: ./application/helpers/user_helper.php */