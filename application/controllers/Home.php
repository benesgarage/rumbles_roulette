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

     public function find_summoner()
     {
         $result = file_get_contents("https://euw.api.pvp.net/api/lol/euw/v1.4/summoner/by-name/"
             .$_GET['summoner']."?api_key=3b5d74b4-52b6-4f8d-8192-44e310307080");
         sleep(5);
         echo $result;
     }

     public function get_summoner_league_entry()
     {
         $result = file_get_contents("https://euw.api.pvp.net/api/lol/euw/v2.5/league/by-summoner/"
         .$_GET['summoner_id']."/entry?api_key=3b5d74b4-52b6-4f8d-8192-44e310307080");
         echo $result;
     }
 }