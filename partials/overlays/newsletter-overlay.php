<!----- TENT SPECIFIC FORM ---->
<div class="more-info-overlay width-contain hide fade-in newsletter-form">
    <a class="icon-cross close" title="Close Newsletter Form"><span>Close</span></a>
    <?
        $ID = 2773;
        $featuredImage = get_the_featured_image($ID);
        ?>

    <section class="parent-contain darkened-reader entry-content featured-image-parent-for-right call-to-action">
        <div class="featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
        <div class="half vertical-align">
            <h2><?= get_the_title($ID); ?></h2>
            <?= get_post_field('post_content', $ID); ?>
            <? include(locate_template('/partials/enquiry-forms/newsletter-form.php')); ?>
        </div>

    </section>
</div>
