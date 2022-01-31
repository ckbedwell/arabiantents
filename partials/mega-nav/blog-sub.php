<?

?>

<section class="blog-sub">
    <div class="width-contain-1000">
        <div class="full no-padding additional-info">
			<div class="sub-menu-full">
                <div class="point-three-trans text-center">


                <?
                    $args = array(
                    'post_type' => 'post',
                    'category_name' => 'blog',
                    'posts_per_page' => '5',
                                      'orderby' => 'publish_date', 
                    'order' => 'DESC'
                   );

                    $recentPosts = new WP_Query($args);
                    $i = 0; // count so knows whether to show latest or date
                    while ($recentPosts->have_posts()) : $recentPosts->the_post();

                        $postURL = get_the_permalink($post->ID);
                        $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
                        $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
                        $imgURL = $featuredImage[0]; //get the url of the image out of the array
                        $blogTitle = get_the_title();
                        $blogTitle = strtolower($blogTitle);
                        $blogTitle = str_replace(" ", "-", $blogTitle);
                        if ($i == 0) {
                            $date = "Latest";
                            }
                        else {
                            $date = get_the_time('jS F Y');
                            }

                    ?>
                    
                        <? if(!empty($imgID)) : ?>

        
        
        <div class="fifth-margined no-padding">
                        <a href="<? the_permalink(); ?>" class="full display-card-small image-link " style="background-image: url(<?= $imgURL; ?>);"></a>
                        <span class="blog-truncate"><?php the_title(); ?></span>
        </div>
        
        
    <? endif; ?>
           
                    
                    
                <?/*<li data-submenu-id="submenu-<?= $blogTitle; ?>">
                    <span class="targeter"><a href="<?= $postURL; ?>"><? print_r($date); ?></a></span>
                    <a href="<?= $postURL; ?>" class="point-three-trans popover submenu-<?= $blogTitle; ?>" style="background-image: url(<?= $imgURL; ?>);">
                        <div class="width-contain-320 alignleft">
                            <h3>
                                <? if ($i == 0) : ?>
                                <strong class="branding-color">Latest:</strong>
                                <? endif; ?>
                                <?= the_title(); ?></h3>
                            <? the_excerpt();  $i++; ?>
                        </div>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>*/?>
                <? endwhile; wp_reset_postdata(); ?>
                 <a class="black-button" href="/blog">See all</a>
             </div>
     	</div>
    </div>
</section>