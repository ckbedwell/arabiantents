<?
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;

    $cta = get_field('cta_post');
    $image = get_field('specific_cta_image');

    if(is_tag() || is_tax('furniture_type')) {
        $cta = get_field('cta_post', $taxonomy . '_' . $term_id);
        $image = get_field('specific_cta_image', $taxonomy . '_' . $term_id);
    } elseif(is_singular('photographer') || is_post_type_archive(array('testimonial', 'press')) || is_author()) {
        $cta = get_post(2781); //framed tents
    } elseif(is_singular('venue')) {
        $cta = get_post(2790); //resources
    } elseif(is_category() || (is_singular('post') && empty($cta))) {
        $cta = get_post(2773); //newsletter
    }

    $ID = $cta->ID;
    $linkto = get_post_meta($ID, 'link-to', true);
    $buttonText = get_post_meta($ID, 'button-text', true);
    $featuredImage = get_the_featured_image($ID);
?>

<? if ($cta) { ?>
    <section class="parent-contain darkened-reader entry-content featured-image-parent-for-right call-to-action">
            <div class="featured-image" data-bg="<? if ($image) { echo $image; } else { echo $featuredImage['full_url']; } ?>"></div>
            <noscript>
                <div
                    class="featured-image"
                    style="background-image: url(<? if ($image) { echo $image; } else { echo $featuredImage['full_url']; } ?>);"
                ></div>
            </noscript>
            <div class="width-contain width-contain-750-mob">
                <div class="half on-page-form">
                    <h2><?= $cta->post_title; ?></h2>
                    <?= wpautop($cta->post_content); ?>

                    <? if ($ID == 2773) { ?>
                        <?= inc('/partials/enquiry-forms/newsletter-form.php'); ?>
                    <? } else { ?>
                        <a href="<?= $linkto; ?>" class="color-button clickable"><?= $buttonText; ?></a>
                    <? } ?>
                </div>
            </div>

    </section>
<? } ?>
