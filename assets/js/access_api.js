window.onload = function(){
    $("#search_field").keyup(function(event){
        if(event.keyCode == 13){
            $("#search_button").click();
        }
    })
};

function findSummoner(url) {
    $("#landing_banner").fadeOut(1000);
    $("#landing_info").fadeOut(1000);
    summonerToSearch = formatSummonerName($("#search_field").val());
    doAjax(url,{summoner:summonerToSearch})
}

function formatSummonerName(summonerName){
    summonerName = summonerName.replace(/\s/g,"");
    summonerName = summonerName.toLowerCase();
    return summonerName;
}

function doAjax(url, data){
    $.ajax({
        url: url,
        type: "GET",
        dataType: 'json',
        data: data
    }).done (function(data){
        return callBack(data);
    });

}