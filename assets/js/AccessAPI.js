window.onload = function(){
    listenToKey("test",13,createSummonerProfile);

};
var profileIconIdKey = 'profileIconId';
var summonerLevelKey = 'summonerLevel';
var nameKey = 'name';
var idKey = 'id';
var presentSummoner = '';
var summonerData = null;

function listenToKey(input, key, func) {
    document.getElementById(input).addEventListener("keypress", function(e) {
        var pressedKey = e.which || e.keyCode;
        if (pressedKey === key) {
            func(document.getElementById(input).value);
        }
    })
}
function listenToClick(input,func){
    document.getElementById(input).addEventListener("click",func);
}
function createSummonerProfile(summonerName) {
    presentSummoner = formatSummonerName(summonerName);
    doAjax("AccessAPI.php",{functionName:"getSummonerID", summonerName:presentSummoner},function(summonerDataJSON){
        setSummonerData(summonerDataJSON);
        updateSumsSearched(presentSummoner,summonerDataJSON);
        if(summonerDataJSON.hasOwnProperty('error')){
            console.log(summonerDataJSON.error);
        }
        setSummonerIcon(summonerDataJSON[presentSummoner][profileIconIdKey]);
        setSummonerLevel(summonerDataJSON[presentSummoner][summonerLevelKey]);
        setSummonerName(summonerDataJSON[presentSummoner][nameKey]);
        showSummonerOptions();
        listenToClick("lastGame",getSummonerMatches);
    });
}


function doAjax(newUrl, data, callBack){
    $.ajax({
        url: newUrl,
        type: "GET",
        dataType: 'json',
        data: data
    }).done (function(jsonData){
        return callBack(jsonData);
    });

}

function formatSummonerName(summonerName){
    summonerName = summonerName.replace(/\s/g,"");
    summonerName = summonerName.toLowerCase();
    return summonerName;
}

function updateSumsSearched(presentSummoner, summonerDataJSON){
    if(localStorage.getItem("summonersSearched") == null){
        localStorage.setItem("summonersSearched", JSON.stringify({}));
    }
    var sumsSearched = JSON.parse(localStorage.getItem("summonersSearched"));
    sumsSearched[presentSummoner] = summonerDataJSON[presentSummoner][idKey];
    localStorage.setItem("summonersSearched",JSON.stringify(sumsSearched));
}

function setSummonerData(summonerDataJSON){
    summonerData = summonerDataJSON;
    localStorage.setItem(presentSummoner,summonerDataJSON);
}

function setSummonerLevel(summonerLevel){
    document.getElementById('summonerLevel').innerHTML = "Level "+summonerLevel;
}

function setSummonerIcon(profileIconID){
    document.getElementById('profileIcon').setAttribute('src','http://ddragon.leagueoflegends.com/cdn/6.2.1/img/profileicon/'+profileIconID+'.png')
}

function setSummonerName(summonerName){
    document.getElementById('summonerName').innerHTML = summonerName;
}

function showSummonerOptions(){
    document.getElementById('summonerOptions').style.display ="inline-flex";
}

function getSummonerMatches() {
    var summonersSearched = JSON.parse(localStorage.getItem('summonersSearched'));
    var summonerID = summonersSearched[presentSummoner].toString();
    doAjax("AccessAPI.php",{functionName: 'getSummonerMatches', summonerID: summonerID},function(summonerRecentMatchesJSON){
        localStorage.setItem("matches",summonerRecentMatchesJSON);
        setRecentMatchImages(summonerRecentMatchesJSON);
    });
}

function setRecentMatchImages(summonerRecentMatchesJSON) {
    getChampionInfo(summonerRecentMatchesJSON.games[0].championId);
}

function getChampionInfo(championId){
    doAjax('AccessAPI.php',{functionName: 'getChampionIcon', championID: championId},function(championInfo){
        alert(championInfo);
    });
}