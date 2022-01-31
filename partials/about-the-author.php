<section class="parent-contain">
    <div class="width-contain">
        <div class="about-the-author">
            <h3>About the author</h3>
            <div class="quarter text-center">
                <? author_image(get_the_author()->ID); ?>
                <? author_social_links(); ?>
            </div>

            <div class="three-quarters content-wrapper">
                <h2><? the_author_link(); ?></h2>
                <h3><? the_author_meta('jobtitle'); ?></h3>
                <?
                    $description = get_the_author_meta('description');
                    echo wpautop($description);
                ?>
                <a class="black-button scale-five clickable" href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" >More of my posts</a>
            </div>
        </div>
    </div>
</section>
