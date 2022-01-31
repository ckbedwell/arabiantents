/*
(function($) {

    // console.log('test');
    $(document).ready(function() {
        $("button#submit_results_clone").click( function() {
            var btn = $(this);
            btn.addClass('btn--loading');
            // e.preventDefault();
            var formObj = {
                action:     "form_callback",
                data:       $(this).parent().find(jQuery('.token')).attr('value')
            };
            // console.log(formObj);
            // console.log('ajax start');
            $.post( form_obj.ajax_url, formObj, function(data) {
                // console.log(data);
                if ( data ) {
                    // console.log('AJAX success');
                    $('input#submit_results').trigger('click');
                    console.log('succes recaptcha');
                } else {
                    // console.log('AJAX error');
                    alert('Sorry, Invalid recaptcha. Please, try again.');
                }
                btn.removeClass('btn--loading');
            });
        });
    });

})(jQuery);
*/