<div id='profile_page' class='twelve columns'>
    <div id='profile_dashboard' class='twelve columns'>
        <img 
            id='profile_icon' 
            src="<?php echo str_replace('profileiconid',$summoner_data['profileIconId'],profile_icon_url) ?>"
        >
        <div id='profile_name_and_options'>
            <label id='summoner_name'><?php $summoner_data['name']?></label>
            <div id='profile_options'>
                <button id='renew_button' value='Renew data'>Renew</button>
                <button  value='Live game'>Live game</button>
                <button  value='Rate'>Rate</button>
            </div>
        </div>
    </div>
    <div id='summoner_data' class='twelve columns'>
        <div id='summoner_league_data' class='four columns'>
            <img
                id='rank_medal'
                src="<?php
                $rank = strtolower($league_data['tier']);
                $roman_dict = array('I'=>1, 'II'=>2, 'III'=>3, 'IV'=>4, 'V'=>5);

                echo base_url("assets/images/lol_ranks/".$rank."_"
                    .$roman_dict[$league_data['entries'][0]['division']].".png");
                ?>"
            >
            <div id='league_data_details'>
                <label id='league_name'><?php echo $league_data['name'];?></label>
                <label id='rank_division_label'><?php
                    $rank = ucfirst(strtolower($league_data['tier']));
                    if($rank != "Challenger" and $rank != "Master"){
                        echo $rank." ".$league_data['entries'][0]['division'];
                    }else{
                        echo $rank;
                    }
                    ?></label>
                <label id='league_points_label'>
                    <?php echo $league_data['entries'][0]['leaguePoints']."LP"; ?>
                    </label>
                <label id='league_win_percent_label'><?php
                    echo(number_format((
                        ($league_data['entries'][0]['wins'] /
                            ($league_data['entries'][0]['wins']+$league_data['entries'][0]['losses'])
                        )*100),2,'.','')
                    )
                    ?></label>
                </div>
            </div>
        <div id='summoner_champion_data' class='seven columns'>
            <img class='champion_ring' src='<?php echo base_url("assets/images/champion_squares/Aatrox_ring.png")?>'>
            <img class='champion_ring' src='<?php echo base_url("assets/images/champion_squares/Ahri_ring.png")?>'>
            <img class='champion_ring' src='<?php echo base_url("assets/images/champion_squares/Akali_ring.png")?>'>
            <img class='champion_ring' src='<?php echo base_url("assets/images/champion_squares/Alistar_ring.png")?>'>
            <img class='champion_ring' src='<?php echo base_url("assets/images/champion_squares/Aatrox_ring.png")?>'>

            </div>
        </div>
    </div>