<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Championmastery_api extends Base_api {

    private $url;
    private $query;
    private $api_config_file = '/riot/mastery';

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->load();
        $this->CI->config->load($this->api_config_file,true);
        $this->url = $this->CI->config->item('endpoint',$this->api_config_file);
    }

    protected function load() {
        parent::load();
    }

    public function fetch_champion_mastery(int $champion_id) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url               = $this->url;
        $query             = $this->query;
        $params            = $this->endpoint_suffixes->fetch_champion_mastery;
        interlace_parameters($params,$champion_id);
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url); 
    }

    public function fetch_champion_masteries() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url            = $this->url;
        $query          = $this->query;
        $params         = $this->endpoint_suffixes->fetch_champion_masteries;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);  
    }

    public function fetch_mastery_score() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url            = $this->url;
        $query          = $this->query;
        $params         = $this->endpoint_suffixes->fetch_mastery_score;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_top_mastery_entries(int $count = 3) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url            = $this->url;
        $query          = $this->query;
        $query->count   = $count;
        $params         = $this->endpoint_suffixes->fetch_top_mastery_entries;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
}