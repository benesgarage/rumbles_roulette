<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//THIS ENDPOINT DOES NOT COUNT TOWARD API KEY LIMIT
$config['endpoint'] = 'https://global.api.pvp.net/api/lol/static-data/{region}/v1.2';

$config['endpoint']['find']    = array('{region}');
$config['endpoint']['replace'] = array('region');

//URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['fetch_static_champions']            = array('champion');

$config['fetch_static_champions']['find']    = array();
$config['fetch_static_champions']['replace'] = array();
$config['fetch_static_champions']['query']   = array('api_key','locale','version','dataById','champData');

$config['fetch_static_champion']            = array('champion','{champion_id}');

$config['fetch_static_champion']['find']    = array('{champion_id}');
$config['fetch_static_champion']['replace'] = array('champion_id');
$config['fetch_static_champion']['query']   = array('api_key','locale','version','champData');

$config['fetch_static_items']            = array('item');

$config['fetch_static_items']['find']    = array();
$config['fetch_static_items']['replace'] = array();
$config['fetch_static_items']['query']   = array('api_key','locale','version','itemListData');

$config['fetch_static_item']            = array('item','{item_id}');

$config['fetch_static_item']['find']    = array('{item_id}');
$config['fetch_static_item']['replace'] = array('item_id');
$config['fetch_static_item']['query']   = array('api_key','locale','version','itemData');

$config['fetch_static_lang_strings']            = array('language-strings');

$config['fetch_static_lang_strings']['find']    = array();
$config['fetch_static_lang_strings']['replace'] = array();
$config['fetch_static_lang_strings']['query']   = array('api_key','locale','version');

$config['fetch_static_languages']            = array('languages');

$config['fetch_static_languages']['find']    = array();
$config['fetch_static_languages']['replace'] = array();
$config['fetch_static_languages']['query']   = array('api_key');

$config['fetch_static_map']            = array('map');

$config['fetch_static_map']['find']    = array();
$config['fetch_static_map']['replace'] = array();
$config['fetch_static_map']['query']   = array('api_key','locale','version');

$config['fetch_static_masteries']            = array('mastery');

$config['fetch_static_masteries']['find']    = array();
$config['fetch_static_masteries']['replace'] = array();
$config['fetch_static_masteries']['query']   = array('api_key','locale','version','masteryListData');

$config['fetch_static_mastery_by_id']            = array('mastery','{mastery_id}');

$config['fetch_static_mastery_by_id']['find']    = array('{mastery_id}');
$config['fetch_static_mastery_by_id']['replace'] = array('mastery_id');
$config['fetch_static_mastery_by_id']['query']   = array('api_key','locale','version','masteryData');

$config['fetch_static_realm']            = array('realm');

$config['fetch_static_realm']['find']    = array();
$config['fetch_static_realm']['replace'] = array();
$config['fetch_static_realm']['query']   = array('api_key');

$config['fetch_static_runes']            = array('rune');

$config['fetch_static_runes']['find']    = array();
$config['fetch_static_runes']['replace'] = array();
$config['fetch_static_runes']['query']   = array('api_key','locale','version','runeListData');

$config['fetch_static_rune_by_id']            = array('rune','{rune_id}');

$config['fetch_static_rune_by_id']['find']    = array('{rune_id}');
$config['fetch_static_rune_by_id']['replace'] = array('rune_id');
$config['fetch_static_rune_by_id']['query']   = array('api_key','locale','version','runeData');

$config['fetch_static_summoner_spells']            = array('summoner-spell');

$config['fetch_static_summoner_spells']['find']    = array();
$config['fetch_static_summoner_spells']['replace'] = array();
$config['fetch_static_summoner_spells']['query']   = array('api_key','locale','version','dataById','spellData');

$config['fetch_static_summoner_spells_by_id']            = array('summoner-spell','{summoner_spell_id}');

$config['fetch_static_summoner_spells_by_id']['find']    = array('{summoner_spell_id}');
$config['fetch_static_summoner_spells_by_id']['replace'] = array('summoner_spell_id');
$config['fetch_static_summoner_spells_by_id']['query']   = array('api_key','locale','version','spellData');

$config['fetch_static_versions']            = array('versions');

$config['fetch_static_versions']['find']    = array();
$config['fetch_static_versions']['replace'] = array();
$config['fetch_static_versions']['query']   = array('api_key');