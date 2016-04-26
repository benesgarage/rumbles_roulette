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
    });
};

function findSummoner(url) {
    summonerToSearch = formatSummonerName($("#search_field").val());
    doAjax(url,{summoner:summonerToSearch},function (summoner) {
        $(summoner).insertAfter("header");

        $("#profile_page").fadeIn(500);
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
        data: data,
        success: function(data){
            return callback(data);
        }
    });
}

function resize_ring()
{
    $('#summoner_champion_data').children().css({
        width: '90px',
        height: '90px',
        marginTop: '17px'
    });
    $(event.target).css({
        width: '120px',
        height: '120px',
        marginTop: '5px'
    })
}