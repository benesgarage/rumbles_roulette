<?php defined('BASEPATH') OR exit('No direct script access allowed');
//TODO: INTRODUCE LOGIC THAT PERFORMS WHEN RESULT FROM RIOT IS ERROR
//TODO: START MIGRATING TO PHP7, TYPE HINTING ESSENTIAL FOR CODE INTEGRITY.
/**
 *
 * All functions will have the sole purpose of fetching information from the given
 * url.
 * The class itself stores info on the current inputted user.
 *
 * Class Api_requests
 */


class Search_user {

    private $region;
    private $platform_id;
    private $summoner_name;
    private $summoner_id;
    private $url_list;

    public function __construct($data) {
        /** *************************************************** **/
        /*  ********************DEBUG CODE*********************  */
        /** *************************************************** **/
        foreach($data as $key => $value) {
            $this->{$key} = $value;
        }
        /** *************************************************** **/
        /*  ****************END DEBUG CODE*********************  */
        /** *************************************************** **/
        $this->CI               =& get_instance();
        $this->CI->config->load('riot',true);
        $this->url_config       = (object) $this->CI->config->item('endpoints','riot');
        $this->platform_id      = (string) $this->CI->config->item('region_platform_equivalents', 'riot')[$this->region];
        //TODO: REPLACE HARDCODED SUFFIXES
        $this->enpoint_suffixes = (object) $this->CI->config->item('endpoint_suffixes', 'riot');
        $this->url_list = $this->set_url_list();
        $this->CI->load->helper('interlace_parameters_helper');
        /** *************************************************** **/
        /*  ********************DEBUG CODE*********************  */
        /** *************************************************** **/
        var_dump($this->url_config);
        var_dump($this->url_list);
        /** *************************************************** **/
        /*  ****************END DEBUG CODE*********************  */
        /** *************************************************** **/
    }
    



    public function set_url_list() {

        $find     = array('{region}','{summoner_id}','{platform_id}');
        $replace  = array($this->region,$this->summoner_id,$this->platform_id);
        $url_list = new stdClass();

        foreach ($this->url_config as $key => $value) {
            $url_list->{$key} = str_replace($find, $replace, $value);
        }

        return $url_list;
    }

    /**
     *
     * $url must be a string, and to pass correctly formatted $params and $query, $params must be array and
     * $query must be stdClass instance.
     *
     * @param $url
     * @param null $params
     * @param null $query
     * @return mixed
     */
    private function fetch_data($url, $params, $query) {
        $params = (is_array($params))?  $params:null;
        $query  = (is_object($query))?  $query:null;
        log_message('debug', "FETCH_DATA STARTED WITH GIVEN PARAMETERS: URL - {$url} PARAMS - " .implode($params)." QUERY - ".http_build_query($query));
        parameterise_url($url,$params);
        querialise_url($url,$query);
        return json_decode(file_get_contents($url));
    }

    //TODO: FUNCTIONS WILL CALL ONE FUNCTION THAT WILL TAKE CARE OF CREATING THE URL AND RETURNING DATA
    //TODO: MAKE IT SO THAT EACH FUNCTION RETURNS THE CORRECT DATA(PARAMS, QUERY, URL)
    /**
     *
     * Eigther fetches all champions, using free_to_play to restrict the list to only free champions,
     * or fetch data on a particular champion, using id to determine the champions ID.
     *
     * @param $id
     * @return bool|mixed
     */
    public function fetch_champion($id) {
        log_message('debug', 'FETCH_CHAMPION STARTED');
        $url = $this->url_list->champion_url;
        if(is_int($id) || is_string($id)) {
            $params = array($id);
            return $this->fetch_data($url,$params,null);
        }   
        log_message('error', 'COULD NOT FETCH CHAMPION, INCORRECT PARAMETER TYPE FOR VALUE "id": '.gettype($id));
        return false;
    }
    
