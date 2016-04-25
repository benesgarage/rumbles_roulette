var base_url = window.location;

window.onload = function(){
    $(document).ajaxStart(function () {

        $("#loading").delay(500).fadeIn(500);
    }).ajaxStop(function () {
        $("#loading").hide();
    });
    $("#search_field").keyup(function(event){
        if(event.keyCode == 13){
            $("#search_button").click();
        }
    })
};

function findSummoner(url) {
    summonerToSearch = formatSummonerName($("#search_field").val());
    doAjax(url,{summoner:summonerToSearch},function (summoner_data) {
        summonerId = summoner_data[summonerToSearch]['id'];
        doAjax(base_url+"/home/get_summoner_league_entry",{summoner_id:summonerId},
            function (league_data) {
                summoner_league_data = league_data[summonerId][0];
                profile_icon_url = set_profile_icon_url(summoner_data[summonerToSearch]['profileIconId']);
                rank_medal_url =
                    set_rank_medal_url(summoner_league_data['tier'],
                    summoner_league_data['entries'][0]['division']);
                rank_division = set_rank_division(summoner_league_data['tier'],
                    summoner_league_data['entries'][0]['division']);
                win_percentage =
                    get_win_percentage(summoner_league_data['entries'][0]['wins'],
                        summoner_league_data['entries'][0]['losses']);
                $("<div id='profile_page' class='twelve columns'>" +
                        "<div id='profile_dashboard' class='twelve columns'>" +
                            "<img id='profile_icon' src="+profile_icon_url+">"+
                             "<div id='profile_name_and_options'>" +
                                "<label id='summoner_name'>" +
                                    summoner_data[summonerToSearch]['name']+
                                "</label>" +
                                "<div id='profile_options'>"+
                                    "<button id='renew_button' value='Renew data'>Renew</button>"+
                                    "<button  value='Live game'>Live game</button>"+
                                    "<button  value='Rate'>Rate</button>"+
                                "</div>" +
                            "</div>" +
                        "</div>" +
                        "<div id='summoner_league_data' class='four columns'>" +
                            "<img id='rank_medal' src='"+rank_medal_url+"'>"+
                            "<div id='league_data_details'>"+
                                "<label id='league_name'>"+summoner_league_data['name']+"</label>"+
                                "<label id='rank_division_label'>"+rank_division+"</label>"+
                                "<label id='league_points_label'>"
                                    +summoner_league_data['entries'][0]['leaguePoints']+" LP" +
                                "</label>"+
                                "<label id='league_win_percent_label'>"+win_percentage+"% Win rate</label>"+
                            "</div>"+
                        "</div>"+
                "</div>").insertAfter("header");
                
                $("#profile_page").fadeIn(500);
        });
    });
    $("#landing_banner").fadeOut(500, function () {
        $(this).remove();
    });
    $("#landing_info").fadeOut(500, function () {
        $(this).remove();
    });
    $("#profile_page").fadeOut(500, function () {
        $(this).remove();
    });
}



function formatSummonerName(summonerName){
    summonerName = summonerName.replace(/\s/g,"");
    summonerName = summonerName.toLowerCase();
    return summonerName;
}

function doAjax(url, data, callback){
    $.ajax({
        url: url,
        type: "GET",
        dataType: 'json',
        data: data
    }).done (function(data){
        return callback(data);
    });

}

function set_profile_icon_url(profileIconId) {
    return 'http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/'+profileIconId+'.png';
}

function set_rank_medal_url(rank, division){
    rank = rank.toLowerCase();
    roman_dict = {I:1, II:2, III:3, IV:4, V:5};
    return base_url+"assets/images/lol_ranks/"+rank+"_"+roman_dict[division]+".png";
}

function set_rank_division(rank, division){
    roman_dict = {I:1, II:2, III:3, IV:4, V:5};
    rank = rank.charAt(0).toUpperCase() +rank.slice(1).toLowerCase();
    if(rank != "Challenger" & rank != "Master"){
        return rank+" "+roman_dict[division];
    }
    return rank;
}

function get_win_percentage(wins, losses) {
    games = wins+losses;
    return ((wins / games)*100).toFixed(2);
}