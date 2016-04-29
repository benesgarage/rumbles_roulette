<?php
 class Home extends CI_Controller
 {
     public function __construct()
     {
         parent::__construct();

         $this->load->helper('url');
     }

     public function index()
     {
         $this->load->view('home');
     }

     public function generate_summoner_page()
     {
         $summoner['summoner_data'] = $this->get_summoner_data();
         $summoner['league_data'] = $this->get_summoner_league_data($summoner['summoner_data']['id']);
         $summoner['ranked_champions'] = $this->get_summoner_current_ranked_champions($summoner['summoner_data']['id']);
         $html_code = (string)$this->load->view('summoner',$summoner,TRUE);
         echo $html_code;
     }

     private function get_summoner_data()
     {
         $summoner_data = json_decode(file_get_contents("https://euw.api.pvp.net/api/lol/euw/v1.4/summoner/by-name/"
             .$_GET['summoner']."?api_key=".api_key),TRUE);
         return $summoner_data[$_GET['summoner']];
     }
     
     private function get_summoner_league_data($id)
     {
         $league_data = json_decode(file_get_contents("https://euw.api.pvp.net/api/lol/euw/v2.5/league/by-summoner/"
             .$id."/entry?api_key=".api_key),TRUE);
         return $league_data[$id][0];
     }

     private function get_summoner_current_ranked_champions($id)
     {
         $ranked_champions = json_decode(file_get_contents("https://euw.api.pvp.net/api/lol/euw/v1.3/stats/by-summoner/"
             .$id."/ranked?season=SEASON".date("Y")."&api_key=".api_key),TRUE);
         return $ranked_champions['champions'];
     }
     
     public function test() {
         $data = array(
             'region'        => 'euw',
             'summoner_name' => 'benesgarage',
             'summoner_id'   => 28247035
         );
         $this->load->library('Current_user', $data);
         $this->current_user->set_champion_url();
         $this->current_user->set_mastery_url();
         $this->current_user->set_current_game_url();
         $this->current_user->set_featured_games_url();
         $this->current_user->set_games_url();
         $this->current_user->set_league_url();
         echo '<pre>';
         echo "fetch_champions(true);".PHP_EOL;
         print_r($this->current_user->fetch_champions(true));
         echo "fetch_champion(45);".PHP_EOL;
         print_r($this->current_user->fetch_champion(45));
         echo "fetch_champion_mastery_entry(412);".PHP_EOL;
         print_r($this->current_user->fetch_champion_mastery_entry(412));
         echo "fetch_champion_mastery_entries();".PHP_EOL;
         print_r($this->current_user->fetch_champion_mastery_entries());
         echo "fetch_top_mastery_entries(2);".PHP_EOL;
         print_r($this->current_user->fetch_top_mastery_entries(2));
         echo "fetch_current_game();".PHP_EOL;
         print_r($this->current_user->fetch_current_game());
         echo "fetch_featured_games();".PHP_EOL;
         print_r($this->current_user->fetch_featured_games());
         echo "fetch_recent_games();".PHP_EOL;
         print_r($this->current_user->fetch_recent_games());
         echo '</pre>';
     }
 }