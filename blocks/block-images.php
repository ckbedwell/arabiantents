<?php
function blockImages()
{
  $imagesPerRow = get_sub_field('images_per_row');
  $ratio = get_sub_field('aspect_ratio');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createImages($imagesPerRow, $ratio);

  return blockWrapper($container, $classes, $blockContent);
}

function createImages($imagesPerRow, $ratio)
{
  ob_start();
?>
  <div class="grid-<?= $imagesPerRow; ?> grid-2-t grid-1-m gap-3 cta-blocks">
    <?
      while(have_rows('image_blocks')) : the_row();
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        $image = get_sub_field('image');
        $src = $image['url'];
        $height = $ratio ? $ratio['height'] : $image['height'];
        $width = $ratio ? $ratio['width'] : $image['width'];
        $link = get_sub_field('link');

        echo createCtaBlock($title, [
          'desc' => $description,
          'img' => $src,
          'href' => $link,
        ], [$width, $height]);
      endwhile;
    ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  return $output;
}
?>