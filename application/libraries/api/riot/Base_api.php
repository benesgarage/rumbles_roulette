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
 * Class Base_api
 */


class Base_api {
    protected $config_file   = RIOT_CONFIG_FILE;
    protected $query;
    protected $api_key;
    protected $region;
    private $summoner_id;
    private $loaded;

    public function __construct(stdClass $data) {
        $this->CI      =& get_instance();
        $this->query   = new stdClass();
        $this->CI->config->load($this->config_file,true);
        $this->api_key = $this->CI->config->item('api_key', $this->config_file);
    }

    protected function load(string $region, string $summoner_name) {
        //todo: maybe some validation for both variables?
        if(!$this->loaded) {
            $this->region        = $this->confirm_region($region);
            //todo:filter summoner name
            $this->summoner_name = $summoner_name;
            $this->loaded        = true;
        }
    }

    private function confirm_region(string $region) : string {
        //todo: what happens when we are given an incorrect region?
        $region = strtolower($region);
        return ($this->CI->config->config[$region])? $region : null;
    }

    public function set_url_list() : stdClass {
        $find     = array('{region}','{summoner_id}','{platform_id}');
        $replace  = array($this->region,$this->summoner_id,$this->platform_id);
        $url_list = new stdClass();
        foreach ($this->url_config as $key => $value) $url_list->{$key} = str_replace($find, $replace, $value);
        return $url_list;
    }

    protected function check_config(mixed $element,array $config) : mixed {
        return (in_array($element,$config))? $element : $this->CI->config->item($config,$this->config_file)->default;
    }

    protected function set_region(){
        preg_replace('/{region}/',$this->region,$this->url);
    }
}