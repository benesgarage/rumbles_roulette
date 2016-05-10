<?php

declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: WE COULD SET DEFAULT PARAMS FOR DATA DRAGON AND LOCALE, AND OFFER A SET FUNCTION
class Game_api extends Base_api {

    private $url;
    private $query;
    private $static_data_config;
    private $data_dragon_version;
    private $locale;

    public function __construct(stdClass $data) {
        parent::__construct($data);
        $this->url                        = $this->url_list->static_data_url;
        $this->static_data_config         = $this->CI->config->item('static_data',$this->config_file);
        $this->query->data_dragon_version = $this->static_data_config->data_dragon_version;
        $this->query->locale              = $this->static_data_config->locale;
    }

    protected function load() {
        parent::load();
    }

    public function set_data_dragon(string $version = null) {
        $this->query->data_dragon_version = (isset($version))? $version:$this->static_data_config->data_dragon_version;
    }

    public function set_locale(string $locale = null) {
        $this->query->locale = (isset($locale))? $locale:$this->static_data_config->locale;
    }

    public function fetch_static_champions(bool $data_by_id,string $champ_data = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $query                      = $this->query;
        $params                     = $this->endpoint_suffixes->fetch_static_champions;
        $query->dataById            = ($data_by_id)? 'true' : 'false';
        $query->champ_data          = (isset($champ_data))? $champ_data : $this->static_data_config->champ_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_champion(int $id,bool $data_by_id, string $champ_data = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_champion;
        interlace_parameters($params,$id);
        $query                      = $this->query;
        $query->dataById            = ($data_by_id)? 'true' : 'false';
        $query->champ_data          = (isset($champ_data))? $champ_data : $this->static_data_config->champ_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_items(bool $data_by_id,string $item_list_data = null) :stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_items;
        $query                      = $this->query;
        $query->dataById            = ($data_by_id)? 'true' : 'false';
        $query->item_list_data      = (isset($item_list_data))?
                                      $item_list_data : $this->static_data_config->item_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_item(int $id,bool $data_by_id,string $item_list_data = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_item;
        interlace_parameters($params,$id);
        $query                      = $this->query;
        $query->dataById            = ($data_by_id)? 'true' : 'false';
        $query->item_list_data      = (isset($item_list_data))?
                                      $item_list_data : $this->static_data_config->item_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_lang_strings() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_lang_strings;
        $query                      = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_languages() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url            = $this->url;
        $params         = $this->endpoint_suffixes->fetch_static_langs;
        $query          = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_map() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_map;
        $query                      = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_masteries(string $mastery_list_data = null) : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_masteries;
        $query                      = $this->query;
        $query->mastery_list_data   = (isset($mastery_list_data))?
                                      $mastery_list_data : $this->static_data_config->mastery_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
    
    public function fetch_static_masteries_by_id(int $id, stdClass $mastery_list_data = null) : stdClass {
        log_message('debug',__FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_mastery_by_id;
        interlace_parameters($params,$id);
        $query                      = $this->query;
        $query->mastery_list_data   = (isset($mastery_list_data))?
                                      $mastery_list_data : $this->static_data_config->mastery_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
    
    public function fetch_static_realm() : stdClass{
        log_message('debug',__FUNCTION__.' started');
        $url    = $this->url;
        $params = $this->endpoint_suffixes->fetch_static_realm;
        $query  = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_runes(string $rune_list_data = null) :stdClass {
        log_message('debug',__FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_runes;
        $query                      = $this->query;
        $query->rune_list_data      = (isset($rune_list_data))?
                                      $rune_list_data : $this->static_data_config->rune_list_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_rune_by_id(int $id, string $rune_data = null) : stdClass {
        log_message('debug',__FUNCTION__.' started');
        $url                        = $this->url;
        interlace_parameters($url,$id);
        $params                     = $this->endpoint_suffixes->fetch_static_rune_by_id;
        $query                      = $this->query;
        $query->rune_data = (isset($rune_data))? $rune_data : $this->static_data_config->rune_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_s_spells(string $spell_data = null) : stdClass {
        log_message('debug',__FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_s_spells;
        $query                      = $this->query;
        $query->spell_data      = (isset($spell_data))?
            $spell_data : $this->static_data_config->spell_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_s_spells_by_id(int $id, string $spell_data = null) : stdClass {
        log_message('debug',__FUNCTION__.' started');
        $url                        = $this->url;
        interlace_parameters($url,$id);
        $params                     = $this->endpoint_suffixes->fetch_static_s_spells_by_id;
        $query                      = $this->query;
        $query->rune_data = (isset($spell_data))? $spell_data : $this->static_data_config->spell_data;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }

    public function fetch_static_versions() : stdClass {
        log_message('debug', __FUNCTION__.' started');
        $url                        = $this->url;
        $params                     = $this->endpoint_suffixes->fetch_static_versions;
        $query                      = $this->query;
        form_url($url,$query,$params);
        return $this->CI->connector->fetch_data_from_url($url);
    }
}