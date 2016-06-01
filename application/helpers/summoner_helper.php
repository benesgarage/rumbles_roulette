<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function summoner($key, $value = null) {
    
    if($value === null) {
        
        return get_user($key);
        
    } else {
        
        set_user($key,$value);
        
    }
}

function get_summoner($key) {
    
    return CI_Controller::get_instance()->user->get($key);
    
}

function get_all_summoner() {

    return CI_Controller::get_instance()->user->get_all();

}

function set_summoner($key,$value) {

    if($key) {

        CI_Controller::get_instance()->use->set($key,$value);

    }

}

function batch_set_summoner($data) {

    if (is_object($data) || is_array($data)) {

        $data = (object) $data;

    }

    foreach (get_object_vars($data) as $key => $value) {

        CI_Controller::get_instance()->user->set($key,$value);

    }

}

/* End of file summoner_helper.php */
/* Location: ./application/helpers/summoner_helper.php */