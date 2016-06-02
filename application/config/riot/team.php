<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint']         = 'https://{region}.api.pvp.net/api/lol/{region}/v2.4/team';

$config['endpoint_find']    = array('{region}');
$config['endpoint_replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_teams_by_summoner_ids']            = array('by-summoner','{summoner_ids}');

$config['fetch_teams_by_summoner_ids']['find']    = array('{summoner_ids}');
$config['fetch_teams_by_summoner_ids']['replace'] = array('summoner_ids');
$config['fetch_teams_by_summoner_ids']['query']   = array('api_key');

$config['fetch_teams_by_team_ids']            = array('{team_ids}');

$config['fetch_teams_by_team_ids']['find']    = array('{team_ids}');
$config['fetch_teams_by_team_ids']['replace'] = array('team_ids');
$config['fetch_teams_by_team_ids']['query']   = array('api_key');