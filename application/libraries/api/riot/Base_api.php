<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: INTRODUCE LOGIC THAT PERFORMS WHEN RESULT FROM RIOT IS ERROR.
//TODO: TAKING A MORE FLEXIBLE ROUTE, NO ERRORS ON BAD PARAMS, JUST DEFAULTS.
//TODO: START MIGRATING TO PHP7, TYPE HINTING ESSENTIAL FOR CODE INTEGRITY.
//TODO: LOOK AT MOVING GROUPED FUNCTIONS TO SEPARATE CLASSES/FILES TO MAINTAIN COMMON VARIABLES!

/**
 *
 * Mother class of all integrations with RIOT's APIs.
 *
 * Class Api_requests
 */


class Base_api {
    protected $config_file   = RIOT_CONFIG_FILE;
    protected $loaded_configs     = false;
    private $url_config;
    private $region;
    private $platform_id;
    private $summoner_id;
    protected $url_list;
    protected $endpoint_suffixes;
    protected $api_key;
    protected $query;

    public function __construct(stdClass $data) {
        $this->CI =& get_instance();
        $this->load();
        $this->CI->load->library('api/riot/connector');
        $this->CI->load->helper('interlace_parameters');
    }

    protected function load() {
        if(!$this->loaded_configs) {
            $this->CI->config->load(self::$config_file,true);
            $this->url_config        = (object) $this->CI->config->item('endpoints',self::$config_file);
            $this->platform_id       = $this->CI->config->item('region_platform_equivalents', self::$config_file)[$this->region];
            $this->endpoint_suffixes = (object) $this->CI->config->item('endpoint_suffixes', self::$config_file);
            $this->api_key           = $this->CI->config->item('api_key', self::$config_file);
            $this->url_list          = $this->set_url_list();
            $this->query             = new stdClass();
            $this->query->api_key    = $this->api_key;
            $this->loaded_configs    = true;
        }
    }
    


//TODO: TAKING IDEAS FROM KITMAKER, HANDLER/CONNECTOR IMPLEMENTATION?
//TODO: IMPLEMENT FUNCTIONS IN THEIR RESPECTIVE API SECTION/FILE/CLASS

