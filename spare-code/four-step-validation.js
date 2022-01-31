/*******************************************************/


    function noGuests() {
        var totalGuests = jQuery('#field_total_guests').val();
        if(parseInt(totalGuests, 10) == 0 || totalGuests == '') {
            if(!jQuery('.step-one .error-message').length) {
                jQuery('.total-guests').append("<p class='full error-message'>You haven't any guests.</p>");
                }
            }
        else {
            jQuery('.total-guests .error-message').remove();
            return true;
            }
        }

    function more_diners() {
        var totalGuests = jQuery('#field_total_guests').val();
        var diningGuests = jQuery('#field_dining_guests').val();
        if (parseInt(totalGuests, 10) < parseInt(diningGuests, 10)) {
            if(!jQuery('.step-one .error-message').length) {
                jQuery('.dining-guests').append("<p class='full error-message'>You can't have more diners than total guests.</p>");
                }
            }
        else {
            jQuery('.dining-guests .error-message').remove();
            return true;
            }
        } // TOO MANY DINERS END

    function choose_tent() {
        var checked = jQuery('.step-two input:checked').length;
        if(checked == 0) {
            if(!jQuery('.step-two .error-message').length) {
                jQuery('.step-two .two-thirds').append("<p class='full error-message'>You haven't selected any tents.</p>");
                }
            }
        else {
            jQuery('.step-two .error-message').remove();
            return true;
            }
        } // END CHOOSE TENT

    function choose_framed_layout() {
        var exist = jQuery('.step-three .framed-layouts input').length;
        if (exist > 0) {
            var checked = jQuery('.step-three .framed-layouts input:checked').length;
            if(checked == 0) {
                if(!jQuery('.step-three .framed-layouts .error-message').length) {
                    jQuery('.step-three .framed-layouts').append("<p class='full error-message'>You haven't selected any frame tent layouts.</p>");
                    }
                }
            else {
                jQuery('.step-three .framed-layouts .error-message').remove();
                return true;
                }
            }
        else {
            return true;
            }
        } // END CHOOSE FRAME LAYOUT

    function choose_pole_layout() {
        var exist = jQuery('.step-three .pole-layouts input').length;
        if (exist > 0) {
            var checked = jQuery('.step-three .pole-layouts input:checked').length;
            if(checked == 0) {
                if(!jQuery('.step-three .pole-layouts .error-message').length) {
                    jQuery('.step-three .pole-layouts').append("<p class='full error-message'>You haven't selected any pole tent layouts.</p>");
                    }
                }
            else {
                jQuery('.step-three .pole-layouts .error-message').remove();
                return true;
                }
            }
        else {
            return true;
            }
        } // END CHOOSE POLE LAYOUT


    function dateError() {
        var date = jQuery('.step-four input[type=checkbox]');
        if(jQuery(date).is(':checked')) {
            if(jQuery('#field_date.active').val() == '' && !jQuery('.date-field .five-sixths .error-message').length) {
                jQuery('.date-field .five-sixths').append("<p class='full error-message'>Fill in your date.</p>");

                }
            else {
                return true;
                }
            }
        else {
            if(!jQuery('.date-field .five-sixths .error-message').length) {
                jQuery('.date-field .five-sixths').append("<p class='full error-message'>You haven't told us about your date.</p>");
                }
            }
        } // END DATE CHECKING ERROR

    function nameError() {
        var name = jQuery('.step-four #field_name');
        if(jQuery(name).val().length == '' && !jQuery('.name-field .five-sixths .error-message').length) {
            jQuery('.name-field .five-sixths').append("<p class='full error-message'>You haven't filled in your name.</p>");
            }
        else {
            return true;
            }
        }

    var email = jQuery('#field_email');
    function isValidEmailAddress(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email);
        } // END EMAIL VALIDATION

    function emailError() {
        if(isValidEmailAddress(email.val())) {
            jQuery('.email-field .error-message').remove();
            return true;
            }
        else {
            if(!jQuery('.email-field .error-message').length) {
                jQuery('.email-field .five-sixths').append("<p class='full error-message'>That's not a valid email address.</p>");
                }
            }
        } // END EMAIL ERROR

    function messageError() {
        var messageYes = jQuery('#message_yes');
        if(jQuery(messageYes).is(':checked')) {
            if(jQuery('#field_message').val() == '' && !jQuery('.message-field .five-sixths .error-message').length) {
                jQuery('.message-field .five-sixths').append("<p class='full error-message'>Write in your message or check no in the box above.</p>");
                }
            else {
                return true;
                }
            }
        else {
            jQuery('.message-field .error-message').remove();
            return true;
            }
        }

      function validateEvent() {
         if(noGuests() & more_diners() & choose_tent() & choose_framed_layout() & choose_pole_layout() & emailError() & dateError() & nameError() & messageError()) {
            // DO NOTHING
            }
         else {
            return false;
            }
        } //VALIDATE EVENT FORM ON SUBMIT

     jQuery('.step-one input').change(function() {
        more_diners();
        noGuests();
        });

    jQuery('.step-three input').change(function() {
        jQuery('.step-three .error-message').remove();
        });

    jQuery('.step-four .date-field input[type=checkbox]').change(function() {
        var checked = jQuery('.step-four .date-field input:checked').length;
        if (checked > 0) {
            jQuery('.date-field .five-sixths .error-message').remove();
            jQuery('.step-four .date-field input[type=checkbox]:not(:checked) + label').addClass('hide');
            if (jQuery('.show-date-box').is(':checked')) {
                jQuery('#field_date').removeClass('hide');
                jQuery('#field_date').addClass('active');
                }
            }
        else {
            jQuery('.step-four .date-field input[type=checkbox]:not(:checked) + label').removeClass('hide');
            jQuery('#field_date').addClass('hide');
            jQuery('#field_date').removeClass('active');
            }
        });

    jQuery('.step-four .date-field input').change(function() {
        jQuery('.date-field .five-sixths .error-message').remove();
        });

    jQuery('.step-four #field_name').change(function() {
        jQuery('.name-field .five-sixths .error-message').remove();
        });

    jQuery('.step-four #field_email').change(function() {
        emailError();
        });

    jQuery('.step-four input[type=radio]').change(function() {
        if(jQuery('.step-four #message_yes').is(':checked')) {
            jQuery('#field_message').removeClass('hide');
            }
        else {
            jQuery('.message-field .error-message').remove();
            jQuery('#field_message').addClass('hide');
            }
        });

    jQuery('.step-four #field_message').blur(function() {
        if(jQuery('.step-four #field_message').val().length > 0) {
            jQuery('.message-field .error-message').remove();
            }
        });

