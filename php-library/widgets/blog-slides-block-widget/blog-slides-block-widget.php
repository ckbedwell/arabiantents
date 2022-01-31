<?

/******************************** WIDGET CLASS NAME **************************************/

	class digicrab_three_fifty_blocks_blog_slide_widget extends WP_Widget {


/**********************************CONSTRUCTOR ***************************************/

	function digicrab_three_fifty_blocks_blog_slide_widget() {
	       parent::WP_Widget(false, $name = 'Blog Slides Block Widget');
    	}

/****************************** INPUT FIELDS AND FRONT-END OUTPUT ****************************/

function widget($args, $instance) {
	    extract($args);


	echo $before_widget;

	wp_reset_query();

	$args = array(
		'post_type' => 'post',
		'category_name' => 'blog',
		'posts_per_page' => '1',
		'order' => 'DSC'
		);

	$recentPosts = new WP_Query($args);

	while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>

	<?
		$imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
		$featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
		$imgURL = $featuredImage[0]; //get the url of the image out of the array

	?>


	<a style="background-image: url(<?= $imgURL; ?>);" href="<? the_permalink(); ?>" " alt="<? the_title(); ?>" title="'<? the_title(); ?>"/>

	<div class="parent-contain">
		<div class="width-contain">
			<div class="widget-textarea">
		<h3 class="op-orange">The latest on our blog</h3>
		<?= $before_title; ?><? the_title();?><?= $after_title; ?>

		<p class="cta" href="<? the_permalink(); ?>">Read more</p>;

	</div></div></div></a>'
	<?= $after_widget; endwhile;


}

/********************************** @see WP_Widget::update *************************/
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['image'] = strip_tags($new_instance['image']);
	$instance['alttag'] = strip_tags($new_instance['alttag']);
	$instance['title'] = $new_instance['title'];
	$instance['textarea'] = $new_instance['textarea'];
	$instance['link'] = strip_tags($new_instance['link']);
	$instance['linktext'] = $new_instance['linktext'];

   return $instance;
    }

 /*********************************** @see WP_Widget::form ************************/
function form($instance) {

	$image = esc_attr($instance['image']);
	$alttag = esc_attr($instance['alttag']);
	$title = esc_attr($instance['title']);
	$textarea = esc_attr($instance['textarea']);
	$link = esc_attr($instance['link']);
	$linktext = esc_attr($instance['linktext']);

    ?>

	<p>
	<label for="<?= $this->get_field_id('image'); ?>"><? _e('Paste your <b>image link</b> here'); ?></label>
	<input class="widefat" id="<?= $this->get_field_id('image'); ?>" name="<?= $this->get_field_name('image'); ?>" type="text" value="<?= $image; ?>" />
	</p>

	<p>
	<label for="<?= $this->get_field_id('alttag'); ?>"><? _e('Alt and title attributes for this image'); ?></label>
	<input class="widefat" id="<?= $this->get_field_id('alttag'); ?>" name="<?= $this->get_field_name('alttag'); ?>" type="text" value="<?= $alttag; ?>" />
	</p>

	<p>
      	<label for="<?= $this->get_field_id('title'); ?>"><? _e('Widget Title'); ?></label>
      	<input class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= $title; ?>" />
    	</p>

   	<p>
    	<label for="<?= $this->get_field_id('textarea'); ?>"><? _e('This is a textarea:'); ?></label>
    	<textarea rows="20" class="widefat" id="<?= $this->get_field_id('textarea'); ?>" name="<?= $this->get_field_name('textarea'); ?>"><?= $textarea; ?></textarea>
    	</p>

	<p>
    	<label for="<?= $this->get_field_id('link'); ?>"><? _e('Paste the link for this block here:'); ?></label>
    	<input class="widefat" id="<?= $this->get_field_id('link'); ?>" name="<?= $this->get_field_name('link'); ?>" type="text" value="<?= $link; ?>" />
    	</p>

	<p>
    	<label for="<?= $this->get_field_id('linktext'); ?>"><? _e('What would you like the link text to say?'); ?></label>
    	<input class="widefat" id="<?= $this->get_field_id('linktext'); ?>" name="<?= $this->get_field_name('linktext'); ?>" type="text" value="<?= $linktext; ?>" />
    	</p>

    <?
}

}
/********************************** REGISTER THE WIDGET **********************/

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_blog_slide_widget");'));

