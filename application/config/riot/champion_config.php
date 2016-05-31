<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion';

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['endpoint_suffixes']['fetch_champion']          = array();
$config['endpoint_suffixes']['fetch_champions']         = array('{id}');