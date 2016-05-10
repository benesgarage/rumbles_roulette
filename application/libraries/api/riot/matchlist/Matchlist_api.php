<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: LOOK AT SUMMONER_IDS IMPLEMENTATION, POOR EXECUTION BY ASSIGNING IT INTO URL ENDPOINTS
class Match_api extends Base_api {

    private $url;
    private $query;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url = $this->url_list->match_url;
    }

    protected function load() {
        parent::load();
    }

    public function fetch_matchlist_by_summoner_id(int $id, bool $include_timeline) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                     = $this->url;
        $params                  = $this->endpoint_suffixes->fetch_match_by_id;
        interlace_parameters($params,$id);
        $query                   = $this->query;
        $query->includeTimeline  = ($include_timeline)? 'true' : 'false';
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
}