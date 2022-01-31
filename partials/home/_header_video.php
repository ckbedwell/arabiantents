<div class="home-slider darkened-reader-radial">
    <div class="featured-image video">
    <video id="bg" autoplay loop muted poster="<?= wp_get_attachment_url(get_post_meta($page_id, "video-cover", true)); ?>" name="media">
        <source src="<?= wp_get_attachment_url(get_post_meta($page_id, "video", true)); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    </div>
</div>