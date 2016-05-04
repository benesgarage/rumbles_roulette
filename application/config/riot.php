<?php
// RIOT URL ENDPOINTS
$config['endpoints']['champion_url']                           = 'https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion';
$config['endpoints']['mastery_url']                            = 'https://{region}.api.pvp.net/championmastery/location/{platform_id}/player/{summoner_id}';
$config['endpoints']['current_game_url']                       = 'https://{region}.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/{platform_id}/{summoner_id}';
$config['endpoints']['featured_games_url']                     = 'https://{region}.api.pvp.net/observer-mode/rest/featured';
$config['endpoints']['games_url']                              = 'https://{region}.api.pvp.net/api/lol/{region}/v1.3/game/by-summoner/{summoner_id}/recent';
$config['endpoints']['league_url']                             = 'https://{region}.api.pvp.net/api/lol/{region}/v2.5/league';
$config['endpoints']['static_data_url']                        = 'https://global.api.pvp.net/api/lol/static-data/{region}/v1.2';

// RIOT REGION ABBREVIATION TO PLATFORM ABBREVIATION
$config['region_platform_equivalents']['br']                    = 'br1';
$config['region_platform_equivalents']['eune']                  = 'eun1';
$config['region_platform_equivalents']['euw']                   = 'euw1';
$config['region_platform_equivalents']['jp']                    = 'jp1';
$config['region_platform_equivalents']['kr']                    = 'kr1';
$config['region_platform_equivalents']['lan']                   = 'la1';
$config['region_platform_equivalents']['las']                   = 'la2';
$config['region_platform_equivalents']['na']                    = 'na1';
$config['region_platform_equivalents']['oce']                   = 'oc1';
$config['region_platform_equivalents']['ru']                    = 'ru';
$config['region_platform_equivalents']['tr']                    = 'tr1';

$config['endpoint_suffixes']['fetch_champion_mastery']          = 'champion';
$config['endpoint_suffixes']['fetch_champion_masteries']        = 'champions';
$config['endpoint_suffixes']['fetch_mastery_score']             = 'score';
$config['endpoint_suffixes']['fetch_top_mastery_entries']       = 'topchampions';
$config['endpoint_suffixes']['fetch_leagues_by_summoner_ids']   = 'by-summoner';
$config['endpoint_suffixes']['fetch_league_by_summoner_ids']    = 'by-summoner,entry';