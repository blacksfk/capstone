/*================================================================
    CONSTANTS
  ==============================================================*/
const SLIDE_TIME = 700;


/*================================================================
    GLOBALS
  ==============================================================*/
var col; // index of th was clicked when sorting tables
var sortedElements = []; // elements which have been sorted
var $spinner = $("#overlay-spinner"); // the div that contains the loading spinner
var $adminModal = $("#adminModal"); // the modal pop up
var $modalConfirm = $("#modalConfirm"); // the confirm button in the modal

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
function confirmDelete(event, formID, name) {
    event.stopPropagation();
    event.preventDefault();

    modalText(
        "Confirm deletion",
        "Are you sure you want to delete " + name + "? This action cannot be undone!",
        "btn btn-danger"
    );

    $modalConfirm.click(function() {
        $(formID).submit();
    });

    $adminModal.modal("show")
}

/**
 * Shows a modal and runs a callback
 * @param  JSEvent   event
 * @param  string   formID      ID of the form to submit
 * @param  {Function} callback  The function to run once the user clicks modalConfirm
 * @param  string   selector    The inputs to append to the form
 * @return void            
 */
function confirmOverwrite(event, formID, selector, callback) {
    event.stopPropagation();
    event.preventDefault();

    modalText(
        "Confirm overwrite",
        "Are you sure you want overwrite all records in the database? This action cannot be undone!",
        "btn btn-danger",
    );

    $modalConfirm.click(function() {
        callback(event, formID, selector);
    });

    $adminModal.modal("show");
}

/**
 * Function for common modal operations
 * 
 * @param  string header  The text to go into the modal header
 * @param  string body    The text to go into the modal body
 * @param  string classes A string of css classes separated by spaces
 * @return void
 */
function modalText(header, body, classes) {
    $adminModal.find(".modal-header").html(header);
    $adminModal.find(".modal-body").html(body);
    
    $modalConfirm.removeClass();
    $modalConfirm.addClass(classes);
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
    event.stopPropagation();
    event.preventDefault();

    $.post($(caller).prop("href"), {
        name: $("#name").val(), 
        content: $("#content").val(),
        _token: $("input[name=_token]").val()
    }, 
    function(data) {
        if ("errors" in data) {
            alert(data["errors"]);
        }
        else {
            var wdw = window.open();
            wdw.document.write(data["html"]);
        }
    }, "json");
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
 * 
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
            "<td><input type='text' name='items[" + count + "][asset_id]' class='form-control' value='" + $("#carousel-select").val() + "' readonly></td>" + 
            "<td><input type='text' name='items[" + count + "][caption]' class='form-control' value='" + $("#carousel-caption").val() + "'></td>" +
            "<td><img src='" + $("#_asset_path").val() + "/" + $("#carousel-select :selected").text() + "' height='200px' width='200px' class='img-thumbnail'></td>" +
            "<td>" +
                "<button class='btn btn-default' onclick='shiftUp(this, event)'><span class='fa fa-arrow-circle-up'></span></button>" +
                "<button class='btn btn-default' onclick='shiftDown(this, event)'><span class='fa fa-arrow-circle-down'></span></button>" +
            "</td>" +
            "<td><button class='btn btn-default' onclick='deleteRow(this, event)'><span class='fa fa-times'></span></button></td>" +
        "</tr>"

    $(html).hide().appendTo(tableSelector).fadeIn(SLIDE_TIME);
}

/**
 * Shifts the table row up one
 * 
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
 * 
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

/**
 * Comparsion function for sorting tables
 * 
 * @param  Table row x
 * @param  Table row y
 * @return int
 */
function tdCompare(x, y) {
    var $x = $($(x).children("td").get(col));
    var $y = $($(y).children("td").get(col));

    if ($x.text().toUpperCase() < $y.text().toUpperCase()) {
        return -1;
    }
    else if($x.text().toUpperCase() === $y.text().toUpperCase()) {
        return 0;
    }

    return 1;
}

/**
 * Comparsion function that sorts the table in reverse
 * 
 * @param  Table row x
 * @param  Table row y
 * @return int
 */
function tdCompareInverse(x, y) {
    return tdCompare(y, x);
}

