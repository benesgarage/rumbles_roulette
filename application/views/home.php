<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Rumble's Roulette | Home</title>

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href='https://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/lol_logo.png')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skeleton.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/normalize.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">

    <!-- Scripts
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/angular.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/Access_api.js');?>"></script>


</head>

</body>
<header id="header_nav" class="twelve columns">
    <div id="nav_bar" class="twelve columns">
        <div class="one column"><br></div>
        <img id="logo"
             class="one column"
             src="<?php echo base_url('assets/images/RR_shadow_blur.png');?>"
             onclick="window.location ='<?php echo base_url();?>'">
        <button class="one column" id="champion_statistics_button" style="float: left;">Champion Statistics</button>
        <div class="five columns"><br> </div>
        <input class="three columns" type="text" id="search_field" placeholder="Enter a summoner's name.">
        <input class="one column" type="button" id="search_button" value="" 
               onclick="findSummoner('<?php echo base_url('home/find_summoner');?>')">
    </div>
</header>
<div id="landing_banner" class="twelve columns">
    <div id="main" class="container">
        <div id="frontpage_advert" class="twelve columns">
            <div class="three columns"><br></div>
            <label id="frontpage_quote" class="six columns">AP LEE SIN? AP LEE WIN!</label>
            <div class="three columns"><br></div>
        </div>
        <div id="frontpage_motto" class="twelve columns">
            <div class="two columns"><br></div>
            <label id="frontpage_underquote" class="eight columns">PLAY THE MOST ABSURD BUILDS
                AND BE REWARDED WITH GREAT PRIZES</label>
            <div class="two columns"><br></div>
        </div>
        <div id="register_front_page" class="twelve columns">
            <div class="four columns"><br></div>
            <button class="four columns" id="register">START NOW</button>
            <div class="four columns"><br></div>
        </div>
    </div>
</div>
<div id="landing_info" class="twelve columns">
    <div class="two columns"><br></div>
    <h1 class="ten columns">Be a god at league of legends</h1>
    <div class="one column"><br></div>
    <p class="eleven columns" style="font-size: 18px">Roll your dice and try your luck, Rumble's Roulette generates a
        random champion out of your champion pool for you to use with a totally random build, but wait,
        we are the first of its kind to score your performance and create leaderboard rankings
        based on kills, assists, build progress, etcetera.<br><br>
        If you feel up to the challenge hit that roll button and give it a try.
        <br><br>Happy rumbling.</p>
    <img id="item" class="one column" src="<?php echo base_url('assets/images/item_ring_iceborn.png');?>">
    <img id="item" class="one column" src="<?php echo base_url('assets/images/item_ring_hog.png');?>">
    <img id="item" class="one column" src="<?php echo base_url('assets/images/item_ring_mastery.png');?>">
    <img id="item" class="one column" src="<?php echo base_url('assets/images/item_ring.png');?>">
</div>

<footer id="footer_nav" class="twelve columns">
</footer>
</body>
</html>