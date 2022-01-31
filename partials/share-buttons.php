<?
wp_reset_postdata();
$featuredImage = get_the_featured_image($post->ID);

?>

    <ul class="text-center social-icons share-box">
        <li class="email-share share-btn" data-service="email">
            <a href="mailto:?subject=Arabian Tents Company: <?= get_the_title(); ?>&BODY=<? the_permalink(); ?>" target="_blank" title="Email to a friend">
                <span class="icon-envelop"></span>
            </a>
        </li>


        <li class="facebook share-btn" data-service="facebook">
            <a class="opener" href="https://www.facebook.com/sharer/sharer.php?u=<? the_permalink(); ?>" target="_blank" title="Share on Facebook">
                <span class="icon-facebook"></span>
            </a>
        </li>

        <li class="twitter share-btn" data-service="twitter">
            <div class="count"></div>
            <a class="opener" href="https://twitter.com/intent/tweet?url=<? the_permalink(); ?>" target="_blank" title="Tweet">
                <span class="icon-twitter"></span>
            </a>
        </li>
        <!---
        <li class="googleplus share-btn" data-service="google">
            <a class="opener" href="https://plus.google.com/share?url=<? the_permalink(); ?>" target="_blank" title="Share on Google+">
                <span class="icon-google-plus"></span>
            </a>
        </li>

        <li class="linkedin share-btn" data-service="linkedin">
            <div class="count"></div>
            <a class="opener" href="https://www.linkedin.com/shareArticle?mini=true&url=<? the_permalink(); ?>&title=<?= the_title(); ?>" target="_blank" title="Share on Linkedin">
                <span class="icon-linkedin"></span>
            </a>
        </li>
        ---->
        <li class="pinterest share-btn" data-service="pinterest">
            <a class="opener" href="http://pinterest.com/pin/create/button/?url=<? the_permalink(); ?>&media=<?= $featuredImage['full_url']; ?>&description=<?= the_title(); ?>" target="_blank" title="Pin it">
                <span class="icon-pinterest"></span>
            </a>
        </li>



        <script>
            jQuery(document).ready(function() {
                jQuery('.share-box .opener').click(function(e) {
                    e.preventDefault();
                    window.open(jQuery(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + (jQuery(window).height() / 2 - 275) + ', left=' + (jQuery(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
                    return false;
                    });
            });
        </script>
    </ul>