/*******************************/



jQuery('.quick-form #field_name').change(function() {
    if(jQuery(this).val().length == '' && !jQuery(this).hasClass('error')) {
            jQuery(this).removeClass('valid').addClass('error');
            }
    else {
        jQuery(this).removeClass('error').addClass('valid');
        }
    });

jQuery('.quick-form #field_email').change(function() {
    if(isValidEmailAddress(jQuery('.quick-form #field_email').val())) {
        jQuery(this).removeClass('error').addClass('valid');
        }
    else {
        jQuery(this).removeClass('valid').addClass('error');
        }
    });  // END EMAIL ERROR

jQuery('.quick-form #field_message').change(function() {
    if(jQuery(this).val().length == '') {
        jQuery(this).removeClass('valid').addClass('error');
        }
    else {
        jQuery(this).removeClass('error').addClass('valid');
        }
    });

jQuery('.quick-form input[type=submit]').on('click', function() {
    var form = jQuery(this).parents('form').attr('ID');
    var form = '#' + form;
    var email = jQuery(form).find('#field_email');
    console.log(form);
    console.log(email);
    if(jQuery(form).find('#field_name').hasClass('valid') && jQuery(form).find('#field_email').hasClass('valid') && jQuery(form).find('#field_message').hasClass('valid')) {
       return true;
       }
    else {
        jQuery(form).find('[id*="field_"]').each(function() {
            var This = jQuery(This);
            if(jQuery(this).val().length == '') {
                jQuery(this).addClass('error shake');
                }
            else if(jQuery(this).hasClass('error')) {
                jQuery(this).addClass('shake');
                }
            });


        setTimeout(function() {
            jQuery('.quick-form .shake').removeClass('shake');
            }, 400);
        return false;
        }

    });


