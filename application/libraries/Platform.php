<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Platform
{
    private $config_file = RIOT_CONFIG_FILE; // AUTOLOAD THIS DEFINE
    private $query;

    private $region;
    private $summoner_name;

    private $loaded;

    public function __construct()
    {
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
        }
    }

    private function confirm_region(string $region) : string {
        //todo:fire exception on incorrect region (it's internal, so generic error response)
        $region = strtolower($region);
        return ($this->CI->config->config[$region])? $region : null;
    }

    private function fetch_summoner_data_by_names() : stdClass {
        $query = $this->query;

    }

    private function fetch_champion(int $id) : stdClass {
        $query = $this->query;

    }
}

