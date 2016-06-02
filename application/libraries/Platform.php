<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO:PROBABLY MOVE CONNECTOR TO THIS FILE
class Platform
{
    private $config_file = RIOT_CONFIG_FILE; // AUTOLOAD THIS DEFINE
    private $api_config_file;
    private $query;

    private $region;
    private $summoner_name;
    private $summoner_id;

    private $url;
    private $endpoint_suffix;

    private $loaded;

    public function __construct() {
        $this->CI      =& get_instance();
        $this->CI->config->load($this->config_file, true);
        $this->query->api_key = $this->CI->config->item('api_key', $this->config_file);
    }

    public function load(string $region, string $summoner_name) {
        if (!$this->loaded) {
            $this->region        = $this->confirm_region($region);
            summoner('region',$this->region);
            //todo:filter summoner name?
            $this->summoner_name = $summoner_name;
            summoner('summoner_name',$this->summoner_name);
            $this->loaded        = true;
            $this->CI->load->library('api/riot/api');
            $this->CI->load->library('api/riot/connector');
        }
    }

    public function load_config(string $api_config_file, string $method) {
        if($this->api_config_file !== $api_config_file) {
            $this->api_config_file = $api_config_file;
            $this->config->load($this->api_config_file,true);
            $this->url = $this->CI->config->item('endpoint',$this->api_config_file);
        }
        $this->endpoint_suffix = $this->CI->config->item($method,$this->api_config_file);
    }

    private function define_url($data, $query) {
        //todo:what if items are not defined?
        $replace = [];
        foreach ($this->CI->config->item('endpoint_replace') as $placeholder) {
            $replace[] = $this->$placeholder;
        }
        $url = str_replace($this->CI->config->item('endpoint_find'), $replace, $this->url);
        $replace = [];
        foreach ($this->CI->config->item('endpoint_replace') as $placeholder) {
            $replace[] = $data->$placeholder;
        }
        $endpoint_suffix = str_replace($this->CI->config->item('endpoint_find'), $replace, $this->endpoint_suffix);
        return $url . $endpoint_suffix . '?' . http_build_query($query);
    }

    private function confirm_region(string $region) : string {
        //todo:fire exception on incorrect region (it's internal, so generic error response)
        $region = strtolower($region);
        return ($this->CI->config->config[$region])? $region : null;
    }

    /**
     *
     * Function will take a CSV string of summoner names and fetch relevant data from RIOT summoner API.
     *
     * In the case that no CSV string is given, the loaded summoner name is used.
     *
     * This uses the 'summoner' API.
     *
     * @param string|null $summoner_names
     * @return stdClass
     */

    private function fetch_summoner_data_by_names(string $summoner_names = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $data                 = new stdClass();
        $data->summoner_names = ($summoner_names)? $summoner_names : $this->summoner_name;
        $this->load_config($this->CI->config->item('summoner',$this->config_file),__FUNCTION__);
        $url                  = $this->define_url($data,$this->query);
        return $this->CI->connector->get_data($url);
    }

    /**
     *
     * Function will take a summoner ID and the season on which the fetch will be made.
     *
     * In the case that no summoner ID was given, the function uses the instances loaded summoner ID
     *
     * If the instance hasn't loaded the summoner ID, fetch_summoner_data_by_names() will be called and the
     * function will assign the id contained in the returned stdClass object to the summoner_id property.
     *
     * If the season given is null or not valid, we assign the default season from the config.
     *
     * This uses the 'stats' API.
     *
     * @param int|null $summoner_id
     * @param null $season
     * @return stdClass
     */

    private function fetch_stats_summary_by_id(int $summoner_id = null, $season = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $data = new stdClass();
        if (!$summoner_id) {
            if (!$this->summoner_id) {
                $this->summoner_id = $this->fetch_summoner_data_by_names()->${$this->summoner_name}->id;
            }
            $data->summoner_id = $this->summoner_id;
        }
        $query = $this->query;
        if (!$season || !in_array(strtoupper($season),$this->CI->config->item('seasons',$this->config_file))) {
            $season = $this->CI->config->item('default_season',$this->config_file);
        }
        $query->season = strtoupper($season);
        $this->load_config($this->CI->config->item('stats',$this->config_file),__FUNCTION__);
        $url = $this->define_url($data,$query);
        return $this->CI->connector->get_data($url);
    }

    private function fetch_champion(int $champion_id) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $data = new stdClass();
        $data->champion_id = $champion_id;
        $this->load_config($this->CI->config->item('champion',$this->config_file),__FUNCTION__);
        $url = $this->define_url($data,$this->query);
        return $this->CI->connector->get_data($url);
    }

    private function fetch_champions(bool $free_rotation) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $data = new stdClass();
    }

    private function fetch(stdClass $configuration) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $this->load_config($this->CI->config->item($configuration->function,$this->config_file),$configuration->function);
        $url = $this->define_url($configuration->data,$configuration->query);
        return $this->CI->connector->get_data($url);
    }
    
    private function formulate_query(stdClass $configuration) {
    }
}

