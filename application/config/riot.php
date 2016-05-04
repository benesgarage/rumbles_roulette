<?php
// RIOT URL ENDPOINTS
$config['endpoints']['champion_url']                            = 'https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion';
$config['endpoints']['mastery_url']                             = 'https://{region}.api.pvp.net/championmastery/location/{platform_id}/player/{summoner_id}';
$config['endpoints']['current_game_url']                        = 'https://{region}.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/{platform_id}/{summoner_id}';
$config['endpoints']['featured_games_url']                      = 'https://{region}.api.pvp.net/observer-mode/rest/featured';
$config['endpoints']['games_url']                               = 'https://{region}.api.pvp.net/api/lol/{region}/v1.3/game/by-summoner/{summoner_id}/recent';
$config['endpoints']['league_url']                              = 'https://{region}.api.pvp.net/api/lol/{region}/v2.5/league';
$config['endpoints']['static_data_url']                         = 'https://global.api.pvp.net/api/lol/static-data/{region}/v1.2';

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

// RIOT URL ENDPOINT SUFFIXES, URL PARAMETERS
$config['endpoint_suffixes']['fetch_champion_mastery']          = array('champion');
$config['endpoint_suffixes']['fetch_champion_masteries']        = array('champions');
$config['endpoint_suffixes']['fetch_mastery_score']             = array('score');
$config['endpoint_suffixes']['fetch_top_mastery_entries']       = array('topchampions');
$config['endpoint_suffixes']['fetch_leagues_by_summoner_ids']   = array('by-summoner');
$config['endpoint_suffixes']['fetch_league_by_summoner_ids']    = array('by-summoner','entry');
$config['endpoint_suffixes']['fetch_leagues_by_team_ids']       = array('by-team');
$config['endpoint_suffixes']['fetch_league_by_team_ids']        = array('by-team', 'entry');

// OPERATIONS AND THEIR RELATED CONFIG ELEMENTS
$config['fetch_champion']['endpoint']                           =& $config['endpoints']['champion_url'];
$config['fetch_champion']['endpoint_suffixes']                  =& null;
$config['fetch_champions']['endpoint']                          =& $config['endpoints']['champion_url'];
$config['fetch_champions']['endpoint_suffixes']                 =& null;
$config['fetch_champion_mastery']['endpoint']                   =& $config['endpoints']['mastery_url'];
$config['fetch_champion_mastery']['endpoint_suffixes']          =& $config['endpoint_suffixes']['fetch_champion_mastery'];
$config['fetch_champion_masteries']['endpoint']                 =& $config['endpoints']['champion_url'];
$config['fetch_champion']['endpoint_suffixes']                  =& null;
