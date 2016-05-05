<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: INTRODUCE LOGIC THAT PERFORMS WHEN RESULT FROM RIOT IS ERROR.
//TODO: TAKING A MORE FLEXIBLE ROUTE, NO ERRORS ON BAD PARAMS, JUST DEFAULTS.
//TODO: START MIGRATING TO PHP7, TYPE HINTING ESSENTIAL FOR CODE INTEGRITY.

/**
 *
 * All functions will have the sole purpose of fetching information from the given
 * url.
 * The class itself stores info on the current inputted user.
 *
 * Class Api_requests
 */


class Search_user {
    private static $config_file;
    private $region;
    private $platform_id;
    private $summoner_id;
    private $url_list;

    public function __construct(array $data) {
        /** *************************************************** **/
        /*  ********************DEBUG CODE*********************  */
        /** *************************************************** **/
        foreach($data as $key => $value) {
            $this->{$key} = $value;
        }
        /** *************************************************** **/
        /*  ****************END DEBUG CODE*********************  */
        /** *************************************************** **/
        self::$config_file        = 'riot';
        $this->CI                 =& get_instance();
        $this->CI->config->load(self::$config_file,true);
        $this->url_config         = (object) $this->CI->config->item('endpoints',self::$config_file);
        $this->platform_id        = (string) $this->CI->config->item('region_platform_equivalents', self::$config_file)[$this->region];
        $this->enpoint_suffixes   = (object) $this->CI->config->item('endpoint_suffixes', self::$config_file);
        $this->api_key            = (string) $this->CI->config->item('api_key', self::$config_file);
        $this->url_list = $this->set_url_list();
        $this->CI->load->helper('interlace_parameters');
        /** *************************************************** **/
        /*  ********************DEBUG CODE*********************  */
        /** *************************************************** **/
        var_dump($this->url_config);
        var_dump($this->url_list);
        /** *************************************************** **/
        /*  ****************END DEBUG CODE*********************  */
        /** *************************************************** **/
    }
    


//TODO: TAKING IDEAS FROM KITMAKER, HANDLER/CONNECTOR IMPLEMENTATION?

    private function load_config_data(string $config_data) {
        if(!isset($this->{$config_data})) {
            $this->{$config_data} = $this->CI->config->item($config_data, self::$config_file);
        }
    }

    public function set_url_list() : stdClass {
        $find     = array('{region}','{summoner_id}','{platform_id}');
        $replace  = array($this->region,$this->summoner_id,$this->platform_id);
        $url_list = new stdClass();
        foreach ($this->url_config as $key => $value) $url_list->{$key} = str_replace($find, $replace, $value);
        return $url_list;
    }
    
