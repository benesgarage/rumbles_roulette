<?php

declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: WE COULD SET DEFAULT PARAMS FOR DATA DRAGON AND LOCALE, AND OFFER A SET FUNCTION
class Game_api extends Base_api {

    private $url;
    private $query;
    private $params;
    private $static_data_config;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url                = $this->url_list->static_data_url;
        $this->static_data_config = $this->CI->config->item('static_data',$this->config_file);
    }

    protected function load() {
        parent::load();
    }

    public function fetch_static_champions(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $query                      = $this->query;
        $params                     = $this->endpoint_suffixes->fetch_static_champions;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->static_data_config->data_by_id;
        $query->champ_data          = (isset($data->champ_data)
                                      && is_string($data->champ_data)
                                      && in_array($data->champ_data,$this->static_data_config->champ_data_values))?
                                      $data->champ_data : $this->static_data_config->champ_data;
        form_url($this->url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($this->url);
    }

    public function fetch_static_champion(int $id, stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_champion;
        interlace_parameters($params,$id);
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->static_data_config->data_by_id;
        $query->champ_data          = (isset($data->champ_data)
                                      && is_string($data->champ_data)
                                      && in_array($data->champ_data,$this->static_data_config->champ_data_values))?
                                      $data->champ_data : $this->static_data_config->champ_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_items(stdClass $data) :stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_items;
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->static_data_config->data_by_id;
        $query->item_list_data      = (isset($data->item_list_data)
                                      && is_string($data->item_list_data)
                                      && in_array($data->item_list_data,$this->static_data_config->item_list_data_values))?
                                      $data->item_list_data : $this->static_data_config->item_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_item(int $id,stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_item;
        interlace_parameters($params,$id);
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        $query->dataById            = (isset($data->data_by_id) && is_bool($data->data_by_id))?
                                      $data->data_by_id : $this->static_data_config->data_by_id;
        $query->item_list_data      = (isset($data->item_list_data)
                                      && is_string($data->item_list_data)
                                      && in_array($data->item_list_data,$this->static_data_config->item_list_data_values))?
                                      $data->item_list_data : $this->static_data_config->item_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_lang_strings(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_lang_strings;
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_languages() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params         = $this->endpoint_suffixes->fetch_static_langs;
        $query          = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_map(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_map;
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_masteries(stdClass $data) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_masteries;
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        $query->mastery_list_data   = (isset($data->mastery_list_data)
                                      && is_string($data->mastery_list_data)
                                      && in_array($data->mastery_list_data,$this->static_data_config->mastery_list_data_values))?
                                      $data->mastery_list_data : $this->static_data_config->mastery_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
    
    public function fetch_static_masteries_by_id(int $id, stdClass $data) : stdClass {
        log_message('debug',__FUNCTION__.' started');
        $params                     = $this->endpoint_suffixes->fetch_static_mastery_by_id;
        interlace_parameters($params,$id);
        $query                      = $this->query;
        $query->data_dragon_version = (isset($data->data_dragon_version) && is_string($data->data_dragon_version))?
                                      $data->data_dragon_version : $this->static_data_config->data_dragon_version;
        $query->locale              = (isset($data->locale) && is_string($data->locale))?
                                      $data->locale : $this->static_data_config->locale;
        $query->mastery_list_data   = (isset($data->mastery_list_data)
                                      && is_string($data->mastery_list_data)
                                      && in_array($data->mastery_list_data,$this->static_data_config->mastery_list_data_values))?
                                      $data->mastery_list_data : $this->static_data_config->mastery_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
    
    public function fetch_static_realm() : stdClass{
        log_message('debug',__FUNCTION__.' started');
        $params = $this->endpoint_suffixes->fetch_static_realm;
        $query = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    //TODO: FETCH RUNE DATA

}