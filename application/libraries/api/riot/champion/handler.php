<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: THINKING ABOUT IT, IN TERMS OF RESOURCE ACCESS, ITS PROBABLY BETTER TO KEEP HANDLER INSIDE API
class Handler {

    private $CI;
    private $url;

    public function __construct() {
        $this->CI  =& get_instance();
        $this->url = $this->CI->config->item('endpoint_suffixes', RIOT_CONFIG_FILE)['champion_url'];

    }
}