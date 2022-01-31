<!-- <? /*
    $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
    $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
    $imgURL = $featuredImage[0]; //get the url of the image out of the array
    $furniturePrice = rwmb_meta('furniture-price', $args = array('type=text'));
?>

        <a class="image-link lightbox-link masonry-item" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
            <img class="point-five-trans" src="<?= $imgURL; ?>">
            <div class="overlay-information">
                <h3><?= the_title(); ?></h3>
                <h5><?
                        if(!empty($furniturePrice)) {
                            if (rwmb_meta('from-prefix') == 1) {
                                echo 'From ';
                            }
                            echo '£' . $furniturePrice;
                        }
                    /*    $terms = get_the_terms($post->ID , 'furniture_type');
                        foreach($terms as $term) {
                            echo '<a class="taxonomy" href="/furniture-decoration/' . $term->slug . '"><h4>' . $term->name . '</h4></a>';
                            unset($term);
                            }
                    */
                    ?>

            </div>
        </a>
