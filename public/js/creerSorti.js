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
        success: function(data) {
            //console.log(data.responseText);
            $("#lieu").html(data);
            getInfosLieux($("#sortie_lieu").val());
        }
    });
}

function getInfosLieux($idLieu){
    $.ajax({
        type: 'POST',
        url: $("#urlInfoLieu").val(),
        data: "&idLieu="+$idLieu,
        success: function(data) {
            //console.log(data.responseText);
            $("#infoLieu").html(data);
        },
        error:function(data) {
            //console.log(data.responseText);
            $("#infoLieu").html('<div class="row mb-2">\n' +
                '    <div class="font-weight-bold col-4">Rue:</div>\n' +
                '    <div class="col-8">\n' +
                '    </div>\n' +
                '</div>\n' +
                '<div class="row mb-2">\n' +
                '    <div class="font-weight-bold col-4">Latitude:</div>\n' +
                '    <div class="col-8">\n' +
                '    </div>\n' +
                '</div>\n' +
                '<div class="row mb-2">\n' +
                '    <div class="font-weight-bold col-4">Longitude:</div>\n' +
                '    <div class="col-8">\n' +
                '    </div>\n' +
                '</div>' );
        }
    });
}

