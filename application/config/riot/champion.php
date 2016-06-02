<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion';

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_champion']             = array('{champion_id}');

$config['fetch_champion']['find']     = array('{champion_id}');
$config['fetch_champion']['replace']  = array('champion_id');
$config['fetch_champion']['query']    = array('api_key');

$config['fetch_champions']            = array();

$config['fetch_champions']['find']    = array();
$config['fetch_champions']['replace'] = array();
$config['fetch_champions']['query']   = array('api_key','freeToPlay');