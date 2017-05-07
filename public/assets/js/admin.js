/*================================================================
    CONSTANTS
 ===============================================================*/
 const SLIDE_TIME = 700;


 /*================================================================
    FUNCTIONS
 ===============================================================*/
 /**
  * Finds all of the checked input boxes, appends them to the form specified, 
  * and then submits the form
  * 
  * @param  JSEvent event
  * @param  String formID The ID attribute of the form that will be submitted
  * @return void
  */
function toggleLinks(event, formID) {
    event.preventDefault();
    $("input:checked").each(function(index, element) {
        $(formID).append(element);
    });
    $(formID).submit();
}

/**
 * Creates and shows a deletion confirmation modal, and submits 
 * the original form if the user clicks confirm
 * 
 * @param  JSEvent event  
 * @param  String formID    The deletion form that will be submitted
 * @return void
 */
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
    $("#modalConfirm").click(function() {
        $(formID).submit();
    })
}

/**
 * Builds an associative array, performs an ajax get request to the server,
 * creates a window, and appends the result (a string to the newly created window)
 * 
 * @param  HTMLObject caller    An HTML object with an href property - required!!
 * @param  JSEvent    event
 * @return void
 */
function previewPage(caller, event) {
    event.preventDefault();
    var contentArray = {};

    $("input[name^='content']").each(function(index, element) {
        contentArray[element.id] = element.value;
    });

    $.get($(caller).prop("href"), {
        id: $("#template_id").val(), 
        name: $("#name").val(), 
        content: JSON.stringify(contentArray)
    }, 
    function(data) {
        var wdw = window.open();
        wdw.document.write(data);
    });
}

/**
 * Appends the data received to the html object specified 
 * (to be used with templates)
 * 
 * @param  JSON data    A JSON object with sections
 * @return void            
 */
function appendSections(data) {
    $.each(data, function(index, section) {
        htmlString = "" +
            "<div class='form-group'>" +
            "<label for='content[" + section + "]'>" + section + "</label>" +
            "<textarea name='content[" + section + "]' id=" + section + " cols='30' rows='10' class='form-control'></textarea>" +
            "</div>"
        $(htmlString).hide().appendTo("#inputs").slideDown(SLIDE_TIME);
    }); 
}


/*================================================================
    EVENT HANDLERS
 ===============================================================*/
 // slide away alerts (smoother)
$(".alert").on("close.bs.alert", function(event) {
    event.preventDefault();
    $(this).slideUp();
});

// get all the sections for a template
$("#template_id").change(function() {
    if ($("#inputs").html() !== "") {
        $("#inputs").html("");
    }

    // hidden field in the form to store the dynamic route to the template
    $.get($("input[name='_template_route']").val(), 
        {id: $("#template_id").val()}, 
        appendSections, 
        "json"
    );
});
