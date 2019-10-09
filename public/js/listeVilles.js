function openModal($url,$nomDeLaVille){
    $("#villeNom").html("Etes vous sur de vouloir supprimer " + $nomDeLaVille + "?");
    $("#confirm").html("Etes vous sur de vouloir supprimer " + $nomDeLaVille + "?");
    $("#val").attr("onClick","validerSuppr('"+$url+"')");
    $("#modalSuppression").modal();
}

function validerSuppr(url){
    window.location.replace(url);
}