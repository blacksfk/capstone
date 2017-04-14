const ALERT_FADE_TIME = 3000;
var deleteClicked = false;

// show confirmation modal on deletion
$(".btn-danger[value~='Delete']").click(function(event) {
    if (deleteClicked === true) {
        return;
    }

    event.preventDefault();
    deleteClicked = true;
    var button = $(this);

    // populate the modal with text
    $(".modal-header").text("Confirm deletion");
    $(".modal-body").text("Are you sure you want to delete " + $("#name").val() + "? This action cannot be undone!");
    $("#adminModal").modal("show");

    // trigger the form action on click confirmation
    $(".modal-footer > .btn-danger").click(function() {
        $("#adminModal").modal("hide");
        $(button).trigger("click");
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