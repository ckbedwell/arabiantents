<script>
var data = { "count": 10785236, "photos": [

<? if (have_posts()) : ?>

    <? while (have_posts()) : the_post(); ?>
    <?

        $jsonpost["id"] = get_the_ID();
        $jsonpost["title"] = get_the_title();
        $jsonpost["url"] = apply_filters('the_permalink', get_permalink());
        $jsonpost["latlng"] = get_metadata('post', $jsonpost["id"], 'loc', true);
        $jsonpost["address"] = get_metadata('post', $jsonpost["id"], 'venue-address', true);
        $jsonpost["website"] = get_metadata('post', $jsonpost["id"], 'venue-website', true);
        $jsonpost["phone"] = get_metadata('post', $jsonpost["id"], 'venue-phone', true);
        $jsonpost["email"] = get_metadata('post', $jsonpost["id"], 'venue-email', true);
        $jsonpost["image_url"] = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
        echo json_encode($jsonpost, JSON_UNESCAPED_SLASHES);
        echo ', ';
    ?>

<? endwhile; endif; ?>
     ]}
</script>
