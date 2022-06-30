<?
/*
* Template Name: Blocks Page
*/

$page_id = get_the_ID();
get_header();

$headerOptions = get_field('header_options');
$title = $headerOptions['header_title'];
$links = $headerOptions['links'];
$headerPosition = $headerOptions['header_position'];
$showBreadcrumbs = $headerOptions['show_breadcrumbs'];
?>

<main <? post_class('site-main home-page'); ?> role="main">
  <section class="sectioned">
    <?= createHeaderImage(postFeaturedImage($post), $title, $links, $headerPosition); ?>
    <? if ($showBreadcrumbs) {
      include(locate_template('/scaffold/breadcrumbs.php'));
    } ?>
  </section>

  <? if(have_rows('blocks')) : ?>
    <? while(have_rows('blocks')) : the_row(); ?>
      <?
        $block_type = get_row_layout();
        if ($block_type === 'text_column') echo blockTextColumns();
        if ($block_type === 'image') echo blockImage();
        if ($block_type === 'heading') echo blockHeading();
        if ($block_type === 'quote') echo blockQuote();
        if ($block_type === 'image_blocks') echo blockImages();
        if ($block_type === 'video') echo blockVideo();
        if ($block_type === 'weve_worked_with') echo blockWorkedWith();
        if ($block_type === 'testimonials') echo blockTestimonials();
        if ($block_type === 'image_gallery') echo blockImageGallery();
        if ($block_type === 'page_blocks') echo blockPageBlocks();
        if ($block_type === 'idea_blocks') echo blockIdeaBlocks();
        if ($block_type === 'event_management') get_template_part('partials/events-sub');
        if ($block_type === 'contact_form') get_template_part('partials/enquiry-forms/quick-form');
      ?>
    <? endwhile; ?>
  <? endif; ?>
  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>