    private function load_config_data(string $config_data) {
        log_message('debug', __FUNCTION__.' started');
        log_message('debug', "Loading item from config file '{$config_data}'");
        if (!isset($this->{$config_data})) {
            $this->{$config_data} = $this->CI->config->item($config_data, self::$config_file);
        } else {
            log_message('debug', 'Data already loaded, doing nothing...');
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

    public function fetch_leagues_by_summoner_ids(array $summoner_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $summoner_id_csv = implode(',',$summoner_id_array);
        $url             = $this->url_list->league_url;
        $query           = new stdClass();
        $query->api_key  = $this->api_key;
        $params          = $this->endpoint_suffixes->fetch_leagues_by_summoner_ids;
        interlace_parameters($params, $summoner_id_csv);
        form_url($url, $query, $params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_league_by_summoner_ids(array $summoner_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $summoner_id_csv = implode(',',$summoner_id_array);
        $url             = $this->url_list->league_url;
        $params          = $this->endpoint_suffixes->fetch_league_by_summoner_ids;
        $query           = new stdClass();
        $query->api_key  = $this->api_key;
        interlace_parameters($params, $summoner_id_csv);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_leagues_by_team_ids(array $team_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $team_id_csv    = implode(',',$team_id_array);
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = $this->endpoint_suffixes->fetch_leagues_by_team_ids;
        interlace_parameters($params, $team_id_csv);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_league_by_team_ids(array $team_id_array) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $team_id_csv    = implode(',',$team_id_array);
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        $params         = $this->endpoint_suffixes->fetch_league_by_team_ids;
        interlace_parameters($params, $team_id_csv);
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_challenger_leagues(string $game_type) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data = 'game';
        $this->load_config_data($config_data);
        $game_type      = (in_array($game_type, $this->{$config_data}->game_types))?
                          $game_type : $this->ur{$config_data}->default_game_type;
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->type    = $game_type;
        $query->api_key = $this->api_key;
        $params         = $this->endpoint_suffixes->fetch_challenger_leagues;
        form_url($url,$query, $params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_master_leagues(string $game_type) : stdClass  {
        log_message('debug', __FUNCTION__.' started');
        $config_data = 'game';
        $this->load_config_data($config_data);
        $game_type      = (in_array($game_type, $this->{$config_data}->game_types))?
                          $game_type : $this->{$config_data}->default_game_type;
        $url            = $this->url_list->league_url;
        $query          = new stdClass();
        $query->type    = $game_type;
        $query->api_key = $this->api_key;
        $params         = $this->endpoint_suffixes->fetch_challenger_leagues;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_champions(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data                = 'static_data';
        $this->load_config_data($config_data);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->endpoint_suffixes->fetch_static_champions;
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->{$config_data}->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->{$config_data}->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->{$config_data}->data_by_id;
        $query->champ_data          = (isset($data->champ_data) 
                                      && is_string($data->champ_data) 
                                      && in_array($data->champ_data,$this->{$config_data}->champ_data_values))?
                                      $data->champ_data : $this->{$config_data}->champ_data;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_champion(int $id, stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data                = 'static_data';
        $this->load_config_data($config_data);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->endpoint_suffixes->fetch_static_champion;
        interlace_parameters($params,$id);
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->{$config_data}->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->{$config_data}->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->{$config_data}->data_by_id;
        $query->champ_data          = (isset($data->champ_data) 
                                      && is_string($data->champ_data)
                                      && in_array($data->champ_data,$this->{$config_data}->champ_data_values))?
                                      $data->champ_data : $this->{$config_data}->champ_data;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_items(stdClass $data) :stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data                = 'static_data';
        $this->load_config_data($config_data);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->endpoint_suffixes->fetch_static_items;
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->{$config_data}->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->{$config_data}->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->{$config_data}->data_by_id;
        $query->item_list_data      = (isset($data->item_list_data) 
                                      && is_string($data->item_list_data)
                                      && in_array($data->item_list_data,$this->{$config_data}->item_list_data_values))?
                                      $data->item_list_data : $this->{$config_data}->item_list_data;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }
    public function fetch_static_item(int $id,stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data                = 'static_data';
        $this->load_config_data($config_data);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->endpoint_suffixes->fetch_static_item;
        interlace_parameters($params,$id);
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->{$config_data}->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->{$config_data}->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->{$config_data}->data_by_id;
        $query->item_list_data      = (isset($data->item_list_data) 
                                      && is_string($data->item_list_data) 
                                      && in_array($data->item_list_data,$this->{$config_data}->item_list_data_values))?
                                      $data->item_list_data : $this->{$config_data}->item_list_data;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_lang_strings(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data                = 'static_data';
        $this->load_config_data($config_data);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->endpoint_suffixes->fetch_static_lang_strings;
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->{$config_data}->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->{$config_data}->locale;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_languages() : stdClass {
        //TODO: COULD IMPLEMENT A WAY OF UPDATING CURRENT CONFIG FILE TO MAINTAIN THIS DATA, USE THIS TO UPDATE.
        log_message('debug', __FUNCTION__.' started');
        $config_data    = 'static_data';
        $this->load_config_data($config_data);
        $url            = $this->url_list->static_data_url;
        $params         = $this->endpoint_suffixes->fetch_static_langs;
        $query          = new stdClass();
        $query->api_key = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_map(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $config_data                = 'static_data';
        $this->load_config_data($config_data);
        $url                        = $this->url_list->static_data_url;
        $params                     = $this->endpoint_suffixes->fetch_static_map;
        $query                      = new stdClass();
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->{$config_data}->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->{$config_data}->locale;
        $query->api_key             = $this->api_key;
        form_url($url,$query,$params);
        return $this->fetch_data_from_url($url);
    }

    public function fetch_static_masteries(stdClass $data) : stdClass {
        //TODO: IMPLEMENT IDENTICAL CODE AS SEEN IN ALL OTHER STATIC CALLS
    }


}