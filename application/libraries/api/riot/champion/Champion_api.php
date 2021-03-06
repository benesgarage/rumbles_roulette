<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Champion_api extends Base_api {
    
    private $url;
    private $query;
    private $api_config_file = '/riot/champion';
    
    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->load();
        $this->CI->config->load($this->api_config_file,true);
        $this->url = $this->CI->config->item('endpoint',$this->api_config_file);
        $this->query->api_key = $this->api_key;
    }
    
    protected function load() {
        parent::load();
    }

    public function fetch_champion(int $id) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url    = $this->url;
        $query  = $this->query;
        $params = $id;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_champions(bool $free_to_play) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url               = $this->url;
        $query             = $this->query;
        $query->freeToPlay = $free_to_play ? 'true' : 'false';
        form_url($url,$query);
        return $this->CI->connector->fetch_data_from_url($url);
    }
    
    public function fetch(stdClass $query_params, string $endpoint_suffix) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url    = $this->url;
        $query  = $query_params;
        $params = ($endpoint_suffix)?
            $this->CI->config->item($endpoint_suffix,$this->api_config_file) : null;
    }
}