<?php

/**
 *
 * All functions will have the sole purpose of fetching information from the given
 * url.
 * The class itself stores info on the current inputted user.
 *
 * Class Api_requests
 */

class Current_user {

    private $region;
    private $platform_id;
    private $summoner_name;
    private $summoner_id;
    private $champion_url;
    private $mastery_url;
    private $current_game_url;
    private $featured_games_url;
    private $games_url;
    private $league_url;

    public function __construct($data) {
        $this->region = $data['region'];
        $this->platform_id = REGION_PLATFORM_EQUIVALENTS[$this->region];
        $this->summoner_name = $data['summoner_name'];
        $this->summoner_id = $data['summoner_id'];
    }

    public function set_champion_url() {
        $this->champion_url = str_replace('{region}',$this->region,CHAMPION_URL_SKELETON);
    }
    
    public function set_mastery_url() {
        $find    = array(
            '{region}',
            '{platform_id}',
            '{summoner_id}'
        );
        $replace = array(
            $this->region,
            $this->platform_id,
            $this->summoner_id
        );
        $this->mastery_url = str_replace($find,$replace, MASTERY_URL_SKELETON);
    }

    public function set_current_game_url() {
        $find    = array(
            '{region}',
            '{platform_id}',
            '{summoner_id}'
        );
        $replace = array(
            $this->region,
            $this->platform_id,
            $this->summoner_id
        );
        $this->current_game_url = str_replace($find,$replace, CURRENT_GAME_URL_SKELETON);
    }

    public function set_featured_games_url() {
        $this->featured_games_url = str_replace('{region}',$this->region, FEATURED_GAMES_URL_SKELETON);
    }

    public function set_games_url() {
        $find    = array(
            '{region}',
            '{summoner_id}'
        );
        $replace = array(
            $this->region,
            $this->summoner_id
        );
        $this->games_url = str_replace($find,$replace,GAME_URL_SKELETON);
    }

    public function set_league_url() {
        $this->featured_games_url = str_replace('{region}',$this->region, LEAGUE_URL_SKELETON);
    }
    

    public function fetch_champions($free_to_play = FALSE) {
        $data = array(
            'freeToPlay' => ($free_to_play) ? 'true' : 'false',
            'api_key'    => API_KEY
        );
        $url ="{$this->champion_url}?".http_build_query($data);
        return json_decode(file_get_contents($url), true);
    }

    public function fetch_champion($id) {
        $url = "{$this->champion_url}/{$id}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }
    
    public function fetch_champion_mastery_entry($champion_id) {
        $url = "{$this->mastery_url}/champion/{$champion_id}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_champion_mastery_entries() {
        $url = "{$this->mastery_url}/champions?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }
    
    public function fetch_mastery_score() {
        $url = "{$this->mastery_url}/score?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_top_mastery_entries($count = 3) {
        $data = array(
            'count'   => $count,
            'api_key' => API_KEY
        );
        $url  = "{$this->mastery_url}/topchampions?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_current_game() {
        $url = "{$this->current_game_url}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_featured_games() {
        $url = "{$this->featured_games_url}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_recent_games() {
        $url = "{$this->games_url}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_leagues_by_summoner_ids($summoner_id_list) {
        
    }

    
}