<?php

class Auth {
    public function __construct() {
        $this->CI       =& get_instance();
        $this->CI->load->Model('Auth_model');
        $this->username = $this->CI->input->post('username');
        $this->password = $this->CI->input->post('password');
    }

    public function logout_async() {
        $this->CI->session->sess_destroy();
        //TODO: SEND HEADER WITH INFO ON SUCCESSFUL ATTEMPT
    }

    public function logout() {
        $this->CI->session->sess_destroy();
        redirect('/','refresh');
    }

    public function login_async() {
        if($this->Auth_model->login($this->username,$this->password)) {
            //TODO: SEND HEADER WITH INFO ON SUCCESSFUL ATTEMPT
        }else {
            //TODO: SEND HEADER WITH INFO ON UNSUCCESSFUL ATTEMPT
            echo 'Something went wrong';
        }
    }

    public function login() {
        if($this->Auth_model->login($this->username,$this->password)) {
            //TODO: SEND HEADER WITH INFO ON SUCCESSFUL ATTEMPT
            return true;
        }else {
            //TODO: SEND HEADER WITH INFO ON UNSUCCESSFUL ATTEMPT
            return false;
        }
    }
}