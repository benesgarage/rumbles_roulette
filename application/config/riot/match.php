<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/api/lol/{region}/v2.2';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_match_by_id']            = array('match','{match_id}');

$config['fetch_match_by_id']['find']    = array('{match_id}');
$config['fetch_match_by_id']['replace'] = array('match_id');
$config['fetch_match_by_id']['query']   = array('api_key','includeTimeline');