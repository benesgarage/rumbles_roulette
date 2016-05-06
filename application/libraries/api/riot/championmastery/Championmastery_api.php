<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Championmastery_api extends Base_api {

    private $url;
    private $query;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url = $this->url_list->mastery_url;
    }

    protected function load() {
        parent::load();
    }

    public function fetch_champion_mastery(int $champion_id) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query             = $this->query;
        $params            = $this->endpoint_suffixes->fetch_champion_mastery;
        interlace_parameters($params,$champion_id);
        form_url($this->url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($this->url); 
    }

    public function fetch_champion_masteries() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $params         = $this->endpoint_suffixes->fetch_champion_masteries;
        form_url($this->url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($this->url);  
    }

    public function fetch_mastery_score() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $params         = $this->endpoint_suffixes->fetch_mastery_score;
        form_url($this->url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_top_mastery_entries(int $count = 3) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $query->count   = $count;
        $params         = $this->endpoint_suffixes->fetch_top_mastery_entries;
        form_url($this->url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }
}