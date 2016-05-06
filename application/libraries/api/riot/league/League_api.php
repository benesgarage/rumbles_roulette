<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: LOOK AT IMPLEMENTATION OF STATIC SO WE CAN REINITIATE QUERIES/PARAMS/CONFIGS.
class League_api extends Base_api {

    private $url;
    private $query;
    private $game_config;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url            = $this->url_list->league_url;
        $this->game_config    = $this->CI->config->item('game',$this->config_file);
    }

    protected function load() {
        parent::load();
    }

    public function fetch_leagues_by_summoner_ids(array $summoner_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query           = $this->query;
        $summoner_id_csv = implode(',',$summoner_id_array);
        $params          = $this->endpoint_suffixes->fetch_leagues_by_summoner_ids;
        interlace_parameters($params, $summoner_id_csv);
        form_url($this->url, $query, $params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_league_by_summoner_ids(array $summoner_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query                 = $this->query;
        $summoner_id_csv       = implode(',',$summoner_id_array);
        $this->url             = $this->url_list->league_url;
        $params                = $this->endpoint_suffixes->fetch_league_by_summoner_ids;
        interlace_parameters($params, $summoner_id_csv);
        form_url($this->url, $query, $params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_leagues_by_team_ids(array $team_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $team_id_csv    = implode(',',$team_id_array);
        $params         = $this->endpoint_suffixes->fetch_leagues_by_team_ids;
        interlace_parameters($this->params, $team_id_csv);
        form_url($this->url, $query, $params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_league_by_team_ids(array $team_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $team_id_csv    = implode(',',$team_id_array);
        $params         = $this->endpoint_suffixes->fetch_league_by_team_ids;
        interlace_parameters($params, $team_id_csv);
        form_url($this->url, $query, $params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_challenger_leagues(string $game_type) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $game_type      = (in_array($game_type, $this->game_config->game_types))?
                          $game_type : $this->game_config->default_game_type;
        $query->type    = $game_type;
        $params         = $this->endpoint_suffixes->fetch_challenger_leagues;
        form_url($this->url, $query, $params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_master_leagues(string $game_type) : stdClass  {
        log_message('debug', __FUNCTION__.' started');
        $query          = $this->query;
        $game_type      = (in_array($game_type, $this->game_config->game_types))?
                          $game_type : $this->game_config->default_game_type;
        $query->type    = $game_type;
        $params         = $this->endpoint_suffixes->fetch_challenger_leagues;
        form_url($this->url, $query, $params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }
}