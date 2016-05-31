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

//TODO: NO POINT IN LOADING ALL URLS IF THE SUBCLASS ONLY USES ONE, REMOVE REDUNDANT URLS

class Base_api {
    protected $config_file   = RIOT_CONFIG_FILE;
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
            $this->CI->config->load($this->config_file,true);
            $this->url_config        = (object) $this->CI->config->item('endpoints',$this->config_file);
            $this->platform_id       = $this->CI->config->item('region_platform_equivalents', $this->config_file)[$this->region];
            $this->endpoint_suffixes = (object) $this->CI->config->item('endpoint_suffixes', $this->config_file);
            $this->api_key           = $this->CI->config->item('api_key', $this->config_file);
            $this->url_list          = $this->set_url_list();
            $this->query             = new stdClass();
            $this->query->api_key    = $this->api_key;
        }
    }

//TODO: TAKING IDEAS FROM KITMAKER, HANDLER/CONNECTOR IMPLEMENTATION?
//TODO: IMPLEMENT FUNCTIONS IN THEIR RESPECTIVE API SECTION/FILE/CLASS

    public function set_url_list() : stdClass {
        $find     = array('{region}','{summoner_id}','{platform_id}');
        $replace  = array($this->region,$this->summoner_id,$this->platform_id);
        $url_list = new stdClass();
        foreach ($this->url_config as $key => $value) $url_list->{$key} = str_replace($find, $replace, $value);
        return $url_list;
    }

    function check_config(mixed $element,array $config) : mixed{
        return (in_array($element,$config))? $element : $this->CI->config->item($config,$this->config_file)->default;
    }
}