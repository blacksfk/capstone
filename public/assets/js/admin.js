// slide away alerts
$(".alert").on("close.bs.alert", function(event) {
    event.preventDefault();
    $(this).slideUp();
});

function toggleLinks(event, formID) {
    event.preventDefault();
    $("input:checked").each(function(index, element) {
        $(formID).append(element);
    });
    $(formID).submit();
}

function confirmDelete(event, formID) {
    event.preventDefault();
    
    var name = $(formID).find("input[name='record']");

    $("#adminModal .modal-header").text("Confirm deletion");
    $("#adminModal .modal-body").text(
        "Are you sure you want to delete " +
        $(name).val() +
        "? This action cannot be undone!"
    );
    $("#modalConfirm").addClass("btn-danger");
    $("#adminModal").modal("show");
    $("#adminModal .btn-danger").click(function() {
        $("#adminModal").modal("hide");
        $(formID).submit();
    })
}
