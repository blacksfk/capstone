var deleteClicked = false;

$("form").submit(function(event) {
    if (deleteClicked === true) {
        return;
    }

    // only show modal if the form action is delete
    if ($(this).find("[name='_method']").val().toUpperCase() !== "DELETE") {
        return;
    }

    event.preventDefault();
    deleteClicked = true;

    var form = this;
    var button = $(form).find("input:submit");

    $(".modal-header").text("Confirm deletion");

    // extract the name of the item from the button
    $(".modal-body").text(
        "Are you sure you want to delete " + 
        $(button).val().match(/^Delete\s(.+)/)[1] +  
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
