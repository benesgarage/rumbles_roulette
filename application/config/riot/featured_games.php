<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/observer-mode/rest/featured';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_featured_games']            = array();

$config['fetch_featured_games']['find']    = array();
$config['fetch_featured_games']['replace'] = array();
$config['fetch_featured_games']['query']   = array('api_key');