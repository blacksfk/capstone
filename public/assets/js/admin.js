/*================================================================
    CONSTANTS
  ==============================================================*/
 const SLIDE_TIME = 700;


 /*================================================================
    FUNCTIONS
   ==============================================================*/
/**
 * Creates and shows a deletion confirmation modal, and submits 
 * the original form if the user clicks confirm
 * 
 * @param  JSEvent event  
 * @param  String formID    The deletion form that will be submitted
 * @return void
 */
function confirmDelete(event, formID) {
    event.stopPropagation();
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
    });
}

/**
 * Shows a modal and runs a callback
 * @param  JSEvent   event
 * @param  string   formID      ID of the form to submit
 * @param  {Function} callback  The function to run once the user clicks confirm
 * @param  string   selector    The inputs to append to the form
 * @return void            
 */
function confirmOverwrite(event, formID, callback, selector) {
    event.stopPropagation();
    event.preventDefault();

    $("#adminModal .modal-header").text("Confirm overwrite");
    $("#adminModal .modal-body").text("Are you sure you want overwrite all records in the database? This action cannot be undone!");
    $("#modalConfirm").addClass("btn-danger");
    $("#adminModal").modal("show");
    $("#modalConfirm").click(function() {
        callback(event, formID, selector);
    });
}

/**
 * Builds an associative array, performs an ajax get request to the server,
 * creates a window, and appends the result (a string to the newly created window)
 * 
 * @param  HTMLObject caller    An HTML object with an href property - required!!
 * @param  JSEvent    event
 * @return void
 */
/*
function previewPage(caller, event) {
    event.stopPropagation();
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
*/
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
            "<div class='code-editor' data-language='php'>" +
            "<textarea name='content[" + section + "]' id=" + section + " cols='30' rows='10' class='form-control'></textarea>" +
            "</div></div>"
        $(htmlString).hide().appendTo("#inputs").slideDown(SLIDE_TIME);
    });
    $(":animated").promise().done(function() {flask.runAll(".code-editor");});
}

/**
 * Deletes a row from a table with the slide away animation
 * 
 * @param  HTMLObject caller
 * @param  JSEvent event
 * @return void
 */
function deleteRow(caller, event) {
    event.stopPropagation();
    event.preventDefault();

    var tr = $(caller).parents("tr").first();

    $(tr).addClass("slideAway");
    $(tr).one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function() {
        $(tr).remove();
    });
}

/**
 * Appends all elements given by the selector to the form specified
 * 
 * @param  JSEvent event
 * @param  String formID   The form to append to
 * @param  String selector The inputs to append to the form
 * @return void
 */
function appendToForm(event, formID, selector) {
    event.stopPropagation();
    event.preventDefault();

    $(selector).each(function(index, element) {
        $(element).appendTo(formID);
    });

    $(formID).submit();
}

/**
 * Appends the selected image to the carousel table
 * @param  JSEvent event
 * @param  string tableSelector what to select and append
 * @return void
 */
function appendToCarousel(event, tableSelector) {
    event.stopPropagation();
    event.preventDefault();

    var count = $(tableSelector + "> tr").length;
    var index = count + 1;
    var html = "" +
        "<tr>" +
            "<td>&#35;" + index + "</td>" +
            "<td><input type='text' name='items[" + count + "][asset_id]' value='" + $("#carousel-select").val() + "' readonly></td>" + 
            "<td><input type='text' name='items[" + count + "][caption]' value='" + $("#carousel-caption").val() + "'></td>" +
            "<td><img src='" + $("#_asset_path").val() + "/" + $("#carousel-select :selected").text() + "' height='200px' width='200px' class='img-thumbnail'></td>" +
            "<td>" +
                "<button class='btn btn-default'><span class='fa fa-arrow-circle-up'></span></button>" +
                "<button class='btn btn-default'><span class='fa fa-arrow-circle-down'></span></button>" +
            "</td>" +
            "<td><button class='btn btn-default' onclick='deleteRow(this, event)'><span class='fa fa-times'></span></button></td>" +
        "</tr>"

    $(html).hide().appendTo(tableSelector).fadeIn(SLIDE_TIME);
}

/**
 * Shifts the table row up one
 * @param  button caller
 * @param  JSEvent event
 * @return void
 */
function shiftUp(caller, event) {
    event.stopPropagation();
    event.preventDefault();

    var row = $(caller).parents("tr:first");
    row.insertBefore(row.prev());
}

/**
 * Shifts the table row down one
 * @param  button caller
 * @param  JSevent event
 * @return void
 */
function shiftDown(caller, event) {
    event.stopPropagation();
    event.preventDefault();

    var row = $(caller).parents("tr:first");
    row.insertAfter(row.next());
}


/*================================================================
    EVENT HANDLERS
  ==============================================================*/
 // slide away alerts (smoother)
$(".alert").on("close.bs.alert", function(event) {
    event.preventDefault();
    $(this).slideUp();
});
/*
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
*/
// change the image source for previewing carousel items
$("#carousel-select").change(function() {
    $("#carousel-preview").prop("src", $("#_asset_path").val() + "/" + $("#carousel-select :selected").text());
})

var flask = new CodeFlask;
flask.runAll(".code-editor");

