<?
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

// $page = get_page_by_title('Product Gallery');
// $pageID = $page->ID;
// $featuredImage = get_the_featured_image($pageID)["full_url"];

get_header(); ?>
		<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
            <header class="row-padding wrapper small-header"><?/*
                <div class="featured-image" data-bg="<?= $featuredImage; ?>"></div>
                <noscript>
                    <div class="featured-image" style="background-image: url(<?= $featuredImage; ?>);"></div>
                </noscript>
                <div class="height-filler"></div>
                <div class="vertical-align full">
                    <div class="width-contain">
                        <div class="alignleft width-contain-700">
                            <h1 class="entry-title">Product Gallery</h1>
                            <p><?= get_the_excerpt($pageID); ?></p>
                            <a class="white-button clickable" href="#scrollto-entry-content">See our product gallery</a>
                        </div>
                    </div>
                </div>*/?>
                <div class="width-contain text-center">
                    <h1 class="entry-title">Furniture Gallery</h1>
                </div>
            </header>

            <div class="parent-contain scrollto-padding" id="scrollto-entry-content">
                <? if (function_exists('breadcrumbs')) {
                            breadcrumbs();
                            }
                        ?>
                <section class="parent-contain entry-content" id="scrollto-entry-content">
                    <div class="slider-contain">
                        <div class="text-center slider-primary">
                            <? while (have_posts()) : the_post(); ?>
                                <? if ( $featuredImage = get_field( 'term_image' ) ) : ?>
                                <div class="slide">
                                    <div class="full vertical-align">
                                        <div class="wrapper">
                                            <img src="<?= $featuredImage; ?>" alt="Product photo">
                                            <a href="<? the_permalink(); ?>" class="alignright point-three-trans clickable featured-image-caption" title="Go to the <? the_title(); ?>">
                                            <span class="alignleft vertical-align icon-info"></span>
                                            <? the_title(); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <? endif; ?>
                            <? endwhile; rewind_posts(); ?>
                        </div>
                        <div class="row-padding-small slider-nav">
                        <?
                        if(have_posts()) :
                            while(have_posts()) : the_post();
                        ?>
                                <? if ( $featuredImage = get_field( 'term_image' ) ) : ?>
                                    <div class="slide">
                                    <div class="full display-card-small featured-image clickable" style="background-image: url(<?= $featuredImage; ?>);"></div>
                                    </div>
                                
                                <? endif; ?>
                            <? endwhile; endif; ?>
                        </div>
                    </div>
                </section>
                <? include(locate_template('/partials/cta.php')); ?>
            </div>

            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
            </footer>
        </main>
<? get_footer(); ?>