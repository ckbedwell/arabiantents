<?
/**
 *
 * Template Name: Green Partners
 */

get_header();

?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

        <? include(locate_template('featured-image.php')); ?>

        <div class="entry-content dfs scrollto-padding barbara" id="scrollto-entry-content">
           <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section class="entry-content">
                <div class="width-contain">
                    <div class="width-contain-700 intro">
                        <?= do_shortcode(wpautop(get_the_content())); ?>
                    </div>
                </div>
            </section>
        
            <section class="parent-contain row-padding">
                <div class="width-contain">
                    <h2 class="text-center">Our recommended suppliers</h2>
                    <div class="row-padding-extra-small">
                        <?= inc('/partials/events/_grid_item.php', ['args' => [
                                'post_type' => 'page',
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'page-type',
                                        'field' => 'slug',
                                        'terms' => 'additional-service',
                                    ]
                                ]
                            ]
                        ]); ?>
                    </div>
                </div>
              </section>

              <? wp_reset_postdata(); ?>
        </div>
          <? while (have_rows("partner_group")) : the_row(); $title = get_sub_field('group_name'); ?>
            <section class="parent-contain row-padding">
              <div class="width-contain">
                <h2 class="text-center"><?php echo get_sub_field("group_name") ?></h2>
                  <?
                    while (have_rows("partners")) : the_row();
                    $partnerURL = get_sub_field('partner_link');
                    $image = get_sub_field('partner_image');
                  ?>
                  <a href="<?php echo $partnerURL; ?>" target="_blank" class="quarters-margined no-padding image-link">
                    <img data-src="<?php echo $image; ?>">
                    <noscript>
                        <img src="<?php echo $image; ?>">
                    </noscript>
                  </a>
                <?php endwhile; ?>
            </div>
          </section>
          <?php endwhile; ?>
        </div>



	<footer class="entry-footer">
		<? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	</footer>
    <? include(locate_template('/partials/cta.php')); ?>
</main>
<? get_footer(); ?>