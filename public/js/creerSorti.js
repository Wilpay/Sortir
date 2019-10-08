$(document).ready(function(){
    $("#ville").change(function () {
        console.log($(this).val());
        getLieux($(this).val());
    })
    $("#publi").click(function () {
        $("#typeSub").val("Ouverte");
    });
    if($("#idVille").val()!=0){

        $("#ville").val($("#idVille").val());
    }
    $("#ville").val()
    getLieux($("#ville").val());
    if($("#idLieu").val()!=0){

        $("#sortie_lieu").val($("#idLieu").val());
    }
});

function getLieux($idVille){
    $.ajax({
        type: 'POST',
        url: $("#urlLieu").val(),
        data: "&idVille="+$idVille,
        complete: function(data) {
            //console.log(data.responseText);
            $("#lieu").html(data.responseText);
            getInfosLieux($("#sortie_lieu").val());
        }
    });
}

function getInfosLieux($idLieu){
    $.ajax({
        type: 'POST',
        url: $("#urlInfoLieu").val(),
        data: "&idLieu="+$idLieu,
        complete: function(data) {
            //console.log(data.responseText);
            $("#infoLieu").html(data.responseText);
        }
    });
}

