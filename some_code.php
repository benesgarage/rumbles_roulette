<div class="twelve columns" id="summoner_options" style="margin-top: 5%">
    <button class="four columns" id="last_game">Last game</button>
    <button class="four columns" id="ranked_stats">Ranked stats</button>
    <button class="four columns" id="runes">Runes</button>
</div>
<div class="twelve columns" id="summonerData" style="margin-top: 2%">
    <div class="offset-by-one column">
        <img class="two columns" id="profileIcon" src="http://ddragon.leagueoflegends.com/cdn/6.2.1/img/profileicon/0.png"
             onerror="this.src = 'http://ddragon.leagueoflegends.com/cdn/6.2.1/img/profileicon/0.png'">
        <h1 class="three columns" id="summonerLevel">benesgarage</h1>
    </div>

    <h1 id="summonerName"></h1>
</div>
<section id="teamOne">
    <?php for ($k = 1; $k < 5; $k++) { ?>
        <img id="player<?php echo $k ?>"
             src="<?php echo base_url('assets/images/ChampionSquare.png')?>images/ChampionSquare.png"
             onerror="this.src= <?php echo base_url('assets/images/ChampionSquare.png')?>">
    <?php } ?>
</section>
<section id="teamTwo">
    <?php for ($k = 1; $k < 5; $k++) { ?>
        <img id="player0<?php echo $k ?>"
             src="<?php echo base_url('assets/images/ChampionSquare.png')?>images/ChampionSquare.png"
             onerror="this.src= <?php echo base_url('assets/images/ChampionSquare.png')?>">
    <?php } ?>
</section>