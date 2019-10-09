function openModal($url,$nomDuLieu){
 $("#LieuNom").html("Etes vous sur de vouloir supprimer " + $nomDuLieu + "?");
    $("#confirm").html("Etes vous sur de vouloir supprimer " + $nomDuLieu + "?");
 $("#val").attr("onClick","validerSuppr('"+$url+"')");
 $("#modalSuppression").modal();
}

function validerSuppr(url){
    window.location.replace(url);
}