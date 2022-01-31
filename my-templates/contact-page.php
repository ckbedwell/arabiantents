<?
/*
 * Template Name: Contact Page
 * Description: Display the contact information on the website.
 */
?>
<? get_header(); the_post();?>
<? $args = [
    'type' => 'map',
    'width' => '100%', // Map width, default is 640px. Can be '%' or 'px'
    'height' => '100%', // Map height, default is 480px. Can be '%' or 'px'
    'zoom' => 14,  // Map zoom, default is the value set in admin, and if it's omitted - 14
    'marker' => true, // Display marker? Default is 'true',
    'marker_title' => '', // Marker title when hover
    'js_options' => [
        'scrollwheel' => false,
   ],
]; ?>

<main class="site-main contact-page" role="main">

    <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

    <div class="parent-contain" id="scrollto-entry-content"></div>
    <section class="entry-content parent-contain">
        <div class="width-contain">
            
            <div class="half">
                <?= do_shortcode(wpautop(get_the_content())); ?>
                <? if (is_active_sidebar('contact-details')) { dynamic_sidebar('contact-details'); } ?>
                <div class="contact-details">
	                <a id="directions">
                     <? $address = get_post_meta(get_the_ID(), 'address', true); ?>
                    <? echo str_replace(',', '<br/>', $address); ?>
                    <? $postcode = explode(',', $address); ?>
	                </a>
                    <div>
                        <what3words-address words="beauty.emphasis.continues"/>
                    </div>
                </div>
            </div>

            <div class="half on-page-form">
                <? get_template_part('partials/enquiry-forms/quick-form-1'); ?>
            </div>
            <img src="<?php echo get_the_post_thumbnail_url();  ?>" >
        </div>
    </section>

    <footer class="entry-footer">
      <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
    </footer>
</main>

<? get_footer(); ?>