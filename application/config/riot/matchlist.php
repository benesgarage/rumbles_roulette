<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint']         = 'https://{region}.api.pvp.net/api/lol/{region}/v2.2/matchlist';

$config['endpoint_find']    = array('{region}');
$config['endpoint_replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_matchlist_by_id']            = array('by-summoner','{summoner_id}');

$config['fetch_matchlist_by_id']['find']    = array('{summoner_id}');
$config['fetch_matchlist_by_id']['replace'] = array('summoner_id');
$config['fetch_matchlist_by_id']['query']   = array('api_key','championIds','rankedQueues','seasons','beginTime','endTime','beginIndex','endIndex');