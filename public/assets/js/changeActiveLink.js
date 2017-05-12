
    //alert(window.location.pathname.split('/'))
    var string = $.trim(window.location.pathname);
    $.each(string.split('/'), function( key, value ) {
        if (value == ""){

        }
        else {
            var val = value.toUpperCase();
            $("a:contains(" + val + ")").css("background-color","rgba(28, 143, 175, 1)");
            $("a:contains(" + val + ")").css("color" , "white");
            //$("ul:contains(" + val + ")").removeClass();
            //$("ul:contains(" + val + ")").addClass( "static-sliding" );

        }
    });
