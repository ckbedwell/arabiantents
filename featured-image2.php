<?
wp_reset_query();

/*
$readMore = get_post_meta($post->ID, 'read-more-text', true);
if(empty($readMore)) {
    if(is_singular('venue')) {
        $readMore = "See details";
    }

    elseif($isSingleTent) {
        $readMore = "See details";
    }

    elseif(is_tax('tent_type')) {
        $readMore = "See our tents";
    }

    elseif(is_tag()) {
        $readMore = "Get ideas";
    }

    else {
        $readMore = "Read more";
    }
}*/

$featuredImage = get_the_featured_image(get_the_ID());

if($isSingleTent) {
    $featuredImage = get_the_featured_image($postID);
}

$caption = $featuredImage['caption'];
$featuredImage = $featuredImage['full_url'];

$excerpt = get_the_excerpt();
$title = get_the_title();

$smallHeader = get_post_meta($post->ID, 'small-header', true);

    if($isSingleTent != true && (is_archive() || is_tag() || is_tax())) { //
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;

        $featuredImage = get_field('term_image', $taxonomy . '_' . $term_id);
        $title = $queried_object->name;
        $excerpt = get_field('term_excerpt', $taxonomy . '_' . $term_id);
    }

    if('caterer' === get_post_type()) {
        $featuredImage = $images[0]['url'];
    }

    if('location' === get_post_type() || 'product' === get_post_type()) {
        $excerpt = get_field('term_excerpt');
        $featuredImage = get_field('term_image');
    }
    ?>


    <? if($smallHeader == 1) : ?>
        <header class="row-padding wrapper small-header">
            <div class="width-contain text-center">
                <h1 class="entry-title"><? the_title(); ?></h1>
            </div>
        </header>
    <? else: ?>
        <div style="display: none">
            <?php print_r($featuredImage); ?>
        </div>
        <? if($featuredImage) : ?>
            <?php if ( get_field( 'featured_image_as_banner' ) ) : ?>
                <header class="row-padding full-slider  entry-header ">
                        

                    <div class="featured-image">
                        <div class="owl-carousel main-slider">

                        <?
                            echo  '<div class="item"><div class="main-slider__image" style="background-image: url(' . $featuredImage . ')"></div></div>';
                        ?>
                        </div>
                    </div>
                    <noscript>
                        <div class="featured-image" style="background-image: url(<?= $featuredImage; ?>);"></div>
                    </noscript>
                    <button class="pinterest-btn" onclick="window.open('//pinterest.com/pin/create/link/?url=<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&media=<?= $featuredImage; ?>&description=<?= get_the_excerpt(); ?>','_blank','resizable=yes'); event.stopPropagation(); event.preventDefault();">Save</button>
            <? else: ?>
            <header class="row-padding full-slider  entry-header ">
    
                <? $images = rwmb_meta('photos', 'type=image'); if(!empty($images)) : ?>
                    

                        <div class="featured-image">
                            <div class="owl-carousel main-slider">

                            <?
                                foreach ($images as $image) {

                                    echo   '<div class="item"><div class="main-slider__image" style="background-image: url(' . $image["full_url"] . ')"></div></div>';
                                }
                            ?>
                            </div>
                        </div>
                    
                    <? endif;?>
                <noscript>
                    <div class="featured-image" style="background-image: url(<?= $featuredImage; ?>);"></div>
                </noscript>
                <button class="pinterest-btn" onclick="window.open('//pinterest.com/pin/create/link/?url=<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&media=<?= $featuredImage; ?>&description=<?= get_the_excerpt(); ?>','_blank','resizable=yes'); event.stopPropagation(); event.preventDefault();">Save</button>
            <? endif;?>
        <? else : ?>
            <header class="row-padding wrapper entry-header">

        <? endif; ?>
                <div class="height-filler"></div>
                <div class="vertical-align full">
                        <div class="left-header-side alignleft ">
                            <? if($tour) { echo '<button class="material-card clickable point-three-trans js-only tour-available scroll-to-tour" data-bg="/wp-content/themes/arabiantents/images/interactive-tour-available.png" title="Take an interactive tour around the '. get_the_title() . '"></button>'; } ?>
                            <? if($taxonomy == 'post_tag') : ?>
                                <h4>Get ideas for your...</h4>
                            <? endif; ?>
                            <h1 class="entry-title"><?= $title; ?></h1>
                            <?

                            if ($isSingleTent) {
                             $terms = get_the_terms($postID , 'tent_type');
                             foreach($terms as $term) {
                                 echo '<h4>' . $term->name . '</h4>';
                                           // Get rid of the other data stored in the object, since it's not needed
                                 unset($term);
                             }
                         }
                         elseif ('venue' == get_post_type()) {
                            $terms = get_the_terms($post->ID , 'location');
                            foreach($terms as $term) {
                             echo '<h4>' . $term->name . '</h4>';
                                       // Get rid of the other data stored in the object, since it's not needed
                             unset($term);
                         }
                     }

                     elseif('caterer' == get_post_type()) {
                        echo '<h4>Caterer</h4>';
                    }

                    elseif ('post' == get_post_type() && !$taxonomy == 'post_tag') {
                        if(in_category('external-blogs')) {
                            echo '<div class="post-meta">';
                            echo '<span>' . get_field('website_name') . '</span>';
                        }
                        else {
                            echo '<div class="post-meta">';
                            author_image(get_the_author()->ID);
                            echo '<span>' . get_the_author_link() . '</span>';
                        }
                        published_date();
                        echo '</div>';
                    }

                    ?>



                    <?
                    if('caterer' === get_post_type()) { ?>
                    <? if(!empty($contactNumber)) : ?>
                     <p><strong>Phone Number:</strong> <?= $contactNumber; ?></p>
                 <? endif; ?>

                 <? if(!empty($email)) : ?>
                     <p><strong>Email:</strong> <a href="mailto:<?= $email; ?>"><?= $email; ?></a></p>
                 <? endif; ?>

                 <? if(!empty($website)) : ?>
                     <p><strong>Website:</strong> <a href="<?= $website; ?>" target="_blank"><?= $website; ?></a></p>
                 <? endif; ?>

                 <? }
                 else {
                    echo wpautop($excerpt);
                }
                ?>

                <?/* if(in_category('external-blogs') && !is_archive()) : ?>
                    <a href="<?= get_field('blog_url'); ?>" class="white-button clickable" target="_blank">Read the rest</a>
                <? else : ?>
                    <? if($featuredImage) : ?>
                        <a class="white-button clickable" href="#scrollto-entry-content"><?= $readMore; ?></a>
                    <? else: ?>
                        <a class="black-button clickable" href="#scrollto-entry-content"><?= $readMore; ?></a>
                    <? endif; ?>
                <? endif;*/ ?>
        </div>
    </div>
</header>
<? endif; //SMALL HEADER ?>