$(document).ready(function(){
    refreshSorties();
    $("#site").change(function(){
        refreshSorties();
    });
    $("input").change(function(){
        refreshSorties();
    });
    $("#search").keyup(function(){
        refreshSorties();
    });
});

function refreshSorties(){

    var formData = {};
    formData['site']= $("#site").val();
    $(form).find("input[id]").each(function (index, node) {
        formData[node.id] = node.value;
    });
    console.log(formData);

    $.ajax({
        type: 'POST',
        url: "refreshSorties",
        data: formData,
        complete: function(data) {

        }
    });
}