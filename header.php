<?

$htmlClasses = 'no-js';

if (isset($_GET['enquiry'])) {
  if ($enquiry = $_GET['enquiry']) {
    $htmlClasses =+ ' active-overlay';
  }
}

?>
<!DOCTYPE html>
<html
  <? language_attributes(); ?>
  class="<?= $htmlClasses ?> "
  id="html"
>

<? include(locate_template('/head.php')); ?>

<body <? body_class(); ?>>
  <? include(locate_template('/scaffold/site-header.php')); ?>