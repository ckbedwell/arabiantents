<?
/*
 * Template Name: Gallery Page
 * Description: Gallery page
 */

get_header();
$images = get_field('image_gallery');
?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <? include(locate_template('featured-image.php')); ?>

  <? if (function_exists('breadcrumbs')) {
    breadcrumbs();
  } ?>

  <section class="parent-contain entry-content" id="scrollto-entry-content">
    <div class="slider-contain">
      <div class="text-center slider-primary">
        <?
        if ($images) {
          foreach ($images as $image) :
            $parent = get_post_ancestors($image['ID']);
            $parentID = $parent[0];
            $parentTitle = get_the_title($parentID);
        ?>
            <div class="slide">
              <div style="display: none;"><? print_r($parent); ?></div>
              <div class="full vertical-align">
                <div class="wrapper">
                  <img src="<?= $image["url"]; ?>">
                  <? if ($caption) : ?>
                    <span class="alignleft point-three-trans clickable featured-image-caption">
                      <span class="alignleft vertical-align icon-camera"></span>
                      <?= $image['caption']; ?>
                    </span>
                  <? endif; ?>
                  <a href="<? the_permalink($parentID); ?>" class="alignright point-three-trans clickable featured-image-caption" title="Go to the <?= $parentTitle; ?>">
                    <span class="alignleft vertical-align icon-info"></span>
                    <?= $parentTitle; ?>
                  </a>
                </div>
              </div>
            </div>

        <? endforeach;
        }
        ?>



      </div>

      <div class="row-padding-small slider-nav">
        <?
        if ($images) :
          foreach ($images as $image) :
        ?>

            <div class="slide">
              <div class="full display-card-small featured-image clickable" style="background-image: url(<?= $image["url"]; ?>);"></div>
            </div>
        <? endforeach;
        endif; ?>
      </div>
    </div>
  </section>
  <? if (get_the_content()) : ?>
    <section class="parent-contain">
      <div class="width-contain">
        <?= do_shortcode(wpautop(get_the_content()));  ?>
      </div>
    </section>
  <?php endif; ?>
  <? include(locate_template('/partials/cta.php')); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>