    public function fetch_champions($free_to_play) {
        log_message('debug', 'FETCH_CHAMPIONS STARTED');
        $url = $this->url_list->champion_url;
        if(is_bool($free_to_play)) {
            $query             = new stdClass();
            $query->freeToPlay = $free_to_play ? 'true' : 'false';
            return $this->fetch_data($url,null,$query);
        }
        log_message('error', 'COULD NOT FETCH CHAMPIONS, INCORRECT PARAMETER TYPE FOR VALUE "free_to_play": ' . gettype($free_to_play));
        return false;
    }
    
    public function fetch_champion_mastery($champion_id) {
        log_message('debug', 'FETCH_CHAMPION_MASTERY STARTED');
        $url = $this->url_list->mastery_url;
        if (is_int($champion_id) || is_string($champion_id)) {
            $params = $this->enpoint_suffixes->fetch_champion_mastery;
            interlace_parameters($params,$champion_id);
            return $this->fetch_data($url,$params,null);
        }
        log_message('error', 'COULD NOT FETCH CHAMPION MASTERY, INCORRECT PARAMETER TYPE FOR VALUE "champion_id": '.gettype($champion_id));
        return false;
    }

    public function fetch_champion_masteries() {
        log_message('debug', 'FETCH_CHAMPION_MASTERIES STARTED');
        $url    = $this->url_list->mastery_url;
        $params = $this->enpoint_suffixes->fetch_champion_masteries;
        return $this->fetch_data($url,$params,null);
    }
    
    public function fetch_mastery_score() {
        log_message('debug', 'FETCH_MASTERY_SCORE STARTED');
        $url    = $this->url_list->mastery_url;
        $params = $this->enpoint_suffixes->fetch_mastery_score;
        return $this->fetch_data($url,$params,null);
    }

    public function fetch_top_mastery_entries($count = 3) {
        log_message('debug', 'FETCH_TOP_MASTERY_ENTRIES STARTED');
        if(is_int($count)) {
            $url    = $this->url_list->mastery_url;
            $params = $this->enpoint_suffixes->fetch_top_mastery_entries;
            $query  = array('count' => $count);
            return $this->fetch_data($url, $params, $query);
        }
        log_message('error', 'COULD NOT FETCH TOP MASTERY ENTRIES, INCORRECT PARAMETER TYPE FOR VALUE "count": '.gettype($count));
        return false;
    }

    public function fetch_current_game() {
        log_message('debug', 'FETCH_CURRENT_GAME STARTED');
        $url = $this->url_list->current_game_url;
        return $this->fetch_data($url,null,null);
    }

    public function fetch_featured_games() {
        log_message('debug', 'FETCH_FEATURED_GAME STARTED');
        $url = $this->url_list->featured_games_url;
        return $this->fetch_data($url,null,null);
    }

    public function fetch_recent_games() {
        log_message('debug', 'FETCH_RECENT_GAMES STARTED');
        $url = $this->url_list->games_url;
        return $this->fetch_data($url,null,null);
    }

    public function fetch_leagues_by_summoner_ids($summoner_id_array) {
        log_message('debug', 'FETCH_LEAGUES_BY_SUMMONER_IDS STARTED');
        if(is_array($summoner_id_array)) {
            $summoner_id_csv = implode(',',$summoner_id_array);
            $url             = $this->url_list->league_url;
            $params          = $this->enpoint_suffixes->fetch_leagues_by_summoner_ids;
            interlace_parameters($params, $summoner_id_csv);
            return $this->fetch_data($url, $params, null);
        }
        log_message('error', 'COULD NOT FETCH LEAGUES BY SUMMONER IDS, INCORRECT PARAMETER TYPE FOR VALUE "summoner_id_array": '.gettype($summoner_id_array));
        return false;
    }

    public function fetch_league_by_summoner_ids($summoner_id_array) {
        log_message('debug', 'FETCH_LEAGUE_BY_SUMMONER_IDS STARTED');
        if(is_array($summoner_id_array)){
            $summoner_id_csv = implode(',',$summoner_id_array);
            $url             = $this->url_list->league_url;
            $params          = $this->enpoint_suffixes->fetch_league_by_summoner_ids;
            interlace_parameters($params, $summoner_id_csv);
            return $this->fetch_data($url, $params, null);
        }
        log_message('error', 'COULD NOT FETCH LEAGUE BY SUMMONER IDS, INCORRECT PARAMETER TYPE FOR VALUE "summoner_id_array": '.gettype($summoner_id_array));
        return false;
    }

