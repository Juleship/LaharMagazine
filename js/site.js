$( document ).ready(function() {
	var hero = $('#hero');
	var navbar = $('.b3-navbar');

	// set the hero 80% of the height of the viewport
	var heroHeight = ( document.documentElement.clientHeight - navbar.height() ) * 0.9;
	hero.height(heroHeight);

	$('#scf_contact').addClass('wow shake');

	//initialize parallax
	var isMobile = {
    Android: function() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };
  if( !isMobile.any() ){
    $.stellar({
     horizontalScrolling: false,
     positionProperty: 'transform',
     hideDistantElements: true
   });
  } else {
  	console.log('mobile');
  }
  
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
  
});
