$(function() {
	//if (!device.tablet() && !device.mobile()) {
		//$(".player").mb_YTPlayer();
		/*$("header").height($(window).height());*/
	//} else {
	//};

$('.my-background-video').bgVideo(
			{
					fadeIn: 500, 
					fullScreen: true, 
					showPausePlay: false, 
			}
	);

	$(".search-toggle").on("click", function(e) {
			e.preventDefault();
			$("body").addClass("enable-search");

	});
	$(".search-inner .search-toggle").on("click", function(e) {
			e.preventDefault();
			$("body").removeClass("enable-search");

	});
    
    
    
	$('.main-slider').owlCarousel({
    mouseDrag: true,
	animateOut: 'fadeOut',
	nav: true,
    items:1,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
    loop: true,
});	

$('.owl-partners').owlCarousel({
    mouseDrag: true,
	animateOut: 'fadeOut',
    items:5,
    autoplay:true,
    autoplayTimeout:4000,
    loop: true,
    dots: true,
    responsive:{
    0:{
        items:1,
    },
    600:{
        items:3,
    },
    1000:{
        items:5,
    }
}
});





	

});