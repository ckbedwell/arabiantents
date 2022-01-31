<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */
?>
<? get_header();

$page = get_page_by_title('Photographers');
$pageID = $page->ID;
$featuredImage = get_the_featured_image($pageID)["full_url"];
?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
    <header class="row-padding full-slider  entry-header full-bg-header">
        <div class="featured-image" data-bg="<?= $featuredImage; ?>">
            <? if ($caption) : ?>
                <span class="point-three-trans clickable featured-image-caption">
                    <span class="alignleft vertical-align icon-camera"></span>
                </span>
                <?= $caption; ?>
            <? endif; ?>
        </div>
        <div class="height-filler" style="height: 600px;"></div>
        <div class="vertical-align full">
            <div>
                <div class="left-header-side alignleft ">
                    <h1 class="entry-title">testimonial</h1>
                </div>
            </div>
        </div>
    </header>

    <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
    } ?>

    <section class="row-padding" id="scrollto-entry-content">
        <div class="width-contain">
            <div class="full intro">
                <?
                $count = $wp_query->post_count;
                echo '<p class="text-center">We currently have <strong>' . $count . '</strong> testimonials.</p>';
                ?>
            </div>
            <div class="row-padding-small masonry-grid">
                <? global $query_string; ?>
                <? query_posts($query_string . '&posts_per_page=11'); ?>
                <? if (have_posts()) { ?>
                    <? while (have_posts()) { ?>
                        <? the_post(); ?>
                        <article class="padded material-card masonry-item">
                            <div class="testimonial-entry">
                                <? the_title('<h2 class="excerpt-title">', '</h2>'); ?>

                                <div class="wrapper">
                                    <?= wpautop(get_the_content()); ?>
                                </div>
                            </div>
                        </article>
                    <? } ?>
                <? } ?>
            </div>
        </div>
    </section>

    <? include(locate_template('/partials/cta.php')); ?>

    <section class="parent-contain entry-content">
        <div class="width-contain">
            <div class="row-padding-small masonry-grid">
                <? query_posts($query_string . '&offset=11'); ?>
                <? if (have_posts()) { ?>
                    <? while (have_posts()) { ?>
                        <? the_post(); ?>

                        <article class="padded material-card masonry-item">
                            <div class="testimonial-entry">
                                <? the_title('<h2 class="excerpt-title">', '</h2>'); ?>

                                <div class="wrapper">
                                    <?= wpautop(get_the_content()); ?>
                                </div>
                            </div>
                        </article>
                    <? } ?>
                <? } ?>
            </div>
        </div>
    </section>
    <footer class="entry-footer">
        <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
    </footer>
</main>
<? get_footer(); ?>