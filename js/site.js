$( document ).ready(function() {
	var hero = $('#hero');
	var navbar = $('.b3-navbar');

	$('#scf_contact').addClass('wow shake');
  
  // change color of edition
  function hex2rgba(c, o){
    var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
    var matches = patt.exec(c);
    var rgba = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+","+ o +")";
    return rgba;
  }

  var color_code = $("#edition_color").val();
  var color_opacity = "0.2";
  rgba = hex2rgba(color_code, color_opacity);

  $("hr").each(function(){
    $(this).css("border-color", color_code);
  });
  $("body").css("border-color", color_code);
  $("#video-opacity").css("background-color", color_code).css("opacity", "0.3");
  $(".rubrica").each(function(){
    $(this).css("background", rgba);
  });

  // is mobile
  if (window.orientation !== undefined) {
    $("#player").remove();
    $("#video-opacity").css("opacity", "1");
  }

  $('.row').masonry({
    itemSelector: '.cat-item',
    columnWidth: 200
  });
  
});
