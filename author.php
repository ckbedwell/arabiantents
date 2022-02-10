<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

$user = get_queried_object();
$authorID = $user->ID;
$name = $user->display_name;
$lowerCase = strtolower($name);
$jpegName = str_replace(" ", "-", $lowerCase);
$twitter = get_the_author_meta('twitter', $authorID);
$facebook = get_the_author_meta('facebook', $authorID);
$googleplus = get_the_author_meta('googleplus', $authorID);


get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <header class="row-padding archive-header about-the-author">
    <div class="width-contain">
      <div class="quarter text-center">
        <? if (!empty($jpegName)) : ?><img src="<?= get_template_directory_uri(); ?>/images/team-members/<?= $jpegName; ?>.jpg"><? endif; ?>
        <? if (!empty($twitter | $facebook | $googleplus)) : ?>
          <h5>Follow Me</h5>
          <ul class="social-icons">
            <? if (!empty($twitter)) : ?>
              <li><a href="https://twitter.com/<?= $twitter; ?>" title="Twitter"><span class="icon-twitter"></span></a></li>
            <? endif; ?>

            <? if (!empty($facebook)) : ?>
              <li><a href="<?= $facebook; ?>" title="Facebook"><span class="icon-facebook"></span></a></li>
            <? endif; ?>

            <? if (!empty($googleplus)) : ?>
              <li><a href="<?= $googleplus; ?>" title="Google Plus"><span class="icon-google-plus"></span></a></li>
            <? endif; ?>
          </ul>
        <? endif; ?>
      </div>

      <div class="three-quarters">
        <h1 class="entry-title"><? the_author_meta('display_name', $authorID); ?></h1>
        <h2><? the_author_meta('jobtitle', $authorID); ?></h2>
        <?

        $description = get_the_author_meta('description', $authorID);
        echo wpautop($description);
        ?>
        <? if (have_posts()) : ?>
          <a class="scale-five clickable black-button" href="#scrollto-entry-content">My posts</a>
        <? endif; ?>
      </div>
    </div>
  </header>

  <section class="parent-contain scrollto-padding" id="scrollto-entry-content">
    <? if (function_exists('breadcrumbs')) {
      breadcrumbs();
    }
    ?>

    <? if (have_posts()) : ?>
      <div class="width-contain row-padding">
        <div class="full">
          <? while (have_posts()) : the_post(); ?>
            <? get_template_part('excerpt', get_post_format()); ?>
          <? endwhile; ?>
        </div>
      </div>
    <? endif; ?>

  </section>

  <? include(locate_template('/partials/cta.php')); ?>
</main>

<? get_footer(); ?>