<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint']         = 'https://{region}.api.pvp.net/api/lol/euw/v1.4/summoner';

$config['endpoint_find']    = array('{region}');
$config['endpoint_replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_summoner_data_by_names']            = array('by-name','{summmoner_names}');

$config['fetch_summoner_data_by_names_find']       = array('{summmoner_names}');
$config['fetch_summoner_data_by_names_replace']    = array('summmoner_names');

$config['fetch_summoner_data_by_ids']              = array('{summoner_ids}');

$config['fetch_summoner_data_by_ids_find']         = array('{summoner_ids}');
$config['fetch_summoner_data_by_ids_replace']      = array('summoner_ids');

$config['fetch_summoner_masteries_by_ids']         = array('{summoner_ids}','masteries');

$config['fetch_summoner_masteries_by_ids_find']    = array('{summoner_ids}');
$config['fetch_summoner_masteries_by_ids_replace'] = array('summoner_ids');

$config['fetch_summoner_names_by_ids']             = array('{summoner_ids}','name');

$config['fetch_summoner_names_by_ids_find']        = array('{summoner_ids}');
$config['fetch_summoner_names_by_ids_replace']     = array('summoner_ids');

$config['fetch_summoner_runes_by_ids']             = array('{summoner_ids}','runes');

$config['fetch_summoner_runes_by_ids_find']        = array('{summoner_ids}');
$config['fetch_summoner_runes_by_ids_replace']     = array('summoner_ids');