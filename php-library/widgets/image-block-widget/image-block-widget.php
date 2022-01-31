<?


/******************************** WIDGET CLASS NAME **************************************/

	class digicrab_three_fifty_blocks_image_widget extends WP_Widget {


/**********************************CONSTRUCTOR ***************************************/

	function digicrab_three_fifty_blocks_image_widget() {
	       parent::WP_Widget(false, $name = 'Image Block Widget');
    	}

/****************************** INPUT FIELDS AND FRONT-END OUTPUT ****************************/

function widget($args, $instance) {
	    extract($args);

	// these are our widget options
	    	$image = $instance['image'];
		$alttag = $instance['alttag'];
		$title = apply_filters('widget_title', $instance['title']);
		$textarea = $instance['textarea'];
		$link = $instance['link'];
		$linktext = $instance['linktext'];

	echo $before_widget;

		// if the image is set
		if ($image) {
			echo '<a class="image-link" href="' . $link . '"><img src="' . $image . '" alt="' . $alttag . '" title="' . $alttag . '"/></a>' ;
			}

		// if the title is set
		if ($title) {
			echo $before_title . $title . $after_title;
			}

		// if text is entered in the textarea
		if ($textarea) {
			echo '<div class="widget-textarea"><p>' . $textarea . '</p></div>';
			}

		// if the link is set
		if ($link) {
			echo '<a class="cta" href="' . $link . '">' . $linktext . '</a>';
			}

	echo $after_widget;

}

/********************************** @see WP_Widget::update *************************/
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['image'] = strip_tags($new_instance['image']);
	$instance['alttag'] = strip_tags($new_instance['alttag']);
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['textarea'] = $new_instance['textarea'];
	$instance['link'] = strip_tags($new_instance['link']);
	$instance['linktext'] = strip_tags($new_instance['linktext']);

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

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_image_widget");'));

