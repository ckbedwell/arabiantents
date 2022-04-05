<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

get_header();
$officeNumber = rwmb_meta('photographer-office', 'type=text');
$mobile = rwmb_meta('photographer-mobile', 'type=text');
$email = rwmb_meta('photographer-email', 'type=text');
$website = rwmb_meta('photographer-website', 'type=text');

$question1 = rwmb_meta('photographer-q1', 'type=text');
$question2 = rwmb_meta('photographer-q2', 'type=text');
$question3 = rwmb_meta('photographer-q3', 'type=text');
$question4 = rwmb_meta('photographer-q4', 'type=text');
$images = rwmb_meta('photos', 'type=image');
?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <h1 class="page-title"><? the_title(); ?></h1>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain">
    <?
    if (!empty($officeNumber)) : ?>
      <p><strong>Phone Number:</strong> <?= $officeNumber; ?></p>
    <? endif; ?>

    <?
    if (!empty($mobile)) : ?>
      <p><strong>Mobile:</strong> <?= $mobile; ?></p>
    <? endif; ?>

    <?
    if (!empty($email)) : ?>
      <p><strong>Email:</strong> <a href="mailto:<?= $email; ?>"><?= $email; ?></a></p>
    <? endif; ?>

    <?
    if (!empty($website)) : ?>
      <p><strong>Website:</strong> <a href="<?= $website; ?>" target="_blank"><?= $website; ?></a></p>
    <? endif; ?>
  </section>
  <section>
    <div class="width-contain">
      <div class="half">
        <?
        if (!empty($question1)) : ?>
          <div class="full">
            <h2>How did you get into photography?</h2>
            <?= $question1; ?>
          </div>
        <? endif; ?>

        <?
        if (!empty($question2)) : ?>
          <div class="full">
            <h2>How would you describe your style?</h2>
            <?= $question2; ?>
          </div>
        <? endif; ?>

        <?
        if (!empty($question3)) : ?>
          <div class="full">
            <h2>What is the best wedding you've ever shot?</h2>
            <?= $question3; ?>
          </div>
        <? endif; ?>

        <?
        if (!empty($question4)) : ?>
          <div class="full">
            <h2>What tip would you give to Brides and Grooms when choosing a photographer?</h2>
            <?= $question4; ?>
          </div>
        <? endif; ?>
      </div>

      <? if (!empty($images)) : ?>
        <section class="width-contain sectioned">
          <h3><? the_title(); ?>'s Gallery</h3>
          <?= inc('/partials/gallery.php', ['images' => $images]); ?>
        </section>
      <? endif; ?>
    </div>
  </section>
  </article>
</main>
<? get_footer(); ?>