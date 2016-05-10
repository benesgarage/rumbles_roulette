<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Lol_status_api extends Base_api {

    private $url;
    //TODO: THIS API DOESNT REQUIRE API KEY, FURTHERMORE, ENDPOINT ISN'T HTTPS!!!!
    private $query;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url = $this->url_list->status_url;
    }

    protected function load() {
        parent::load();
    }

    public function fetch_shards() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url    = $this->url;
        $params = $this->endpoint_suffixes->fetch_shards;
        $query  = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
//TODO: VALIDATE REGION, MAKE SURE ITS CORRECT, MAYBE LOOK AT IMPLEMENTING VARIABLE ANOTHER WAY
    public function fetch_shard_by_region($region) : stdClass {
        log_message('debug',__FUNCTION__.' started');
        $url    = $this->url;
        $params = $this->endpoint_suffixes->fetch_shard_by_region;
        interlace_parameters($params, $region);
        $query  = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
}