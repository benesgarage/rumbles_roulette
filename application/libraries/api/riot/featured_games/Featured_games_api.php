<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Featured_games_api extends Base_api {

    private $url;
    private $query;
    private $params;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url            = $this->url_list->featured_games_url;
    }

    protected function load() {
        parent::load();
    }

    public function fetch_featured_games() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query = $this->query;
        form_url($this->url,$query);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }
}