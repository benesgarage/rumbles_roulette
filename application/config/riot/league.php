<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/api/lol/{region}/v2.5/league';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_leagues_by_summoner_ids']            = array('by-summoner','{summoner_ids}');

$config['fetch_leagues_by_summoner_ids']['find']    = array('{summoner_ids}');
$config['fetch_leagues_by_summoner_ids']['replace'] = array('summoner_ids');
$config['fetch_leagues_by_summoner_ids']['query']   = array('api_key');

$config['fetch_league_by_summoner_ids']            = array('by-summoner','{summoner_ids}','entry');

$config['fetch_league_by_summoner_ids']['find']    = array('{summoner_ids}');
$config['fetch_league_by_summoner_ids']['replace'] = array('summoner_ids');
$config['fetch_league_by_summoner_ids']['query']   = array('api_key');

$config['fetch_leagues_by_team_ids']            = array('by-team','{team_ids}');

$config['fetch_leagues_by_team_ids']['find']    = array('{team_ids}');
$config['fetch_leagues_by_team_ids']['replace'] = array('team_ids');
$config['fetch_leagues_by_team_ids']['query']   = array('api_key');

$config['fetch_league_by_team_ids']            = array('by-team','{team_ids}','entry');

$config['fetch_league_by_team_ids']['find']    = array('{team_ids}');
$config['fetch_league_by_team_ids']['replace'] = array('team_ids');
$config['fetch_league_by_team_ids']['query']   = array('api_key');

$config['fetch_challenger_leagues']            = array('challenger');

$config['fetch_challenger_leagues']['find']    = array();
$config['fetch_challenger_leagues']['replace'] = array();
$config['fetch_challenger_leagues']['query']   = array('type','api_key');

$config['fetch_master_leagues']            = array('master');

$config['fetch_master_leagues']['find']    = array();
$config['fetch_master_leagues']['replace'] = array();
$config['fetch_master_leagues']['query']   = array('type','api_key');