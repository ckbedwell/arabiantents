<?
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

$page = get_page_by_title('Where we work');
$pageID = $page->ID;
$featuredImage = get_the_featured_image($pageID)["full_url"];
get_header(); ?>


		<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
            <header class="row-padding full-slider  entry-header ">
                <div class="featured-image">
                    <div class="owl-carousel main-slider">

                            <div class="item"><div class="main-slider__image" style="background-image: url('<?= $featuredImage; ?>')"></div></div>
                    </div>
                </div>
                <noscript>
                    <div class="featured-image" style="background-image: url(<?= $featuredImage; ?>);"></div>
                </noscript>
                <button class="pinterest-btn" onclick="window.open('//pinterest.com/pin/create/link/?url=<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&media=<?= $featuredImage; ?>&description=<?= get_the_excerpt(); ?>','_blank','resizable=yes'); event.stopPropagation(); event.preventDefault();">Save</button><div class="height-filler"></div>
                <div class="vertical-align full">
                    <div >
                        <div class="left-header-side alignleft">
                            <h1 class="entry-title">Where we work</h1>
                            <p><?= get_the_excerpt($pageID); ?></p><?/*
                            <a class="white-button clickable" href="#scrollto-entry-content">See where we work</a>*/?>
                        </div>
                    </div>
                </div>
            </header>
            <!-- <header class="row-padding full-bg-header entry-header">
                <div class="featured-image" data-bg="<?= $featuredImage; ?>"></div>
                <noscript>
                    <div class="featured-image" style="background-image: url(<?= $featuredImage; ?>);"></div>
                </noscript>
                <div class="height-filler"></div>
                <div class="vertical-align full">
                    <div class="width-contain">
                        <div class="alignleft width-contain-700">
                            <h1 class="entry-title">Where we work</h1>
                            <p><?= get_the_excerpt($pageID); ?></p>
                            <a class="white-button clickable" href="#scrollto-entry-content">See where we work</a>
                        </div>
                    </div>
                </div>
            </header> -->

            <div class="parent-contain scrollto-padding" id="scrollto-entry-content">

                <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

                <section class="parent-contain">

                    <div class="width-contain center-items text-center photographers">
                        <? while (have_posts()) : the_post(); ?>
                            <div class="quarter">
                                <?
                                    $featuredImage = get_field('term_image', $post->ID);
                                ?>
                                <a class="full" href="<? the_permalink(); ?>">
                                    <img class="full" data-src="<?= $featuredImage; ?>">
                                    <noscript>
                                        <img class="full" src="<?= $featuredImage; ?>">
                                    </noscript>
                                </a>
                                <h2><? the_title(); ?></h2>

                            </div>
                        <? endwhile; ?>
                    </div>
                </section>
                <? include(locate_template('/partials/cta.php')); ?>
            </div>

            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
            </footer>
        </main>
<? get_footer(); ?>