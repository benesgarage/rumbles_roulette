<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
        $this->CI =& get_instance();
        $this->CI->config->load('riot', true);
        $this->url_config = (object) $this->CI->config->item('endpoints','riot');
        $this->platform_id = (string) $this->CI->config->item('region_platform_equivalents', 'riot')[$this->region];
        $this->url_list = $this->set_url_list();
        /** *************************************************** **/
        /*  ********************DEBUG CODE*********************  */
        /** *************************************************** **/
        //var_dump($this->url_config);
        //var_dump($this->url_list);
        /** *************************************************** **/
        /*  ****************END DEBUG CODE*********************  */
        /** *************************************************** **/
    }

    private function querialise_url($url, $data = array()) {
        //TODO: IMPLEMENT THIS FUNCTION WITHIN OTHER FUNCTIONS, LOOK AT PASS-BY-REFERENCE
        if(is_array($data)){
            $data['api_key'] = API_KEY;
            $url .= '?'.http_build_query($data);
            return $url;
        }
        log_message('error', 'UNABLE TO QUERIALISE URL, PARAMETERS WERE NOT SENT AS ARRAY, RECIEVED '.gettype($data));
        return false;
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
     * Eigther fetches all champions, using free_to_play to restrict the list to only free champions,
     * or fetch data on a particular champion, using id to determine the champions ID.
     *
     * @param $data $data can take two key-value pairs:
     * free_to_play => bool
     * id => str/int
     * @return bool|mixed
     */
    public function fetch_champions($data) {
        log_message('debug', 'FETCH_CHAMPIONS STARTED');
        $url = "{$this->url_list->champion_url}";
        if(isset($data['id'])) {
            log_message('debug', 'FETCHING CHAMPION BY ID');
            $id  = $data['id'];
            if(is_int($id) || is_string($id)) {
                $url .= "/{$id}";
                $url = $this->querialise_url($url);
                return json_decode(file_get_contents($url));
            }
            log_message('error', 'COULD NOT FETCH CHAMPION, INCORRECT PARAMETER TYPE FOR VALUE "id": '.gettype($id));
        } elseif (isset($data['free_to_play'])) {
            log_message('debug', 'FETCHING CHAMPIONS');
            $free_to_play = $data['free_to_play'];
            if (is_bool($free_to_play)) {
                $data = array('freeToPlay' => ($free_to_play ? 'true' : 'false'), 'api_key' => API_KEY);
                $url .= "?" . http_build_query($data);
                return json_decode(file_get_contents($url));
            }
            log_message('error', 'COULD NOT FETCH CHAMPIONS, INCORRECT PARAMETER TYPE FOR VALUE "free_to_play": ' . gettype($free_to_play));
        } else {
            log_message('error', 'COULD NOT FETCH CHAMPIONS, INCORRECT PARAMETERS GIVEN '.json_encode($data));
        }
        return false;
    }
    
    public function fetch_champion_mastery($champion_id = null) {
        log_message('debug', 'FETCH_CHAMPION_MASTERY STARTED');
        $url = "{$this->url_list->mastery_url}";
        if ($champion_id !== null) {
            log_message('debug', 'FETCHING CHAMPION MASTERY BY CHAMPION ID');
            if (is_int($champion_id) || is_string($champion_id)) {
                $url .= "/champion/{$champion_id}?api_key=".API_KEY;
                return json_decode(file_get_contents($url));
            }
            log_message('error', 'COULD NOT FETCH CHAMPION MASTERY, INCORRECT PARAMETER TYPE FOR VALUE "champion_id": '.gettype($champion_id));
        }else {
            $url .= "/champions?api_key=".API_KEY;
            return json_decode(file_get_contents($url));
        }
        return false;
    }
    
    public function fetch_mastery_score() {
        log_message('debug', 'FETCH_MASTERY_SCORE STARTED');
        $url = "{$this->url_list->mastery_url}/score?api_key=".API_KEY;
        return json_decode(file_get_contents($url));
    }

    public function fetch_top_mastery_entries($count = 3) {
        $data = array(
            'count'   => $count,
            'api_key' => API_KEY
        );
        $url  = "{$this->url_list->mastery_url}/topchampions?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_current_game() {
        $url = "{$this->url_list->current_game_url}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_featured_games() {
        $url = "{$this->url_list->featured_games_url}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_recent_games() {
        $url = "{$this->url_list->games_url}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_leagues_by_summoner_ids($summoner_id_csv) {
        $url = "{$this->url_list->league_url}/by-summoner/{$summoner_id_csv}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_league_by_summoner_ids($summoner_id_csv) {
        $url = "{$this->url_list->league_url}/by-summoner/{$summoner_id_csv}/entry?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_leagues_by_team_ids($team_id_csv) {
        $url = "{$this->url_list->league_url}/by-team/{$team_id_csv}?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_league_by_team_ids($team_id_csv) {
        $url = "{$this->url_list->league_url}/by-team/{$team_id_csv}/entry?api_key=".API_KEY;
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_challenger_leagues($type) {
        $data = array(
            //TODO: ENSURE TYPE IS VALID, CREATE AS CONFIG PARAM? SET DEFAULT VALUE.
            'type'    => $type,
            'api_key' => API_KEY
        );
        $url          = "{$this->url_list->league_url}/challenger?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

    public function fetch_master_leagues($type) {
        $data = array(
            //TODO: ENSURE TYPE IS VALID, CREATE AS CONFIG PARAM? SET DEFAULT VALUE.
            'type'    => $type,
            'api_key' => API_KEY
        );
        $url          = "{$this->url_list->league_url}/master?".http_build_query($data);
        return json_decode(file_get_contents($url),true);
    }

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