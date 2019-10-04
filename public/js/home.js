$(document).ready(function(){

    $("#site").change(function(){
        refreshSorties();
    });
    $("input").keyup(function(){
        refreshSorties();
    });
    $("input").change(function(){
        refreshSorties();
    });
    $("#resetForm").click(function(){
        resetForm();
    });
    refreshSorties();
});
function refreshSorties(){
    var formData = {};
    formData['site']= $("#site").val();
    $(form).find("input[id]").not(":input[type=checkbox]").each(function (index, node) {
        formData[node.id] = node.value;
    });
    formData["orga"]=$("#orga").is(":checked");

    formData["inscrit"]=$("#inscrit").is(":checked");

    formData["noninscrit"]=$("#noninscrit").is(":checked");

    formData["passees"]=$("#passees").is(":checked");

    $.ajax({
        type: 'POST',
        url: "refreshSorties",
        data: formData,
        complete: function(data) {
            $("#table").html(data.responseText)
        }
    });
}
function resetForm(){
    $(':input','#form')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
    $("#site").val(0);
}