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
 }