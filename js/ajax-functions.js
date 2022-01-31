
jQuery(function($) {
	//Load posts on document ready
	var loading = '<div class="full loading-placeholder"><div class="full vertical-align thinking"><img class="aligncenter" src="/wp-content/themes/arabiantents/images/arabian-tents-logo.png"><p class="max-width-600 aligncenter">Thinking...</p></div></div>';

	var placholder = '<div class="full loading-placeholder"><div class="full vertical-align"><img class="aligncenter" src="/wp-content/themes/arabiantents/images/arabian-tents-logo.png"><p class="max-width-600 aligncenter">Give us some details above and we\'ll find the best layouts for your event.</p></div></div>'

	$(document).on('scroll', function() {
		if($('body').hasClass('loaded-ajax')) {

			}
		 else {
			furniture_get_posts();
			jQuery('body').addClass('loaded-ajax');
			}
		});

	//Main ajax function
	function furniture_get_posts() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)
		var postID = $('main').attr('id');
		var postTitle = $('.entry-header .entry-title').html();

		$.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'get_furniture',
				postID: postID,
				title: postTitle,
				},
			success: function(data) {
				$('.suggested .masonry-grid').html(data);
				var count = jQuery('.suggested .masonry-item').length;
				var countTotal =
				jQuery('.suggested .showing').text(count);

				},

			error: function() {
				//If an ajax error has occured, do something here...
				$(".suggested .width-contain").html('<p>There has been an error</p>');
				}
		});

		}

	// .on so that the event binds it to the ajax-loaded content
	$('body').on('click','.ajax-more-button',function(){
		furniture_get_more_posts();
		});

	//Load More
	function furniture_get_more_posts() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)
		var postID = jQuery('main').attr('id');
		var offset = jQuery('.masonry-grid').attr('items');
		var currentItems = jQuery('.masonry-grid').attr('items');
		var newItems = parseInt(currentItems, 10) + 10;
		jQuery('.masonry-grid').attr('items', newItems)
		jQuery('.ajax-more-button').addClass('loading-items');
		jQuery.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'get_more_furniture',
				postID: postID,
				offset: offset,
				},
			success: function(data) {
				jQuery('.masonry-grid').append(data).masonry('reload');
				jQuery('.ajax-more-button').removeClass('loading-items');
				},
			error: function() {
				alert('Something went wrong. Please reload the page and try again.')
				}
			});
		}


	/************************************** EVENT BUILDER FORM *******************************************************************/

	// STEP-THREE LAYOUTS
	$('.step-one input').change(function() {
		var input = $('.step-two input:checked');
		var checked = input.length;
		var frameChecked = $('.step-two input[tent=frame-tent-collection]:checked').length;
		var poleChecked = $('.step-two input[tent=pole-tents]:checked').length;

		if (checked > 0) {
			if (frameChecked > 0) {
					get_framed_layouts();
					}
			if (poleChecked > 0) {
					get_pole_layouts();
					}
			}
		});

	$('.step-two input').click(function() {

		// SHOWING SELECTED TENTS IN LAYOUTS

		//Framed Tents
		var selectedFramed = $('input[tent=frame-tent-collection]:checked').map(function () {
			return this.value;
			}).get()
		$('.framed-layouts .selected').text(selectedFramed.join(", "));

		//Pole Tents
		var selectedPole = $('input[tent=pole-tents]:checked').map(function () {
			return this.value;
			}).get()
		$('.pole-layouts .selected').text(selectedPole.join(", "));

		// DISPLAYING LAYOUTS CORRECTLY
		var input = $('.step-two input:checked');
		var checked = input.length;
		var frameChecked = $('.step-two input[tent=frame-tent-collection]:checked').length;
		var poleChecked = $('.step-two input[tent=pole-tents]:checked').length;

		var tentType = $(this).attr('tent');

		var framedTents = $('.step-three .framed-layouts');
		var framedResults = $('.step-three .framed-layouts .results');
		var poleTents = $('.step-three .pole-layouts');
		var poleResults = $('.step-three .pole-layouts .results');

		if (checked > 0) {
			if(tentType == 'frame-tent-collection') {
				console.log('Clicked a frame tent');
				if (frameChecked > 0) {
					if($(framedTents).hasClass('active')) {
						// DO NOTHING
						}
					else {
						$(framedTents).addClass('active')
						get_framed_layouts();
						}
					}
				else {
					$('.step-three .framed-layouts .error-message').remove();
					$(framedTents).removeClass('active');
					$(framedResults).html('');
					}
				}
			else if (tentType == 'pole-tents') {
				console.log('Clicked a pole tent');
				if(poleChecked > 0) {
					if($(poleTents).hasClass('active')) {
						// DO NOTHING
						}
					else {
						$(poleTents).addClass('active')

						get_pole_layouts();
						}
					}
				else {
					$('.step-three .pole-layouts .error-message').remove();
					$(poleTents).removeClass('active')
					$(poleResults).html('');
					}
				}
			}
		else {
			$('.step-three .error-message').remove();
			$(framedTents).removeClass('active');
			$(poleTents).removeClass('active');
			$(framedResults).html('');
			$(poleResults).html('');
			$('.loading-placeholder').removeClass('hide');

			console.log('Nothing Selected');
			}

		// Add line seperator if both active

		both_active();
		});

	/*function both_active () {
		var framedTents = $('.step-three .framed-layouts');
		var poleTents = $('.step-three .pole-layouts');
		var stretchTents = $('.step-three .stretch-layouts');
		if($(framedTents).hasClass('active') && $(poleTents).hasClass('active')) {
			$(framedTents).addClass('both-active');
			$(stretchTents).addClass('both-active');
			}
		else {
			$(framedTents).removeClass('both-active');
			}
		}
	*/
	function both_active() {
		var tentLayouts = $('.step-three .tent-layouts.active').length;
		jQuery(tentLayouts).each(function(i) {
			if (i > 0) {
				jQuery(this).addClass('both-active');
				}
			});


		}

	//GET FRAMED LAYOUTS
	function get_framed_layouts() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)
		var totalGuests = $('#field_total_guests').val();
		var diningGuests = $('#field_dining_guests').val();

		$('.step-two .error-message').remove(); // REMOVE ERROR IF SUBMIT RETURNED THEM
		$('.step-three .loading-placeholder').addClass('hide');
		$('.step-three .two-thirds .framed-layouts .results').html(loading);

		jQuery.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'get_framed_layouts',
				totalGuests: totalGuests,
				diningGuests: diningGuests,
				},
			success: function(data) {
				console.log(data);
				$('.step-three .framed-layouts').addClass('active')
				$('.step-three .two-thirds .framed-layouts .results').html(data);
				both_active();
				quote_bar();
				},
			error: function() {
				alert('Something went wrong. Please reload the page and try again.')
				}
			});
		}

	//GET POLE LAYOUTS

	function get_pole_layouts() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)
		var totalGuests = $('#field_total_guests').val();
		var diningGuests = $('#field_dining_guests').val();

		$('.step-two .error-message').remove(); // REMOVE ERROR IF SUBMIT RETURNED THEM
		$('.step-three .loading-placeholder').addClass('hide');
		$('.step-three .two-thirds .pole-layouts .results').html(loading);

		jQuery.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'get_pole_layouts',
				totalGuests: totalGuests,
				diningGuests: diningGuests,
				},
			success: function(data) {
				console.log(data);
				$('.step-three .pole-layouts').addClass('active')
				$('.step-three .two-thirds .pole-layouts .results').html(data);
				both_active();
				quote_bar();
				},
			error: function() {
				alert('Something went wrong. Please reload the page and try again.')
				}
			});
		}

	/*****************************************/

	$('a[value="event-selection"]').on('click', function() {
		if(!$('html').hasClass('loaded-event-forms')) {
			event_contact_overlay();
			}
		});

	//Main ajax function
	function event_contact_overlay() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)

		$.ajax({
			url: ajax_url,

			data: {
				action: 'events_contact_overlay',
				},
			success: function(data) {
				console.log(data);
				$('.ajax-event-enquiry-load').append(data);
				$('.ajax-event-enquiry-load .load-screen').addClass('hidden');
				$('html').addClass('loaded-event-forms');
				},

			error: function() {
				//If an ajax error has occured, do something here...
				$(".ajax-event-enquiry-load").html('<p>There has been an error</p>');
				}
		});

		}


	/*****************************************/

	$('a[value="tent-selection"]').on('click', function() {
		if(!$('html').hasClass('loaded-tent-forms')) {
			tent_contact_overlay();
			}
		});

	//Main ajax function
	function tent_contact_overlay() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)

		$.ajax({
			url: ajax_url,

			data: {
				action: 'tents_contact_overlay',
				},
			success: function(data) {
				$('.ajax-tents-enquiry-load').append(data);
				$('.ajax-tents-enquiry-load .load-screen').addClass('hidden');
				$('html').addClass('loaded-tent-forms');
				},

			error: function() {
				//If an ajax error has occured, do something here...
				$(".ajax-tents-enquiry-load").html('<p>There has been an error</p>');
				}
		});

		}

	/*****************************************/

	$('a[value="venue-dressing-selection"]').on('click', function() {
		if(!$('html').hasClass('loaded-venue-dressing-forms')) {
			venue_dressing_contact_overlay();
			}
		});

	//Main ajax function
	function venue_dressing_contact_overlay() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)

		$.ajax({
			url: ajax_url,

			data: {
				action: 'venue_dressing_contact_overlay',
				},
			success: function(data) {
				console.log(data);
				$('.ajax-venue-dressing-enquiry-load').append(data);
				$('.ajax-venue-dressing-enquiry-load .load-screen').addClass('hidden');
				$('html').addClass('loaded-venue-dressing-forms');
				},

			error: function() {
				//If an ajax error has occured, do something here...
				$(".ajax-venue-dressing-enquiry-load").html('<p>There has been an error</p>');
				}
		});

		}

	/*****************************************/

	$('a[value="furniture-selection"]').on('click', function() {
		if(!$('html').hasClass('loaded-furniture-forms')) {
			furniture_contact_overlay();
			}
		});

	//Main ajax function
	function furniture_contact_overlay() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)
		var pageURL = window.location.href;
		$.ajax({
			url: ajax_url,

			data: {
				pageURL: pageURL,
				action: 'furniture_contact_overlay',
				},
			success: function(data) {
				console.log(data);
				$('.ajax-furniture-enquiry-load').append(data);
				$('.furniture-selection .load-screen').addClass('hidden');
				$('html').addClass('loaded-furniture-forms');
				$('.chosen-select').chosen();
				},

			error: function() {
				//If an ajax error has occured, do something here...
				$(".ajax-furniture-enquiry-load").html('<p>There has been an error</p>');
				}
		});

		}

	/*****************************************/
	$(document).on('click', '.furniture-add', function() {
		$('.furniture-table .placeholder').remove();
		var furnitureItems = $(".chosen-select").val();
		if(furnitureItems !== null) {
			construct_furniture_form();
			disable_options(furnitureItems);
			$('.chosen-select').trigger("chosen:updated");
			}
		else {
			return false;
			}
		});

	/*************** REMOVE SELECTED ITEMS FROM FURNITURE TABLE ***************/

	$(document).on('click', '.furniture-table .icon-cross', function() {
		var furnitureItem = jQuery(this).closest('tr');
		var id = $(furnitureItem).attr('value');
		$('.chosen-select').find('option[value="' + id + '"]').prop('disabled', false);
		$('.chosen-select').trigger("chosen:updated");

		$(furnitureItem).addClass('being-removed');
		setTimeout(function() {
			$(furnitureItem).remove();
			$('.edgefix').focus(); // IF THIS ISN'T FOCUSSED IT WON'T LET YOU CLICK ON ANYTHING
			}, 750)
		});

	/**************************************/

	function disable_options(furnitureItems) {
		var length = $(furnitureItems).length;
		var $i = 0;
		while($i < length) {
			var id = furnitureItems[$i];
			$('.chosen-select').find('option[value="' + id + '"]').attr('disabled', 'disabled').removeAttr("selected");
			$i++;
			console.log(id);
			}
		}

	function construct_furniture_form() {
		var ajax_url = ajax_functions_params.ajax_url; //Get ajax url (added through wp_localize_script)
		var furnitureItems = $(".chosen-select").val();
		jQuery.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'construct_furniture_form',
				postIDs: furnitureItems,
				},
			success: function(data) {
				$('.furniture-table tbody').append(data);
				},

			error: function() {
				alert('Something went wrong. Please reload the page and try again.')
				}
			});
		}

});
