$(document).ready(function(){
    $("#ville").change(function () {
        console.log($(this).val());
        getLieux($(this).val());
    })
    $("#publi").click(function () {
        $("#typeSub").val("Ouverte");
    });
    getLieux($("#ville").val());
});

function getLieux($idVille){
    $.ajax({
        type: 'POST',
        url: "majLieux",
        data: "&idVille="+$idVille,
        complete: function(data) {
            console.log(data.responseText);
            $("#lieu").html(data.responseText);
            getInfosLieux($("#sortie_lieu").val());
        }
    });
}

function getInfosLieux($idLieu){
    $.ajax({
        type: 'POST',
        url: "majInfoLieu",
        data: "&idLieu="+$idLieu,
        complete: function(data) {
            console.log(data.responseText);
            $("#infoLieu").html(data.responseText);
        }
    });
}