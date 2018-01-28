function centerAnswers() {
  var yPadding = 0;
  var ansBoxHeight = parseInt($(".ans-box").css("height"));
  var containerTextHeight =parseInt( $(".center-container").css("height"));
  var yPadding = (ansBoxHeight - containerTextHeight) / 2;
  $(".center-container").css("top", yPadding);
}

$(window).resize( function() {
  centerAnswers();
})

$(document).ready( function() {
  centerAnswers();
})
