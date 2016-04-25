window.onload = function(){
    $("#search_field").keyup(function(event){
        if(event.keyCode == 13){
            $("#search_button").click();
        }
    })
};

function findSummoner(url) {
    summonerToSearch = formatSummonerName($("#search_field").val());
    doAjax(url,{summoner:summonerToSearch},function (summoner_data) {
        profile_icon_url = set_profile_icon_url(summoner_data[summonerToSearch]['profileIconId']);
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
            "</div>").insertAfter("header");
        
        $("#profile_page").fadeIn(500);
    });
    $("#landing_banner").fadeOut(500, function () {
        $(this).remove();
    });
    $("#landing_info").fadeOut(500, function () {
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

function removeLanding(){

}