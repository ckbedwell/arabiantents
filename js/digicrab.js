jQuery(document).ready(function ($) {
  var min816 = matchMedia("(min-width: 816px)");
  var min1000 = matchMedia("(min-width: 1000px)");
  var min960 = matchMedia("(min-width: 960px)");

  magnific();
  enableForms();
}); //END READY

function enableForms() {
  document.querySelectorAll('form').forEach(form => {
    var input = document.createElement("input");
    input.name = "js-enabled";
    input.value = "js-enabled";
    input.readOnly = true;
    input.type = "hidden";

    form.append(input);
   })
}

/********************************* MAGNIFIC *******************************************/
function magnific() {
  jQuery(".gallery").each(function () {
    jQuery(this).magnificPopup({
      delegate: "a",
      type: "image",
      mainClass: 'mfp-with-zoom', // this class is for CSS animation below
      zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function
      },
      image: {
        titleSrc: "caption",
      },
      gallery: {
        enabled: true,
      },
    });
  });

  jQuery(".post-content").each(function () {
    jQuery(this).magnificPopup({
      delegate: "a[rel*=attachment]",
      type: "image",
      mainClass: 'mfp-with-zoom', // this class is for CSS animation below
      zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function
      },
      image: {
        titleSrc: "caption",
      },
      gallery: {
        enabled: true,
      },
    });
  });
};

/*************************** YOUTUBE API **************/

// https://developers.google.com/youtube/iframe_api_reference

// 2. This code loads the IFrame Player API code asynchronously.
/*
	  var tag = document.createElement('script');

	  tag.src = "https://www.youtube.com/iframe_api";
	  var firstScriptTag = document.getElementsByTagName('script')[0];
	  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
*/
// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player("player", {
    videoId: "b1--nJuvaY0",
    events: {
      onReady: onPlayerReady,
      onStateChange: onPlayerStateChange,
    },
  });
}

function onPlayerReady(event) {
  // bind events
  jQuery(".watch-video a").bind("click", function () {
    player.playVideo();
  });

  jQuery(".overlay, .close").bind("click", function () {
    player.pauseVideo();
  });

  jQuery(document).keydown(function (e) {
    // ESCAPE key pressed
    if (e.keyCode == 27) {
      player.pauseVideo();
    }
  });
}

function onPlayerStateChange(event) {
  if (event.data === 0) {
  }
}
