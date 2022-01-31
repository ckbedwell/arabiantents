<?php
/* Template Name: Test form */
// if ( isset($_POST['token']) && !empty($_POST['token']) ) {
//     $token = $_POST['token'];

//     if(!$token){
//         echo '<h2>Please check the the captcha form.</h2>';
//         exit;
//     }
//     $secretKey = "6LdNwaAUAAAAADLmP0bcJRmrV_ODJFjFJKYLFaUK";

//     // post request to server

//     $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($token);
//     $response = file_get_contents($url);
//     $responseKeys = json_decode($response,true);
//     print_r($responseKeys);
// //    exit;
// //    header('Content-type: application/json');
//     if($responseKeys["success"]) {
// //        echo json_encode(array('success' => 'true'));
//         echo 'SUCCESS';
//     } else {
// //        echo json_encode(array('success' => 'false'));
//         echo 'ERROR';
//     }
//     die();
// }

get_header(); ?>
<main class="site-main" role="main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdNwaAUAAAAAP67E_B1TpHZof9yrQeALoHpI0OM"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdNwaAUAAAAAP67E_B1TpHZof9yrQeALoHpI0OM', {action: 'homepage'}).then(function(token) {
                document.querySelector('input[name="token"]').value = token;
            });
        });

        (function($) {
            $(document).ready(function() {
                /*$('input[type="submit"]').click(function(e) {
                    e.preventDefault(false);
                    var response = $('input[name="token"]').attr('value'),
                        url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LdNwaAUAAAAADLmP0bcJRmrV_ODJFjFJKYLFaUK&response='+response;

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: '',
                        success: function (response) {
                            console.log(response);
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                    console.log('submit');
                });*/
            });
        })(jQuery);
    </script>
    <form method="post" action="">
        <input type="text" name="firstname">
        <input type="hidden" name="token">
        <button type="submit">Submit</button>
    </form>
</main>
<?php get_footer(); ?>