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
$config['endpoint_suffixes']['fetch_challenger_leagues']        = array('challenger');
$config['endpoint_suffixes']['fetch_master_leagues']            = array('master');
$config['endpoint_suffixes']['fetch_static_champions']          = array('champion');

$config['game_types']                                           = array('RANKED_SOLO_5x5','RANKED_TEAM_3x3',
                                                                  'RANKED_TEAM_5x5');
$config['default_game_type']                                    = 'RANKED_SOLO_5x5';

$config['api_key']                                              = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$config['static_data']['data_dragon_version']                   = '';
$config['static_data']['locale']                                = 'en_US';
$config['static_data']['champ_data_values']                     = array('all','allytips','altimages','blurb',
                                                                  'enempytips','image','info', 'lore', 'partype',
                                                                  'passive', 'recommended', 'skins', 'spells', 'stats',
                                                                  'tags');
$config['static_data']['champ_data']                            = 'all';
$config['static_data']['data_by_id']                            = false;