<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

$contactNumber = get_field("contact_number");
$email = get_field("email_address");
$website = get_field("website_address");
$address = get_field("caterers_address");
$sampleMenu = get_field("sample_menu");
$averagePrice = get_field("average_price_per_head");
$glassHire = get_field("glass_and_or_plate_hire");
$staff = get_field("can_supply_staff");
$specialities = get_field("specialities");

$images = get_field("gallery");

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>
  <section class="width-contain sectioned">
    <h2 class="section-header">About <? the_title(); ?></h2>
    <? if ($address) : ?>
      Location: <?= $address; ?>
    <? endif; ?>
    <div>
      <? if (have_rows('sample_menu')) : ?>
        <? while (have_rows('sample_menu')) : the_row(); ?>
          <a href="<?= the_sub_field('link_to_pdf'); ?>" target="_blank" class="clearleft"><?= the_sub_field('download_title'); ?></a>
        <? endwhile; ?>
      <? endif;

      if ($averagePrice) : ?>
        <div>
          Average price £<?= $averagePrice; ?>
        </div>
      <? endif;

      if ($glassHire) : ?>
        <div>
          This caterer can supply glass hire.
        </div>
      <? endif;

      if ($staff) : ?>
        <div>
          This caterer can supply staff.
        </div>
      <? endif;

      if (have_rows("specialities")) : ?>
        <div>
          <h4>Specialities</h4>
          <ul>
            <?
            while (have_rows("specialities")) : the_row();
              echo "<li>" . get_sub_field("dish_name") . "</li>";
            endwhile;
            ?>
          </ul>
        </div>
      <? endif; ?>

    <section class="width-contain sectioned">
      <h2 class="section-header"><?= $section1Title; ?></h2>
      <?= createTextColumns(get_the_content()); ?>
    </section>

    <? if (!empty($images)) : ?>
      <section class="width-contain sectioned">
        <h3><? the_title(); ?>'s Gallery</h3>
        <?= inc('/partials/gallery.php', ['images' => $images]); ?>
      </section>
    <? endif; ?>
  </section>
</main>
<? get_footer(); ?>