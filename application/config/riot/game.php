<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/api/lol/{region}/v1.3/game/by-summoner/{summoner_id}/recent';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_recent_games_by_summoner_id']            = array('by-summoner','{summoner_id}','recent');

$config['fetch_recent_games_by_summoner_id']['find']    = array('{summoner_id}');
$config['fetch_recent_games_by_summoner_id']['replace'] = array('summoner_id');
$config['fetch_recent_games_by_summoner_id']['query']   = array('api_key');