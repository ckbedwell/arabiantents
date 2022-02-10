<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */
$featuredImage = get_the_featured_image($post->ID);

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <article>
    <header class="archive-header about-the-author">
      <div class="vertical-align full">
        <div class="width-contain">
          <div class="quarter">
            <img class="rounded" data-src="<?= $featuredImage['full_url']; ?>">
            <noscript>
              <img class="rounded" data-src="<?= $featuredImage['full_url']; ?>">
            </noscript>
          </div>

          <div class="three-quarters">
            <h1 class="entry-title"><? the_title(); ?></h1>
            <h2>Photographer</h2>
            <? $officeNumber = rwmb_meta('photographer-office', 'type=text');
            if (!empty($officeNumber)) : ?>
              <p><strong>Phone Number:</strong> <?= $officeNumber; ?></p>
            <? endif; ?>

            <? $mobile = rwmb_meta('photographer-mobile', 'type=text');
            if (!empty($mobile)) : ?>
              <p><strong>Mobile:</strong> <?= $mobile; ?></p>
            <? endif; ?>

            <? $email = rwmb_meta('photographer-email', 'type=text');
            if (!empty($email)) : ?>
              <p><strong>Email:</strong> <a href="mailto:<?= $email; ?>"><?= $email; ?></a></p>
            <? endif; ?>

            <? $website = rwmb_meta('photographer-website', 'type=text');
            if (!empty($website)) : ?>
              <p><strong>Website:</strong> <a href="<?= $website; ?>" target="_blank"><?= $website; ?></a></p>
            <? endif; ?>

            <? $name = explode(' ', trim(get_the_title())); ?>
            <a class="scale-five clickable black-button" href="#scrollto-entry-content">About <?= $name[0]; ?></a>
          </div>
        </div>
      </div>
    </header>

    <div class="scrollto-padding" id="scrollto-entry-content">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      }
      ?>
      <section>
        <div class="width-contain">
          <div class="half">
            <? $question1 = rwmb_meta('photographer-q1', 'type=text');
            if (!empty($question1)) : ?>
              <div class="full">
                <h2>How did you get into photography?</h2>
                <?= $question1; ?>
              </div>
            <? endif; ?>

            <? $question2 = rwmb_meta('photographer-q2', 'type=text');
            if (!empty($question1)) : ?>
              <div class="full">
                <h2>How would you describe your style?</h2>
                <?= $question2; ?>
              </div>
            <? endif; ?>

            <? $question3 = rwmb_meta('photographer-q3', 'type=text');
            if (!empty($question1)) : ?>
              <div class="full">
                <h2>What is the best wedding you've ever shot?</h2>
                <?= $question3; ?>
              </div>
            <? endif; ?>

            <? $question4 = rwmb_meta('photographer-q4', 'type=text');
            if (!empty($question1)) : ?>
              <div class="full">
                <h2>What tip would you give to Brides and Grooms when choosing a photographer?</h2>
                <?= $question4; ?>
              </div>
            <? endif; ?>
          </div>

          <? $images = rwmb_meta('photos', 'type=image');
          if (!empty($images)) : ?>
            <div class="gallery half tiered-gallery">
              <h3><? the_title(); ?>'s Gallery</h3>
              <?
              foreach ($images as $image) {
                echo '<a class="lightbox-link" href="' . $image["full_url"] . '" caption="' . $image["caption"] . '">
                                        <div class="display-card-small featured-image point-five-trans" data-bg="' . $image["full_url"] . '"></div>
                                        <noscript>
                                             <div class="display-card-small featured-image point-five-trans" style="background-image: url(' . $image["full_url"] . ');"></div>
                                        </noscript>
                                        <button class="pinterest-btn" onclick="window.open(\'//pinterest.com/pin/create/link/?url=http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . '&media=' . $image['full_url'] . '&description=' . $image["caption"] . '\',\'_blank\',\'resizable=yes\'); event.stopPropagation(); event.preventDefault();">Save</button>
                                        </a>';
              }
              ?>

            </div>
          <? endif; ?>
        </div>
      </section>
    </div>

    <? include(locate_template('/partials/cta.php')); ?>

    <footer class="entry-footer">
      <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
    </footer>
  </article>
</main>
<? get_footer(); ?>