<?php

Class Home_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_all_champions($free_to_play = FALSE) {
        if($free_to_play) {
        }
    }

    public function get_summoner_data()
    {
        $summoner_data = json_decode(file_get_contents("https://euw.api.pvp.net/api/lol/euw/v1.4/summoner/by-name/"
            .$_GET['summoner']."?api_key=".api_key),TRUE);
        return $summoner_data[$_GET['summoner']];
    }

    public function get_summoner_league_data($id)
    {
        $league_data = json_decode(file_get_contents("https://euw.api.pvp.net/api/lol/euw/v2.5/league/by-summoner/"
            .$id."/entry?api_key=".api_key),TRUE);
        return $league_data[$id][0];
    }

    public function get_summoner_current_ranked_champions($id)
    {
        $ranked_champions = json_decode(file_get_contents("https://euw.api.pvp.net/api/lol/euw/v1.3/stats/by-summoner/"
            .$id."/ranked?season=SEASON".date("Y")."&api_key=".api_key),TRUE);
        return $ranked_champions['champions'];
    }

}