    private function fetch_data_from_url(string $url) : stdClass {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    /**
     *
     * Eigther fetches all champions, using free_to_play to restrict the list to only free champions,
     * or fetch data on a particular champion, using id to determine the champions ID.
     *
     * @param $id
     * @return bool|mixed
     */
    public function fetch_champion(int $id) : stdClass {
        log_message('debug', 'FETCH_CHAMPION STARTED');
        $url            = $this->url_list->champion_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = array($id);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }
    
    public function fetch_champions(bool $free_to_play) : stdClass {
        log_message('debug', 'FETCH_CHAMPIONS STARTED');
        $url               = $this->url_list->champion_url;
        $query             = new stdClass();
        $query->api_key    = $this->api_key;
        $query->freeToPlay = $free_to_play ? 'true' : 'false';
        form_url($url,$query);
        return $this->fetch_data_from_url($url);
    }
    
    public function fetch_champion_mastery(int $champion_id) : stdClass {
        log_message('debug', 'FETCH_CHAMPION_MASTERY STARTED');
        $url               = $this->url_list->mastery_url;
        $query             = new stdClass();
        $query->api_key    = $this->api_key;
        $params            = $this->enpoint_suffixes->fetch_champion_mastery;
        interlace_parameters($params,$champion_id);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_champion_masteries() : stdClass {
        log_message('debug', 'FETCH_CHAMPION_MASTERIES STARTED');
        $url            = $this->url_list->mastery_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_champion_masteries;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }
    
    public function fetch_mastery_score() : stdClass {
        log_message('debug', 'FETCH_MASTERY_SCORE STARTED');
        $url            = $this->url_list->mastery_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_mastery_score;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_top_mastery_entries(int $count = 3) : stdClass {
        log_message('debug', 'FETCH_TOP_MASTERY_ENTRIES STARTED');
        $url            = $this->url_list->mastery_url;
        $query          = new stdClass();
        $query->count   = $count;
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_top_mastery_entries;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_current_game() : stdClass {
        log_message('debug', 'FETCH_CURRENT_GAME STARTED');
        $url            = $this->url_list->current_game_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        form_url($url,$query);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_featured_games() : stdClass {
        log_message('debug', 'FETCH_FEATURED_GAME STARTED');
        $url            = $this->url_list->featured_games_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        form_url($url,$query);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_recent_games() : stdClass {
        log_message('debug', 'FETCH_RECENT_GAMES STARTED');
        $url            = $this->url_list->games_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        form_url($url,$query);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_leagues_by_summoner_ids(array $summoner_id_array) : stdClass {
        log_message('debug', 'FETCH_LEAGUES_BY_SUMMONER_IDS STARTED');
        $summoner_id_csv = implode(',',$summoner_id_array);
        $url             = $this->url_list->league_url;
        $query           = new stdClass();
        $query->api_key  = $this->api_key;
        $params          = $this->enpoint_suffixes->fetch_leagues_by_summoner_ids;
        interlace_parameters($params, $summoner_id_csv);
        form_url($url, $query, $params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_league_by_summoner_ids(array $summoner_id_array) : stdClass {
        log_message('debug', 'FETCH_LEAGUE_BY_SUMMONER_IDS STARTED');
        $summoner_id_csv = implode(',',$summoner_id_array);
        $url             = $this->url_list->league_url;
        $params          = $this->enpoint_suffixes->fetch_league_by_summoner_ids;
        $query           = new stdClass();
        $query->api_key  = $this->api_key;
        interlace_parameters($params, $summoner_id_csv);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_leagues_by_team_ids(array $team_id_array) : stdClass {
        log_message('debug', 'FETCH_LEAGUES_BY_TEAM_IDS STARTED');
        $team_id_csv    = implode(',',$team_id_array);
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_leagues_by_team_ids;
        interlace_parameters($params, $team_id_csv);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_league_by_team_ids(array $team_id_array) : stdClass {
        log_message('debug', 'FETCH_LEAGUE_BY_TEAM_IDS STARTED');
        $team_id_csv    = implode(',',$team_id_array);
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_league_by_team_ids;
        interlace_parameters($params, $team_id_csv);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_challenger_leagues(string $game_type) {
        log_message('debug', 'FETCH_CHALLENGER_LEAGUES STARTED');
        $game_type      = (in_array($game_type, $this->CI->config->item('game_types', 'riot')))?
                          $game_type : $this->CI->config->item('default_game_type','riot');
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->type    = $game_type;
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_challenger_leagues;
        form_url($url,$query, $params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_master_leagues(string $game_type) {
        log_message('debug', 'FETCH_MASTER_LEAGUES STARTED');
        $game_type      = (in_array($game_type, $this->CI->config->item('game_types', 'riot')))?
                          $game_type : $this->CI->config->item('default_game_type','riot');
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->type    = $game_type;
        $query->api_key = $this->api_key;
        $params         = $this->enpoint_suffixes->fetch_challenger_leagues;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_champions(stdClass $data) : stdClass {
        log_message('debug', 'FETCH_STATIC_CHAMPIONS STARTED');
        //TODO: LOOK AT MAKING A LOAD METHOD, SO THAT THE INSTANCE CAN MAINTAIN REUSED DATA.LIKE API_KEY.
        $static_data                = $this->CI->config->item('static_data', self::$config_file);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->enpoint_suffixes->fetch_static_champions;
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $static_data->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $static_data->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $static_data->data_by_id;
        $query->champ_data          = (isset($data->champ_data) && is_string($data->champ_data) && in_array($data->champ_data,$static_data->champ_data_values))?
                                      $data->champ_data : $static_data->champ_data;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_champion(stdClass $data) : stdClass {
        //TODO: CHECK PARAMS SENT.
        log_message('debug', 'FETCH_STATIC_CHAMPION STARTED');
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/champion/{$id}?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_static_items($data = array()) {
        //TODO: CHECK PARAMS SENT.
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/item?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }
    public function fetch_static_item($id, $data = array()) {
        //TODO: CHECK PARAMS SENT.
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/item/{$id}?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }
}