/**
 * Checks if the element exists in the array
 * 
 * @param  element
 * @param  array
 * @return boolean         True if exists, false if not
 */
function inArray(element, array) {
    for (var i = 0; i < array.length; i++) {
        if (array[i] === element) {
            return true;
        }
    }

    return false;
}

/**
 * This function shows a modal containing all of the assets of 
 * the selected type. When the user clicks 'add', the blade asset 
 * helper is appended to the content field.
 * 
 * @param  HTMLObject caller
 * @param  JSEvent event
 * @param  AssetType type
 * @return void
 */
function appendAsset(caller, event, type) {
    event.stopPropagation();
    event.preventDefault();

    var url = $(caller).prop("href");
    $spinner.fadeIn(100);

    $.get(url, {type: type}, function(data) {
        var html = "<select id='asset-select' class='form-control'>";

        $.each(data, function(index, json) {
            html += "<option value='" + json.name + "'>" + json.name + "</option>";
        });

        html += "</select>";

        var data = createAssetPreview(html, type, data[0].name);
        var selector = data["selector"];
        modalText("Select an asset to append", data["html"], "btn btn-default");
        var $select = $("#asset-select");

        $modalConfirm.off("click"); // remove any previous click handlers
        $modalConfirm.click(function() {
            $("#content").append("{{ asset('assets/" + type + "/" + $select.val() + "') }}");
        });

        $select.off("change");  // remove any previous change handlers
        $select.change(function() {
            if (Object.prototype.toString.call(selector) === "[object Array]") {
                for (var i = 0; i < selector.length; i++) {
                    $(selector[i]["selector"]).prop(selector[i]["prop"], $("#_asset_path").val() + "/" + type + "/" + $select.val());
                }
            }
            else {
                $(selector["selector"]).prop(selector["prop"], $("#_asset_path").val() + "/" + type + "/" + $select.val());
            }
        });

        $spinner.fadeOut(100);
        $adminModal.modal("show");
    }, "json");
}

/**
 * Creates the HTML tags based on the type selected and determines 
 * the selector and source properties to bind a change() event handler to
 * 
 * @param  string html The HTML to append to
 * @param  string type The type selected
 * @param  string name The name of the asset to set as the default preview
 * @return Object
 */
function createAssetPreview(html, type, name) {
    var props = {selector: "#asset-preview", prop: "src"};
    var src = $("#_asset_path").val() + "/" + type + "/" + name;

    if (type === "img") {
        html += "<img id='asset-preview' class='img-thumbnail' src='" + src + "'>";
    }
    else if (type === "video") {
        html += "<video id='asset-preview' controls class='img-thumbnail' src='" + src + "'></video>";
    }
    else {
        html += "<object id='asset-preview' data='" + src + "' height='200px' width='200px'><a href='" + src + "</a></object>"
        props = [{selector: "#asset-preview", prop: "data"}, {selector: "#asset-preview > a", prop: "href"}];
    }

    return {html: html, selector: props};
}


/*================================================================
    EVENT HANDLERS
  ==============================================================*/
 // slide away alerts (smoother)
$(".alert").on("close.bs.alert", function(event) {
    event.preventDefault();
    $(this).slideUp();
});

// change the image source for previewing carousel items
$("#carousel-select").change(function() {
    $("#carousel-preview").prop("src", $("#_asset_path").val() + "/" + $("#carousel-select :selected").text());
});

// asset management index filtering
$("#asset_filter").change(function() {
    $.each($("tbody tr"), function(index, element) {
        var td = $(element).children("td").get(1);
        if ($(td).text() === $("#asset_filter").val() || $("#asset_filter").val() === "") {
            $(element).show();
        }
        else {
            $(element).hide();
        }
    });
});

// table sorting handler
$(".sortable").click(function(event) {
    event.stopPropagation();
    event.preventDefault();

    col = $(this).index();
    var $table = $($(this).parents("table").first());
    var array = $table.find("tbody > tr");
    var cmp = null;

    if (sortedElements[col] === true) {
        cmp = tdCompareInverse;
        sortedElements[col] = false;
    }
    else {
        cmp = tdCompare;
        sortedElements[col] = true;
    }

    sort.quick(array, 0, array.length - 1, cmp);
    $table.find("tbody").html(array);
});
