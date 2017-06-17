/*

This is the overall javascript file for the website. All functions should go here.

*/
/*================================================================
    GLOBALS
  ==============================================================*/
var col; // index of th was clicked when sorting tables
var sortedElements = []; // elements which have been sorted


/*============================================
   Sort compare functions
  ==========================================*/
function tdCompare(x, y) {
    var $x = $($(x).children("td").get(col));
    var $y = $($(y).children("td").get(col));

    // natural sorting with localeCompare()
    return $x.text().localeCompare($y.text(), undefined, {numeric: true, sensitivity: 'base'});
}

function tdCompareInverse(x, y) {
    return tdCompare(y, x);
}


/*===========================================
   Carousel functions
  =========================================*/
var $item = $('.carousel .item');
var $wHeight = $(window).height();

$item.height($wHeight); 
$item.addClass('full-screen');

var $numberofSlides = $('.item').length;
var $currentSlide = Math.floor((Math.random() * $numberofSlides));

$('.carousel-indicators li').each(function(){
    var $slideValue = $(this).attr('data-slide-to');

    if ($currentSlide == $slideValue) {
        $(this).addClass('active');
        $item.eq($slideValue).addClass('active');
    } 
    else {
        $(this).removeClass('active');
        $item.eq($slideValue).removeClass('active');
    }
});

$('.carousel img').each(function() {
    var $src = $(this).attr('src');
    var $color = $(this).attr('data-color');

    $(this).parent().css({
        'background-image' : 'url(' + $src + ')',
        'background-color' : $color
    });
    $(this).remove();
});

$(window).on('resize', function (){
    $wHeight = $(window).height();
    $item.height($wHeight);
});

$('.carousel').carousel({
    interval: 6000,
    pause: "false"
});


/*===========================================
   Active link
  =========================================*/
var link = "ul.nav a[href='" + window.location.href + "'";
$(link).parent().addClass("active");

if ($(link).parents("ul").hasClass("dropdown-menu")) {
    $(link).parents(".dropdown").addClass("active");
}


/*===========================================
   Newsletter
  =========================================*/
function changeNewsletter(caller, event, name) {
    event.stopPropagation();
    event.preventDefault();

    var $nlObj = $("#newsletterObject");
    var $caller = $(caller);

    $(".list-group-item.active").removeClass("active"); // remove active from the current
    $caller.addClass("active");         // add active to the clicked item
    $nlObj.prop("data", $caller.prop("href"));  // switch the source
    $nlObj.find("a").prop("href", $caller.prop("href")); // switch the link
}

/*============================================
   Events tab switching
  ==========================================*/
function showEvents(caller, event, show, hide) {
    event.stopPropagation();
    event.preventDefault();

    $.each(hide, function(index, element) {
        $(element).hide();
    });

    $(show).show();

    $(".nav-tabs > li").removeClass("active");
    $(caller).parent("li").addClass("active");
}

/*============================================
   Event handlers
  ==========================================*/
// table sorting handler
$(".sortable").click(function(event) {
    event.stopPropagation();
    event.preventDefault();

    col = $(this).index();
    var $table = $($(this).closest("table"));
    var $tbody = $($table.find("tbody:visible"));
    var array = $tbody.children("tr");
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
    $tbody.html(array);
});

