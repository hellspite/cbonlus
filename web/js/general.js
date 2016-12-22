$(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('nav').addClass('smaller');
  } else {
    $('nav').removeClass('smaller');
  }
});
