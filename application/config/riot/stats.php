<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/api/lol/euw/v1.3/stats';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_ranked_stats_by_id']             = array('by-summoner','{summoner_id}','ranked');

$config['fetch_ranked_stats_by_id']['find']     = array('{summoner_id}');
$config['fetch_ranked_stats_by_id']['replace']  = array('summoner_id');
$config['fetch_ranked_stats_by_id']['query']    = array();

$config['fetch_stats_summary_by_id']            = array('by-summoner','{summoner_id}','summary');

$config['fetch_stats_summary_by_id']['find']    = array('{summoner_id}');
$config['fetch_stats_summary_by_id']['replace'] = array('summoner_id');
$config['fetch_stats_summary_by_id']['query']   = array();