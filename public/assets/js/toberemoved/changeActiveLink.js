var link = "ul.nav a[href='" + window.location.href + "'";
$(link).parent().addClass("active");

if ($(link).parents("ul").hasClass("dropdown-menu")) {
    $(link).parents(".dropdown").addClass("active");
}

