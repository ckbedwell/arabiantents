<?
    $image = get_post_meta(get_the_ID(), 'cta-image', true);
    ?>


<section class="parent-contain entry-content call-to-action" data-bg="<? if($image) { echo wp_get_attachment_image_url($image, 'full'); } else { echo '/wp-content/uploads/2015/07/display21-20140906195126_7_7-2_fused.jpg'; } ?>">
    <div class="width-contain">
        <div class="half">
            <h2>Have you seen our tent collection?</h2>
            <p>Our tents have been described by our clients as "a fairytale of warm, sumptuous colour" and they "transform every event they touch".</p>
            <a href="/tents" class="color-button clickable scale-ten">Take a look at our tents</a>
        </div>
    </div>
</section>

<noscript>
    <section class="parent-contain entry-content call-to-action" style="background-image: url(<? if($image) { echo wp_get_attachment_image_url($image, 'full'); } else { echo '/wp-content/uploads/2015/07/display21-20140906195126_7_7-2_fused.jpg'; } ?>);">
        <div class="width-contain">
            <div class="half">
                <h2>Have you seen our tent collection?</h2>
                <p>Our tents have been described by our clients as "a fairytale of warm, sumptuous colour" and they "transform every event they touch".</p>
                <a href="/tents" class="color-button clickable scale-ten">Take a look at our tents</a>
            </div>
        </div>
    </section>
</noscript>
