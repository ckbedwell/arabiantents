<?
/*
 * Template Name: Team Page
 * Description: Display all the Team Members on the website.
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <? include(locate_template('featured-image.php')); ?>
  <? if (function_exists('breadcrumbs')) {
    breadcrumbs();
  } ?>

  <section class="entry-content">
    <div class="width-contain">
      <?
      $args = array(
        'exclude' => array(1, 5, 15, 16, 22), // 1 = ckbedwell, 5 = Arabian Tents Editor, 15 = James Hubbard, 16 = Anita Constaintine, 22 = Artemis Marketing
        'order' => 'ASC',
        'meta_key' => 'order_number',
        'orderby' => 'meta_value_num',
        'number' => '-1',
      );

      $allUsers = get_users($args);

      foreach ($allUsers as $user) : ?>
        <?
        $authorID = $user->ID;
        $authorImage = get_userdata(get_query_var($author_ID = $authorID));
        $lowerCase = strtolower($user->display_name);
        $jpegName = str_replace(" ", "-", $lowerCase);
        ?>
        <div class="third team-member">
          <a href="<?= get_author_posts_url($authorID); ?>" class="aligncenter image-link">
            <img data-src="<?= get_template_directory_uri(); ?>/images/team-members/<?= $jpegName; ?>.jpg" height="465">
            <noscript>
              <img src="<?= get_template_directory_uri(); ?>/images/team-members/<?= $jpegName; ?>.jpg">
            </noscript>
          </a>
          <h2 class="text-center height-match"><?= $user->display_name; ?></h2>
          <h3 class="branding-color text-center"><?= $jobTitle = get_user_meta($user->ID, 'jobtitle', true); ?></h3>
          <div class="height-match-two"><? $description = $user->description;
                                        echo wpautop($description); ?></div>
          <a class="black-button aligncenter clickable" href="<?= get_author_posts_url($authorID); ?>">view profile</a>
        </div>


      <? endforeach; ?>


    </div>
  </section>

  <? include(locate_template('/partials/cta.php')); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>