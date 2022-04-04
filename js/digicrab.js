jQuery(document).ready(function ($) {
  var min816 = matchMedia("(min-width: 816px)");
  var min1000 = matchMedia("(min-width: 1000px)");
  var min960 = matchMedia("(min-width: 960px)");

  magnific();
  /*********** GET PARENT FORM ON SUBMIT BUTTON ************/

  function fieldViaParent(field, id) {
    var field = jQuery(field).closest("form").attr("ID");
    var field = "#" + field;
    return jQuery(field).find(id);
  }

  /********* VALIDATORS AND RETURNING ERRORS **********/

  function isValid(field, error) {
    jQuery(field).removeClass("error").addClass("valid");
    jQuery(field).parent().children(".error-message").remove();
    return true;
  }

  function hasError(field, error, submit) {
    jQuery(field).removeClass("valid").addClass("error");
    if (
      submit == true &&
      !jQuery(field).parent().children(".error-message").length
    ) {
      jQuery(field)
        .parent()
        .append("<p class='full error-message'>" + error + "</p>");
    }
    return false;
  }

  function fieldValidator(field, error, submit) {
    if (jQuery(field).val().length) {
      return isValid(field, error);
    } else {
      return hasError(field, error, submit);
    }
  }

  /***************** EMAIL VALIDATOR ********************/

  function isValidEmailAddress(email) {
    var pattern =
      /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
  }

  /********** FORM VALIDATING FUNCTIONS *******************/

  function noEvent(field) {
    var error = "You haven't chosen an event type.";
    var id = ".event-field";
    var submit = true;
    var field = fieldViaParent(field, id);
    var buttons = jQuery(field).find("input:checked");
    if (jQuery(id).is(":visible")) {
      //IF IS PRESENT
      if (jQuery(buttons).length > 0) {
        jQuery(field).removeClass("error").addClass("valid");
        jQuery(field).find(".error-message").remove();
        return true;
      } else {
        jQuery(field).removeClass("valid").addClass("error");
        if (submit == true && !jQuery(field).find(".error-message").length) {
          jQuery(field)
            .find(".five-sixths")
            .append("<p class='full error-message'>" + error + "</p>"); //FIVE SIXTHS SELECTOR COULD BE AN ISSUE
        }
        return false;
      }
    } else {
      return true;
    }
  }

  //

  function noGuests(field) {
    var error = "You haven't any guests.";
    var id = "#field_total_guests";
    if (!jQuery(field).is(id)) {
      var submit = true;
      var field = fieldViaParent(field, id); //RETURNS
    }

    if (jQuery(field).val().length && jQuery(field).val() > 0) {
      return isValid(field, error);
    } else {
      return hasError(field, error, submit);
    }
  }

  //

  function moreDiners(field) {
    var error = "You can't have more diners than total guests.";
    var id = "#field_dining_guests";
    var submit = true;
    if (!jQuery(field).is(id)) {
      var submit = true;
      var field = fieldViaParent(field, id);
    }

    var totalGuests = parseInt(
      jQuery(field).closest("form").find("#field_total_guests").val(),
      10
    );
    var diningGuests = parseInt(jQuery(field).val(), 10);

    if (jQuery(field).is(":visible")) {
      // IF IS PRESENT
      if (isNaN(diningGuests)) {
        jQuery(field).val("0");
        var diningGuests = parseInt(jQuery(field).val(), 10);
      }

      if (diningGuests <= totalGuests) {
        return isValid(field, error);
      } else {
        return hasError(field, error, submit);
      }
    } else {
      return true;
    }
  }

  //

  function noName(field) {
    var error = "Please fill in your name.";
    var id = "#field_name";
    if (!jQuery(field).is(id)) {
      var submit = true;
      var field = fieldViaParent(field, id);
    }
    if (jQuery(field).is(":visible")) {
      // IF IS PRESENT
      return fieldValidator(field, error, submit);
    } else {
      return true;
    }
  }

  //

  function noEmail(field) {
    var error = "Please fill in your email.";
    var id = "#field_email";
    if (!jQuery(field).is(id)) {
      var submit = true;
      var field = fieldViaParent(field, id);
    }

    if (isValidEmailAddress(jQuery(field).val())) {
      return isValid(field, error);
    } else {
      return hasError(field, error, submit);
    }
  }

  function noDate(field) {
    var error = "Please tell us about your date.";
    var id = "#field_date";
    if (!jQuery(field).is(id)) {
      var submit = true;
      var field = fieldViaParent(field, id);
    }
    if (jQuery(field).closest(".hidden-fields").find("input").is(":checked")) {
      if (
        jQuery(field)
          .closest(".hidden-fields")
          .find(".show_option")
          .is(":checked")
      ) {
        return fieldValidator(field, error, submit);
      } else {
        return true;
      }
    } else {
      return fieldValidator(field, error, submit);
    }
  }

  function noMessage(field) {
    var error = "Please fill in your message.";
    var id = "#field_message";
    if (!jQuery(field).is(id)) {
      var submit = true;
      var field = fieldViaParent(field, id);
    }

    if (jQuery(field).is(":visible")) {
      //IF IS PRESENT
      if (jQuery(field).closest(".hidden-fields").find(".show_option").length) {
        if (
          jQuery(field)
            .closest(".hidden-fields")
            .find(".show_option")
            .is(":checked")
        ) {
          return fieldValidator(field, error, submit);
        } else {
          return true;
        }
      } else {
        return fieldValidator(field, error, submit);
      }
    } else {
      return true;
    }
  }

  /*******************************/

  jQuery(document).on("change", 'input[name="field_events"]', function () {
    noEvent(this);
  });

  jQuery(document).on("change", 'input[name="field_name"]', function () {
    noName(this);
  });

  jQuery(document).on(
    "change",
    'input[name="field_total_guests"]',
    function () {
      noGuests(this);
      moreDiners(this);
    }
  );

  jQuery(document).on(
    "change",
    'input[name="field_dining_guests"]',
    function () {
      moreDiners(this);
    }
  );

  jQuery(document).on("change", 'input[name="field_email"]', function () {
    noEmail(this);
  });

  jQuery(document).on("change", 'input[name="field_date"]', function () {
    noDate(this);
  });

  jQuery(document).on("change", 'textarea[name="field_message"]', function () {
    noMessage(this);
  });

  jQuery(document).on(
    "change",
    'input[type="checkbox"], input[type="radio"]',
    function () {
      jQuery(this)
        .parents(".hidden-fields")
        .children(".error-message")
        .remove();
      jQuery(this)
        .parents(".hidden-fields")
        .children(".error")
        .removeClass("error");
    }
  );

  // SUBMIT AND CONFIRM NAVIGATION

  //SUBMIT
  jQuery("input[type=submit]").prop("disabled", false);

  jQuery(document).on("click", "input[type=submit]", function (e) {
    // e.preventDefault(false);
    window.onbeforeunload = null;

    var form = jQuery(this).closest("form");
    var thanksLink = "/thank-you";
    var formType = jQuery(form).find('[name="which-form"]').val();
    var url = jQuery(form).find('[name="page-url"]').val();

    var name = jQuery(form).find("#field_name").val();
    var email = jQuery(form).find("#field_email").val();
    var telephone = jQuery(form).find("#field_telephone").val();
    var location = jQuery(form).find("#field_postcode").val();

    if (
      jQuery(this)
        .closest("form")
        .parents(".more-info-overlay")
        .hasClass("active") ||
      jQuery(this).closest("form").parents(".on-page-form").length > 0
    ) {
      // This is so that only forms with JS enabled get sent through in the mail function in /thank-you.php
      var input = document.createElement("input");
      input.name = "js-enabled";
      input.value = "js-enabled";
      input.readOnly = true;
      input.type = "hidden";

      // add the newly created element and its content into the DOM
      e.target.form.append(input);

      if (jQuery(this).closest("form").hasClass("small-form")) {
        if (noName(this) & noEmail(this) & noMessage(this)) {
          console.log("Quick Form: True");

          if (form.find(jQuery("input.token")).attr("value")) {
            jQuery(this).attr("val", "Submit..");
            var formObj = {
              action: "form_callback",
              data: form.find(jQuery(".token")).attr("value"),
            };
            console.log(formObj);
            console.log("ajax start");
            $.post(form_obj.ajax_url, formObj, function (data) {
              // console.log(data);
              if (data) {
                // console.log('AJAX success');
                console.log("succes recaptcha");
                // window.location.href = thanksLink;
                return true;
              } else {
                e.preventDefault(false);
                // console.log('AJAX error');
                alert("Sorry, Invalid recaptcha. Please, try again.");
                console.log("False 1");
                return false;
              }
            });
          } else {
            // window.location.href = thanksLink;
            return true;
          }
        } else {
          console.log("Quick Form: False");
          return false;
        }
      } else if (jQuery(this).closest("form").hasClass("furniture-form")) {
        if (noName(this) & noEmail(this)) {
          console.log("Furniture Form: True");

          if (form.find(jQuery("input.token")).attr("value")) {
            jQuery(this).attr("val", "Submit..");
            // e.preventDefault();
            var formObj = {
              action: "form_callback",
              data: form.find(jQuery(".token")).attr("value"),
            };
            console.log(formObj);
            console.log("ajax start");
            $.post(form_obj.ajax_url, formObj, function (data) {
              // console.log(data);
              if (data) {
                // console.log('AJAX success');
                console.log("succes recaptcha");
                // window.location.href = thanksLink;
                return true;
              } else {
                e.preventDefault(false);
                // console.log('AJAX error');
                alert("Sorry, Invalid recaptcha. Please, try again.");
                console.log("False 1");
                return false;
              }
            });
          } else {
            // window.location.href = thanksLink;
            return true;
          }
        } else {
          console.log("Furniture Form: False");
          return false;
        }
      } else if (jQuery(this).closest("form").hasClass("newsletter-form")) {
        /*window.location.href = thanksLink;*/
        return true;
      } else {
        if (
          noName(this) &
          noEvent(this) &
          noGuests(this) &
          moreDiners(this) &
          noEmail(this) &
          noDate(this) &
          noMessage(this)
        ) {
          console.log("True");

          if (form.find(jQuery("input.token")).attr("value")) {
            jQuery(this).attr("val", "Submit..");
            // e.preventDefault();
            var formObj = {
              action: "form_callback",
              data: form.find(jQuery(".token")).attr("value"),
            };
            console.log(formObj);
            console.log("ajax start");
            $.post(form_obj.ajax_url, formObj, function (data) {
              // console.log(data);
              if (data) {
                // console.log('AJAX success');
                console.log("succes recaptcha");
                // window.location.href = thanksLink;
                return true;
              } else {
                e.preventDefault(false);
                // console.log('AJAX error');
                alert("Sorry, Invalid recaptcha. Please, try again.");
                console.log("False 1");
                return false;
              }
            });
          } else {
            /*window.location.href = thanksLink;*/
            return true;
          }
        } else {
          console.log("False 2");
          return false;
        }
      }
    } else {
      return false;
    }
  });

  /******************************************************/

  jQuery(".hidden-fields input").click(function () {
    var field = jQuery(this).closest(".hidden-fields");
    if (jQuery(field).find(".show_option").is(":checked")) {
      jQuery(field).find(".option-box").removeClass("hide");
    } else {
      jQuery(field).find("label").removeClass("hide");
      jQuery(field).find(".option-box").addClass("hide");
    }

    if (jQuery(field).find("input:checked").length) {
      jQuery(field)
        .find("input[type=checkbox]:not(:checked) + label")
        .addClass("hide");
    } else {
      jQuery(field)
        .find("input[type=checkbox]:not(:checked) + label")
        .removeClass("hide");
    }
  });

  /******************************************************/

  function show_diners() {
    var totalGuests = jQuery("#field_total_guests");
    var totalGuestsVal = totalGuests.val();
    var parentForm = totalGuests.closest("form");
    if (totalGuestsVal > 0) {
      jQuery(parentForm).addClass("display-hidden"); // SHOW DINING GUESTS INPUT
    } else {
      jQuery(parentForm).removeClass("display-hidden");
    }
    return parentForm;
  }

  jQuery("#field_total_guests").on("change", function () {
    show_diners();
  });

  /*****************************************************/

  //GIVE FORMS DIFFERENT IDS
  jQuery("form").each(function (index) {
    var id = "form" + (parseInt(index) + 1);
    jQuery(this).attr("ID", id);
  });

  //SLICK - IMAGE GALLERY

  $(".slider-primary").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".slider-nav",
    infinite: false,
  });

  $(".slider-nav").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: ".slider-primary",
    centerMode: true,
    focusOnSelect: true,
    infinite: false,
    responsive: [
      {
        breakpoint: 960,
        settings: {
          slidesToShow: 3,
        },
      },
    ],
  });

  $(".slider-nav").click(function () {
    $("html").addClass("nav-up");
  });

  // ********************************************* OVERLAYS ***************************************** //

  function open_overlay() {
    $("html").addClass("active-overlay");
    $(".overlay").removeClass("hide").addClass("active");
    $(".message-reminder").addClass("hide");
  }

  function close_overlays() {
    $("html").removeClass("active-overlay active-nav-overlay");
    $('section[class*="-sub"]').removeClass("active"); //mega-menu
    $(".primary-menu .active").removeClass("active");
    $(".more-info-overlay").addClass("hide").removeClass("active");
    $(".overlay").removeClass("active").addClass("hide");
  }

  function go_back() {
    $(".tent-selection .tent-type").addClass("hide");
    $(".tent-selection .all-tent-types")
      .removeClass("hide")
      .addClass("fade-in");
  }

  //***** Tent Page More Info Overlay *****//

  $(document).on("click", ".tent-selection .all-tent-types a", function () {
    var target = "#" + $(this).attr("value");
    if ($(target).length) {
      $(".tent-selection .all-tent-types").addClass("hide");
      $(target).removeClass("hide").addClass("fade-in");
    }
  });

  $(document).on("click", ".tent-selection .go-back", function () {
    go_back();
  });

  $(".more-info, .more-info > a").click(function () {
    var activeOverlay = "." + $(this).attr("value");
    open_overlay();
    $(activeOverlay).removeClass("hide").addClass("active");
    return false;
  });

  //FEEDBACK FORM
  $(".newsletter-link a").attr("value", "newsletter-form");

  $(document).on("click", ".tent-selection .more-info", function () {
    var activeOverlay = "." + $(this).attr("value");
    close_overlays();
    open_overlay();
    $(activeOverlay).removeClass("hide").addClass("active");
    return false;
  });

  $(".quick-info").click(function () {
    return false;
  });

  $(".quick-info").hover(function () {
    var hoverBox = "." + $(this).attr("value");
    $(hoverBox).toggleClass("hide");
  });

  $(".overlay").click(function () {
    close_overlays();
  });

  $(document).keydown(function (e) {
    // ESCAPE key pressed
    if (!$("body").hasClass("mfp-zoom-out-cur") && e.keyCode == 27) {
      close_overlays();
      go_back();
    }
  });

  $(".close").click(function () {
    var This = $(this);
    close_overlays();
    $(This).parent().addClass("hide");
    go_back();
  });

  //Edit Link Button
  $(".edit-link a").addClass("black-button scale-five");

  //Image Link Class

  $("a.featured-image, a.lightbox-link")
    .filter(function () {
      return $(this).css("backgroundImage") != "";
    })
    .addClass("image-link");

  //Entry Header Heights Set

  $(".height-filler").each(function () {
    var $parent = $(this).parent().outerHeight();
    $(this).css("height", $parent);
  });

  /*************** SMOOTH SCROLLING ***************/

  $(function () {
    $('a[href^="#scrollto"]:not([href="#"])').click(function (event) {
      event.preventDefault();
      if (
        location.pathname.replace(/^\//, "") ==
          this.pathname.replace(/^\//, "") &&
        location.hostname == this.hostname
      ) {
        //CHECK SAME SITE
        var target = $(this.hash);
        target = target.length
          ? target
          : $("[name=" + this.hash.slice(1) + "]");
        if (target.length) {
          if (target.offset().top < $(document).scrollTop()) {
            //IF SCROLLING UP OFFSET BY 150px
            $("html,body").animate(
              {
                scrollTop: target.offset().top - 150,
              },
              500
            );
          } else {
            $("html,body").animate(
              {
                //IF SCROLLING DOWN NO OFFSET
                scrollTop: target.offset().top,
              },
              500
            );
          }
          return false;
        }
      }
    });
  });

  /*************** SELECT INPUT USING CHOSEN ***************/

  $(".chosen-select").chosen();

  /********** FEATURED IMAGE CAPTION STARTS GALLERY *****/

  $(".featured-image-caption").click(function () {
    $(".tiered-gallery a:first-of-type").click();
  });

  /*** ***/

  $(document).on("click", ".mobile-menu", function () {
    $(this).toggleClass("active");
    $("html").toggleClass("active-overlay");
    $(".main-navigation").toggleClass("active");
  });
}); //END READY

