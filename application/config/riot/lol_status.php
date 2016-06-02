<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['endpoint'] = 'http://status.leagueoflegends.com/';

$config['endpoint']['find']    = array();
$config['endpoint']['replace'] = array();

//URL ENDPOINT SUFFIXES, URL PARAMETERS

$config['fetch_shards']            = array('shards');

$config['fetch_shards']['find']    = array();
$config['fetch_shards']['replace'] = array();
$config['fetch_shards']['query']   = array();

$config['fetch_shard_by_region'] = array('shards','{region}');

$config['fetch_shard_by_region']['find'] = array('{region}');
$config['fetch_shard_by_region']['replace'] = array('region');
$config['fetch_shard_by_region']['query'] = array();