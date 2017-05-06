var deleteClicked = false;

$("form").submit(function(event) {
    if (deleteClicked === true) {
        return;
    }

    var form = this;

    // only show modal if the form action is delete
    if ($("input[name='_method']", form).length === 0 || $("input[name='_method']", form).val().toUpperCase() !== "DELETE") {
        return;
    }

    event.preventDefault();
    deleteClicked = true;
    var name = $(form).find("input[name='record']");

    $(".modal-header").text("Confirm deletion");

    // extract the name of the item from the button
    $(".modal-body").text(
        "Are you sure you want to delete " + 
        $(name).val() +  
        "? This action cannot be undone!"
    );
    $("#adminModal").modal("show")

    // trigger the form action on click confirmation
    $(".modal-footer > .btn-danger").click(function() {
        $("#adminModal").modal("hide");
        $(form).submit();
    });
});

// reset flag when modal is hidden
$("#adminModal").on("hidden.bs.modal", function() {
    deleteClicked = false;
});

// slide away alerts
$(".alert").on("close.bs.alert", function(event) {
    event.preventDefault();
    $(this).slideUp();
});
