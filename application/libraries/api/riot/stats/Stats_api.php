<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: LOOK AT SUMMONER_IDS IMPLEMENTATION, POOR EXECUTION BY ASSIGNING IT INTO URL ENDPOINTS
class Stats_api extends Base_api {

    private $url;
    private $query;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url = $this->url_list->stats_url;
        $this->season_config = 'season';
    }

    protected function load() {
        parent::load();
    }

    public function fetch_ranked_stats_by_id(int $id, string $season = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url           = $this->url;
        $params        = $this->endpoint_suffixes->fetch_ranked_stats_by_id;
        interlace_parameters($params,$id);
        $query         = $this->query;
        $query->SEASON = $this->check_config($season,$this->season_config);
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
    
    public function fetch_stats_summary_by_id(int $id, string $season = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url           = $this->url;
        $params        = $this->endpoint_suffixes->fetch_stats_summary_by_id;
        interlace_parameters($params,$id);
        $query         = $this->query;
        $query->SEASON = $this->check_config($season,$this->season_config);
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
}