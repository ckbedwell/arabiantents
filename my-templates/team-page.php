<?
/*
 * Template Name: Team Page
 * Description: Display all the Team Members on the website.
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <div class="grid-3 grid-2-t gap-3">
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
        $src = get_template_directory_uri() . "/images/team-members/" . $jpegName. ".jpg";
        $name = $user->display_name;
        $jobTitle = get_user_meta($user->ID, 'jobtitle', true);
        $description = $user->description;
        
        ?>
        <div class="team-member">
          <?= createImage($src, $name, 1.61, 1); ?>
          <h2 class="text-center">
            <?= $name ?>
          </h2>
          <h3 class="text-center">
            <?= $jobTitle; ?>
          </h3>
          <div class="">
            <?= wpautop($description); ?>
          </div>
        </div>
      <? endforeach; ?>
      </div>
  </section>
</main>
<? get_footer(); ?>