<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Champion_api extends Base_api {
    
    private $url;
    private $query;
    private $params;
    
    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url = $this->url_list->champion_url;
    }
    
    protected function load() {
        parent::load();
    }

    public function fetch_champion(int $id) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query  = $this->query;
        $params = array($id);
        form_url($this->url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_champions(bool $free_to_play) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query             = $this->query;
        $query->freeToPlay = $free_to_play ? 'true' : 'false';
        form_url($this->url,$query);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }
}