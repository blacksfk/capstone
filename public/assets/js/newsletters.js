$(document).ready(function(){
    $("#pdfLink").click(function(event){
        event.preventDefault();
        var link = $($(this)).prop('href');
        $("#pdfContainer").empty();
        var objectHtml = "<object width='100%' height='400' data='" + link + "'></object>";
        $("#pdfContainer").append(objectHtml);
    });
});