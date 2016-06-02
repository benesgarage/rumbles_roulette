<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// RIOT API CONFIG ROUTES FOR EACH ACTION
$config['fetch_champion']                                       = 'riot/champion';
$config['fetch_champions']                                      = 'riot/champion';
$config['fetch_champion_mastery']                               = 'riot/mastery';
$config['fetch_champion_masteries']                             = 'riot/mastery';
$config['fetch_mastery_score']                                  = 'riot/mastery';
$config['fetch_top_mastery_entries']                            = 'riot/mastery';
$config['fetch_current_game_info_by_id']                        = 'riot/current_game';
$config['fetch_featured_games']                                 = 'riot/featured_games';
$config['fetch_recent_games_by_summoner_id']                    = 'riot/game';
$config['fetch_leagues_by_summoner_ids']                        = 'riot/league';
$config['fetch_league_by_summoner_ids']                         = 'riot/league';
$config['fetch_leagues_by_team_ids']                            = 'riot/league';
$config['fetch_league_by_team_ids']                             = 'riot/league';
$config['fetch_challenger_leagues']                             = 'riot/league';
$config['fetch_master_leagues']                                 = 'riot/league';
$config['fetch_static_champions']                               = 'riot/static_data';
$config['fetch_static_champion']                                = 'riot/static_data';
$config['fetch_static_items']                                   = 'riot/static_data';
$config['fetch_static_item']                                    = 'riot/static_data';
$config['fetch_static_lang_strings']                            = 'riot/static_data';
$config['fetch_static_languages']                               = 'riot/static_data';
$config['fetch_static_map']                                     = 'riot/static_data';
$config['fetch_static_masteries']                               = 'riot/static_data';
$config['fetch_static_mastery_by_id']                           = 'riot/static_data';
$config['fetch_static_realm']                                   = 'riot/static_data';
$config['fetch_static_runes']                                   = 'riot/static_data';
$config['fetch_static_rune_by_id']                              = 'riot/static_data';
$config['fetch_static_s_spells']                                = 'riot/static_data';
$config['fetch_static_s_spells_by_id']                          = 'riot/static_data';
$config['fetch_static_versions']                                = 'riot/static_data';
$config['fetch_shards']                                         = 'riot/lol_status';
$config['fetch_shards_by_region']                               = 'riot/lol_status';
$config['fetch_match_by_id']                                    = 'riot/match';
$config['fetch_matchlist_by_id']                                = 'riot/matchlist';
$config['fetch_ranked_stats_by_id']                             = 'riot/stats';
$config['fetch_stats_summary_by_id']                            = 'riot/stats';
$config['fetch_summoner_data_by_names']                         = 'riot/summoner';
$config['fetch_summoner_data_by_ids']                           = 'riot/summoner';
$config['fetch_summoner_masteries_by_ids']                      = 'riot/summoner';
$config['fetch_summoner_names_by_ids']                          = 'riot/summoner';
$config['fetch_summoner_runes_by_ids']                          = 'riot/summoner';
$config['fetch_teams_by_summoner_ids']                          = 'riot/team';
$config['fetch_teams_by_team_ids']                              = 'riot/team';

// RIOT REGION ABBREVIATION TO PLATFORM ABBREVIATION
$config['br']                                                   = 'br1';
$config['eune']                                                 = 'eun1';
$config['euw']                                                  = 'euw1';
$config['jp']                                                   = 'jp1';
$config['kr']                                                   = 'kr1';
$config['lan']                                                  = 'la1';
$config['las']                                                  = 'la2';
$config['na']                                                   = 'na1';
$config['oce']                                                  = 'oc1';
$config['ru']                                                   = 'ru';
$config['tr']                                                   = 'tr1';

//GENERAL CONFIGS
$config['game']['game_types']                                   = array('RANKED_SOLO_5x5','RANKED_TEAM_3x3',
                                                                  'RANKED_TEAM_5x5');
$config['game']['default_game_type']                            = 'RANKED_SOLO_5x5';

$config['seasons']                                              = array('SEASON3','SEASON2014','SEASON2015','SEASON2016');
$config['default_season']                                       = 'SEASON2016';

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