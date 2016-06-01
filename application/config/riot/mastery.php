<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/championmastery';

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['endpoint_suffixes']['fetch_champion_mastery']    = array('location','{platform_id}','player','{summoner_id}','champion');
$config['endpoint_suffixes']['fetch_champion_masteries']  = array('location','{platform_id}','player','{summoner_id}','champions');
$config['endpoint_suffixes']['fetch_mastery_score']       = array('location','{platform_id}','player','{summoner_id}','score');
$config['endpoint_suffixes']['fetch_top_mastery_entries'] = array('location','{platform_id}','player','{summoner_id}','topchampions');