    public function fetch_leagues_by_team_ids($team_id_array) {
        log_message('debug', 'FETCH_LEAGUES_BY_TEAM_IDS STARTED');
        if(is_array($team_id_array)) {
            $team_id_csv = implode(',',$team_id_array);
            $url         = $this->url_list->league_url;
            $params      = $this->enpoint_suffixes->fetch_leagues_by_team_ids;
            interlace_parameters($params, $team_id_csv);
            return $this->fetch_data($url, $params, null);
        }
        log_message('error', 'COULD NOT FETCH LEAGUES BY TEAM IDS, INCORRECT PARAMETER TYPE FOR VALUE "team_id_array": '.gettype($team_id_array));
    }

    public function fetch_league_by_team_ids($team_id_array) {
        log_message('debug', 'FETCH_LEAGUE_BY_TEAM_IDS STARTED');
        if(is_array($team_id_array)) {
            $team_id_csv = implode(',',$team_id_array);
            $url         = $this->url_list->league_url;
            $params      = $this->enpoint_suffixes->fetch_league_by_team_ids;
            interlace_parameters($params, $team_id_csv);
            return $this->fetch_data($url, $params, null);
        }
        log_message('error', 'COULD NOT FETCH LEAGUE BY TEAM IDS, INCORRECT PARAMER TYPE FOR VALUE "team_id_array": '.gettype($team_id_array));
    }

    public function fetch_challenger_leagues($game_type) {
        log_message('debug', 'FETCH_CHALLENGER_LEAGUES STARTED');
        if(is_string($game_type)) {
            $game_types = $this->CI->config->item('game_types', 'riot');
            if (in_array($game_type, $game_types)) {
                $url         = $this->url_list->league_url;
                $query       = new stdClass();
                $query->type = $game_type;
                $params      = $this->enpoint_suffixes->fetch_challenger_leagues;
                return $this->fetch_data($url, $params, $query);
            }
            log_message('error', 'COULD NOT FETCH CHALLENGER LEAGUES, INCORRECT VALUE FOR "game_type": '.$game_type.' ACCEPTED VALUES: '.implode(',',$game_types));
        }
        log_message('error', 'COULD NOT FETCH CHALLENGER LEAGUES, INCORRECT PARAMETER TYPE FOR VALUE "game_types": '.gettype($game_type));
        return false;
    }

    public function fetch_master_leagues($game_type) {
        log_message('debug', 'FETCH_MASTER_LEAGUES STARTED');
        if(is_string($game_type)) {
            $game_types = $this->CI->config->item('game_types', 'riot');
            if (in_array($game_type, $game_types)) {
                $url         = $this->url_list->league_url;
                $query       = new stdClass();
                $query->type = $game_type;
                $params      = $this->enpoint_suffixes->fetch_challenger_leagues;
                return $this->fetch_data($url, $params, $query);
            }
            log_message('error', 'COULD NOT FETCH MASTER LEAGUES, INCORRECT VALUE FOR "game_type": '.$game_type.' ACCEPTED VALUES: '.implode(',',$game_types));
        }
        log_message('error', 'COULD NOT FETCH MASTER LEAGUES, INCORRECT PARAMETER TYPE FOR VALUE "game_types": '.gettype($game_type));
        return false;
    }

//TODO: WAIT FOR PHP7 FROM HERE ON--------------------------------------------------------------------------------------

    public function fetch_static_champions($data = array()) {
        //TODO: CHECK PARAMS SENT.
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/champion?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_static_champion($id, $data = array()) {
        //TODO: CHECK PARAMS SENT.
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/champion/{$id}?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_static_items($data = array()) {
        //TODO: CHECK PARAMS SENT.
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/item?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }
    public function fetch_static_item($id, $data = array()) {
        //TODO: CHECK PARAMS SENT.
        $data['api_key'] = API_KEY;
        $url             = "{$this->url_list->static_data_url}/item/{$id}?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }
}