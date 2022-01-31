/*************** INFO BAR STICKY *************/
$(document).ready(function(){
	var min816 = matchMedia("(min-width: 816px)");
	var min1000 = matchMedia("(min-width: 1000px)");
	var min960 = matchMedia("(min-width: 960px)");

	if (!!$('.sticky-info').offset()) { // CHECK FOR STICKY ELEMENT ON PAGE
		var stickyElementHeight = $('.sticky-info').height(); // GET INFO BAR HEIGHT
		var windowHeight = $(window).height(); // GET WINDOW HEIGHT
		var stickyTop = $('.sticky-info').offset().top + stickyElementHeight - 41 // GETS POSITION OF TOP OF STICKY ELEMENT

		// scroll event
		$(window).scroll(function() {
			if(min960.matches) {
				var dropoffOffset = $('.drop-off').offset().top; // GET TOP LOCATION OF DROP-OFF CONTAINER
				var dropoffHeight = $('.drop-off').height(); // GET HEIGHT OF DROP-OFF CONTAINER
				var dropoffBottom = dropoffOffset + dropoffHeight; //GET BOTTOM LOCATION OF DROP-OFF CONTAINER
				var windowTop = $(window).scrollTop(); // GET HOW FAR WINDOW HAS SCROLLED (MEASURES FROM TOP OF SCREEN)

				if (stickyTop < windowTop) {
					$('button.lower-info').removeClass('hide');
					$('.sticky-info').addClass('stuck');

					if(!$('.sticky-info').hasClass('lowered')) {
						$('.sticky-info').addClass('move-up');
					}

					$('.info .height-filler').removeClass('hide');

					if(dropoffBottom < windowTop + windowHeight - stickyElementHeight) {
						$('.sticky-info').addClass('stuck-bottom');
					} else {
						$('.sticky-info').removeClass('stuck-bottom');
					}

				} else {
					$('.sticky-info').removeClass('stuck move-up');
					$('.info .height-filler').addClass('hide');
				}
			}
		});
	}
});