/********************************************************************************************************************************************/


function quote_bar() {
    step_one();

    function step_one() {
        var height = parseInt(jQuery('.step-one').height(), 10);
        show_diners();
        var parentForm = show_diners();
        if(jQuery(parentForm).hasClass('display-hidden')) {
            jQuery('.step-one-track').addClass('complete');
            jQuery('.step-two-track').addClass('active');
            jQuery('.step-one .vertical-progress-bar').css('height', height + 100);
            }
        else {
            jQuery('.step-one-track').removeClass('complete');
            jQuery('.step-two-track').removeClass('active');
            jQuery('.step-three-track').removeClass('active');
            jQuery('.step-four-track').removeClass('active');

            jQuery('.step-one .vertical-progress-bar').css('height', 0);
            }
        step_two();
        } // END STEP ONE FUNCTION

    function step_two() {
        var height = parseInt(jQuery('.step-two').height(), 10);
        if (jQuery('.step-two input').is(':checked')) {
            jQuery('.step-two .error-message').remove(); // REMOVE ERROR IF SUBMIT RETURNED THEM
            jQuery('.step-two .vertical-progress-bar').css('height', height + 75);
            jQuery('.step-two-track').addClass('complete');

            if(jQuery('.step-one-track').hasClass('complete')) {
                jQuery('.step-three-track').addClass('active');
                }
            }
            else {
                jQuery('.step-two .vertical-progress-bar').css('height', 0);
                jQuery('.step-two-track').removeClass('complete');
                jQuery('.step-three-track').removeClass('active');
                }
        step_three();
        } // END STEP TWO FUNCTION

    function step_three() {
        var height = parseInt(jQuery('.step-three').height(), 10);
        var notStretch = jQuery('.step-two input[tent!=stretch-tents]');
        var count_not_checked = notStretch.filter(":checked").length;
        var stretchInput = jQuery('.step-two input[tent=stretch-tents]');

        if(jQuery('.step-two input').is(':checked')) {
            jQuery('.loading-placeholder').addClass('hide');
            if(jQuery(stretchInput).is(':checked')) { // SHOW STRETCH TENTS LAYOUT BOX
                jQuery('.stretch-layouts').removeClass('hide');
                jQuery('.stretch-layouts').addClass('active');
                }
            else {
                jQuery('.stretch-layouts').removeClass('active');
                jQuery('.stretch-layouts').addClass('hide');
                }

            if(jQuery(stretchInput).is(':checked') && count_not_checked == 0) { // COMPLETION BAR
                jQuery('.step-three-track').addClass('complete');
                if(jQuery('.step-three-track').hasClass('active')) {
                    jQuery('.step-four-track').addClass('active');
                    }
                jQuery('.step-three .vertical-progress-bar').css('height', height + 75);
                }
            else {
                jQuery('.step-three-track').removeClass('complete');
                jQuery('.step-four-track').removeClass('active');
                jQuery('.step-three .vertical-progress-bar').css('height', 0);
                }
            console.log('Not stretch ticked:' + count_not_checked);

            if(jQuery('.framed-layouts').hasClass('active') && jQuery('.pole-layouts').hasClass('active')) {
                jQuery('.step-three .tip-box').removeClass('hide');
                if(jQuery('.framed-layouts input').is(':checked')) {
                    jQuery('.step-three .framed-layouts .error-message').remove(); // REMOVE ERROR IF SUBMIT RETURNED THEM
                    var height = parseInt(jQuery('.step-three').height(), 10);
                    var height = height / 2;
                    jQuery('.step-three .vertical-progress-bar').css('height', height + 37);
                    }

                if(jQuery('.pole-layouts input').is(':checked')) {
                    jQuery('.step-three .pole-layouts .error-message').remove(); // REMOVE ERROR IF SUBMIT RETURNED THEM
                    var height = parseInt(jQuery('.step-three').height(), 10);
                    var height = height / 2;
                    jQuery('.step-three .vertical-progress-bar').css('height', height + 37);
                    }
                }

            else {
                jQuery('.step-three .tip-box').addClass('hide');
                }

            if(jQuery('.framed-layouts input').is(':checked') && jQuery('.pole-layouts input').is(':checked')) {
               jQuery('.step-three .tip-box').addClass('hide');
               }

            if(jQuery('.framed-layouts input').is(':checked') && jQuery('.pole-layouts input').is(':checked') ||
              jQuery('.framed-layouts input').is(':checked') && !jQuery('.pole-layouts').hasClass('active') ||
              jQuery('.pole-layouts input').is(':checked') && !jQuery('.framed-layouts').hasClass('active')
             ) {
               var height = parseInt(jQuery('.step-three').height(), 10);
                jQuery('.step-three .vertical-progress-bar').css('height', height + 75);
                jQuery('.step-three-track').addClass('complete');
                if(jQuery('.step-three-track').hasClass('active')) {
                    jQuery('.step-four-track').addClass('active');
                    }
               }
            else {

                }
            }
        else {
            jQuery('.step-three-track').removeClass('complete');
            jQuery('.step-four-track').removeClass('active');
            jQuery('.stretch-layouts').addClass('hide');
            jQuery('.stretch-layouts').removeClass('active');
            jQuery('.loading-placeholder').removeClass('hide');
            jQuery('.step-three .vertical-progress-bar').css('height', 0);
            }
         step_four();
        } // END STEP THREE FUNCTION

        function step_four() {
            var name = jQuery('.step-four #field_name');
            var email = jQuery('.step-four #field_email');
            var date = jQuery('.step-four input[type=checkbox]');
            var messageYes = jQuery('.step-four #message_yes');
            var messageNo = jQuery('.step-four #message_no');
            if(jQuery(name).val() !== '' && jQuery(email).val() !== '' && jQuery(date).is(':checked')) {
                if(isValidEmailAddress(email.val()) && jQuery('.step-four #field_date.active').val() != '') {
                    if(jQuery(messageYes).is(':checked') && jQuery('.step-four #field_message').val().length > 0) {
                        jQuery('.step-four-track').addClass('complete');
                        }
                    else if (jQuery(messageNo).is(':checked')) {
                        jQuery('.step-four-track').addClass('complete');
                        }
                    else {
                        jQuery('.step-four-track').removeClass('complete');
                        }
                    }
                else {
                        jQuery('.step-four-track').removeClass('complete');
                        }
                }
            else {
                jQuery('.step-four-track').removeClass('complete');
                }
            }

        jQuery('.step-one input').change(function() {
            step_one();
            });

        jQuery('.step-two input').on('click', function() {
            step_two();
            });

        jQuery('.step-three input').on('click', function() {
            step_three();
            });

        jQuery('.step-four input').change(function() {
            step_four();
            });

        jQuery('.step-four textarea').change(function() {
            step_four();
            });
        } // END QUOTE BAR FUNCTION

/*************************************************************************************************************************************/

function show_diners() {
        var totalGuests = jQuery('#field_total_guests');
        var totalGuestsVal = totalGuests.val();
        var parentForm = totalGuests.closest('form');
        console.log(parentForm);
        if(totalGuestsVal > 0) {
            jQuery(parentForm).addClass('display-hidden'); // SHOW DINING GUESTS INPUT
            }
        else {
            jQuery(parentForm).removeClass('display-hidden');
            }
        return parentForm;
        }

    jQuery('#field_total_guests').on('change', function() {
        show_diners();
        });


