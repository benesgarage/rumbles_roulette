<?php
// RIOT URL ENDPOINTS
//TODO: REALISED ENDPOINTS ARE TOO INCONSISTENT TO HANDLE AS ONE, WE NEED HANDLERS FOR EACH API
$config['endpoints']['champion_url']                            = 'https://{region}.api.pvp.net/api/lol/{region}/v1.2/champion';
$config['endpoints']['mastery_url']                             = 'https://{region}.api.pvp.net/championmastery/location/{platform_id}/player/{summoner_id}';
$config['endpoints']['current_game_url']                        = 'https://{region}.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/{platform_id}/{summoner_id}';
$config['endpoints']['featured_games_url']                      = 'https://{region}.api.pvp.net/observer-mode/rest/featured';
$config['endpoints']['game_url']                                = 'https://{region}.api.pvp.net/api/lol/{region}/v1.3/game/by-summoner/{summoner_id}/recent';
$config['endpoints']['league_url']                              = 'https://{region}.api.pvp.net/api/lol/{region}/v2.5/league';
$config['endpoints']['static_data_url']                         = 'https://global.api.pvp.net/api/lol/static-data/{region}/v1.2';
$config['endpoints']['status_url']                              = 'http://status.leagueoflegends.com/';
$config['endpoints']['match_url']                               = 'https://{region}.api.pvp.net/api/lol/{region}/v2.2';

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
$config['endpoint_suffixes']['fetch_static_champion']           = array('champion');
$config['endpoint_suffixes']['fetch_static_items']              = array('item');
$config['endpoint_suffixes']['fetch_static_item']               = array('item');
$config['endpoint_suffixes']['fetch_static_lang_strings']       = array('language-strings');
$config['endpoint_suffixes']['fetch_static_languages']          = array('languages');
$config['endpoint_suffixes']['fetch_static_map']                = array('map');
$config['endpoint_suffixes']['fetch_static_masteries']          = array('mastery');
$config['endpoint_suffixes']['fetch_static_mastery_by_id']      = array('mastery');
$config['endpoint_suffixes']['fetch_static_realm']              = array('realm');
$config['endpoint_suffixes']['fetch_static_runes']              = array('rune');
$config['endpoint_suffixes']['fetch_static_rune_by_id']         = array('rune');
$config['endpoint_suffixes']['fetch_static_s_spells']           = array('summoner-spell');
$config['endpoint_suffixes']['fetch_static_s_spells_by_id']     = array('summoner-spell');
$config['endpoint_suffixes']['fetch_static_versions']           = array('versions');
$config['endpoint_suffixes']['fetch_shards']                    = array('shards');
$config['endpoint_suffixes']['fetch_shard_by_region']           = array('shards');
$config['endpoint_suffixes']['fetch_match_by_id']               = array('match');

$config['game']['game_types']                                   = array('RANKED_SOLO_5x5','RANKED_TEAM_3x3',
                                                                  'RANKED_TEAM_5x5');
$config['game']['default_game_type']                            = 'RANKED_SOLO_5x5';

$config['api_key']                                              = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$config['static_data']['data_dragon_version']                   = '';
$config['static_data']['locale']                                = 'en_US';
$config['static_data']['champ_data_values']                     = array('all','allytips','altimages','blurb',
                                                                  'enempytips','image','info', 'lore', 'partype',
                                                                  'passive', 'recommended', 'skins', 'spells', 'stats',
                                                                  'tags');
$config['static_data']['champ_data']                            = 'all';
$config['static_data']['item_list_data_values']                 = array('all','colloq','consumeOnFull','consumed',
                                                                  'depth','effect','from', 'gold', 'groups',
                                                                  'hideFromAll', 'image', 'inStore', 'into', 'maps',
                                                                  'requiredChampion', 'sanitizedDescription',
                                                                  'specialRecipe','stacks','stats','tags', 'tree');
$config['static_data']['item_list_data']                        = 'all';
$config['static_data']['mastery_list_data_values']              = array('all','image','masteryTree','prereq',
                                                                  'ranks','sanitizedDescription','tree');
$config['static_data']['mastery_list_data']                     = 'all';
$config['static_data']['rune_list_data_values']                 = array('all','basic','colloq','consumeOnFull',
                                                                  'consumed','depth','from','gold','hideFromAll',
                                                                  'image','inStore','into','maps','requiredChampion',
                                                                  'sanitizedChampion','specialRecipe','stacks','stats',
                                                                  'tags');
$config['static_data']['rune_list_data']                        = 'all';
$config['static_data']['rune_data_values']                      = array('all','colloq','consumeOnFull',
                                                                  'consumed','depth','from','gold','hideFromAll',
                                                                  'image','inStore','into','maps','requiredChampion',
                                                                  'sanitizedChampion','specialRecipe','stacks','stats',
                                                                  'tags');
$config['static_data']['rune_data']                             = array('all');
$config['static_data']['spell_data_values']                     = array('all','cooldown','cooldownBurn','cost',
                                                                  'costBurn','costType','effect','effectBurn',
                                                                  'image','key','leveltip','maxrank','modes',
                                                                  'range','rangeBurn','resource','sanitizedDescription',
                                                                  'sanitizedTooltip','tooltip','vars');
$config['static_data']['spell_data']                            = array('all');
$config['static_data']['data_by_id']                            = false;
$config['static_data']['include_timeline']                      = true;