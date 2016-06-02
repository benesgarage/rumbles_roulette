<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/championmastery';

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_champion_mastery']               = array('location','{platform_id}','player','{summoner_id}','champion','{champion_id}');

$config['fetch_champion_mastery']['find']       = array('{platform_id}','{summoner_id}','{champion_id}');
$config['fetch_champion_mastery']['replace']    = array('platform_id','summoner_id','champion_id');
$config['fetch_champion_mastery']['query']      = array('api_key');

$config['fetch_champion_masteries']             = array('location','{platform_id}','player','{summoner_id}','champions');

$config['fetch_champion_masteries']['find']     = array('{platform_id}','{summoner_id}');
$config['fetch_champion_masteries']['replace']  = array('platform_id','summoner_id');
$config['fetch_champion_masteries']['query']    = array('api_key');

$config['fetch_mastery_score']                  = array('location','{platform_id}','player','{summoner_id}','score');

$config['fetch_mastery_score']['find']          = array('{platform_id}','{summoner_id}');
$config['fetch_mastery_score']['replace']       = array('platform_id','summoner_id');
$config['fetch_mastery_score']['query']         = array('api_key');

$config['fetch_top_mastery_entries']            = array('location','{platform_id}','player','{summoner_id}','topchampions');

$config['fetch_top_mastery_entries']['find']    = array('{platform_id}','{summoner_id}');
$config['fetch_top_mastery_entries']['replace'] = array('platform_id','summoner_id');
$config['fetch_top_mastery_entries']['query']   = array('api_key','count');