<div class="home-slider js-home-slider darkened-reader-radial">
    <? $slides = ["slide-image-one", "slide-image-two", "slide-image-three", "slide-image-four", "slide-image-five", "slide-image-six"] ?>
    <? foreach ($slides as $slide) { ?>
        <? $image = wp_get_attachment_url(get_post_meta($page_id, $slide, true)); ?>
        <? $caption = get_post(get_post_meta($page_id, $slide, true))->post_excerpt; ?>

        <? if ($image) { ?>
            <div class="slide featured-image" style="background-image: url(<?= $image; ?>);">
                <? if ($caption !== "") { ?>
                    <div class="wrapper">
                        <div class="width-contain">
                            <span class="point-three-trans clickable featured-image-caption">
                                <span class="alignleft vertical-align icon-camera"></span>
                                <?= $caption; ?>
                            </span>
                        </div>
                    </div>
                <? } ?>
            </div>
        <? } ?>
    <? } ?>
</div>
