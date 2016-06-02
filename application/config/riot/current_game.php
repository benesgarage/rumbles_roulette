<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/observer-mode/rest/consumer';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_current_game_info_by_id'] = array('getSpectatorGameInfo','{platform_id}','{summoner_id}');

$config['fetch_current_game_info_by_id']['find']    = array('{platform_id}','{summoner_id}');
$config['fetch_current_game_info_by_id']['replace'] = array('platform_id','summoner_id');
$config['fetch_current_game_info_by_id']['query']   = array('api_key');