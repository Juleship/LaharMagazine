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

	//such library, wow
	wow = new WOW({
		offset: 150
	});
	wow.init();

	//scroll to id
	$(function() {
		$('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});

});