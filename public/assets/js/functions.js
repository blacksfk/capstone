/*

This is the overall javascript file for the website. All functions should go here.

*/

// Dynamic carousel functions

var $item = $('.carousel .item');
var $wHeight = $(window).height();

$item.height($wHeight); 
$item.addClass('full-screen');

var $numberofSlides = $('.item').length;
var $currentSlide = Math.floor((Math.random() * $numberofSlides));

$('.carousel-indicators li').each(function(){
  var $slideValue = $(this).attr('data-slide-to');
  if($currentSlide == $slideValue) {
    $(this).addClass('active');
    $item.eq($slideValue).addClass('active');
  } else {
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


// changeActiveLink.js functions

var link = "ul.nav a[href='" + window.location.href + "'";
$(link).parent().addClass("active");

if ($(link).parents("ul").hasClass("dropdown-menu")) {
    $(link).parents(".dropdown").addClass("active");
}


// Newsletters display

$(document).ready(function(){
    $(".pdfLink").click(function(event){
        event.preventDefault();
        var link = $(this).prop('href');
        console.log(link);
        $("#pdfContainer").empty();
        var objectHtml = "<object width='100%' height='400' data='" + link + "'></object>";
        $("#pdfContainer").append(objectHtml);
    });
});

// FAQ page accordian

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}