/********************************* MAGNIFIC *******************************************/
var magnific = function () {
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
};

/*************************** MASONRY **************************************/

jQuery(function () {
  var $container = jQuery(".masonry-grid");

  $container.imagesLoaded(function () {
    $container.masonry({
      itemSelector: ".masonry-item",
      isAnimated: true,
      animationOptions: {
        duration: 750,
        easing: "linear",
        queue: false,
      },
    });
  });
});

jQuery(document).ajaxComplete(function () {
  magnific();

  var $containerAjax = jQuery(".masonry-grid").masonry("reloadItems");

  $containerAjax.imagesLoaded(function () {
    $containerAjax.masonry({
      itemSelector: ".masonry-item",
    });
    jQuery(".masonry-item.vis-hide")
      .removeClass("vis-hide")
      .addClass("fade-in");
  });
});

/*************************** ADD CAMERA ICON TO POST IMAGES **************************************/

jQuery(".wp-caption-text").prepend('<span class="icon-camera"></span>');

/*************************** ADD SPAN TAGS TO BLOCKQUOTES **************************************/

jQuery(".entry-content blockquote p:first-of-type").wrap("<span></span>");

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

jQuery(".sticky-info .two-thirds .more-info").click(function () {
  var tag = document.createElement("script");
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName("script")[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
});
