<?

class digicrab_three_fifty_blocks_slide_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(false, $name = 'Slides Block Widget');
    }

    function widget($args, $instance)
    {
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
            echo '<a style="background-image: url(' . $image . ');" href="' . $link . '" " alt="' . $alttag . '" title="' . $alttag . '"/>';
        }

        echo '<div class="parent-contain"><div class="width-contain">';

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        if ($textarea) {
            echo '<div class="widget-textarea"><p>' . $textarea . '</p></div>';
        }

        if ($linktext) {
            echo '<a class="cta" href="' . $link . '">' . $linktext . '</a>';
        }

        echo '</div></div></a>';
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['alttag'] = strip_tags($new_instance['alttag']);
        $instance['title'] = $new_instance['title'];
        $instance['textarea'] = $new_instance['textarea'];
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['linktext'] = $new_instance['linktext'];

        return $instance;
    }

    function form($instance)
    {
        $image = esc_attr($instance['image']);
        $alttag = esc_attr($instance['alttag']);
        $title = esc_attr($instance['title']);
        $textarea = esc_attr($instance['textarea']);
        $link = esc_attr($instance['link']);
        $linktext = esc_attr($instance['linktext']);
    ?>
        <p>
            <label for="<?= $this->get_field_id('image'); ?>"><?php _e('Paste your <b>image link</b> here'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('image'); ?>" name="<?= $this->get_field_name('image'); ?>" type="text" value="<?= $image; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('alttag'); ?>"><?php _e('Alt and title attributes for this image'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('alttag'); ?>" name="<?= $this->get_field_name('alttag'); ?>" type="text" value="<?= $alttag; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= $title; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('textarea'); ?>"><?php _e('This is a textarea:'); ?></label>
            <textarea rows="20" class="widefat" id="<?= $this->get_field_id('textarea'); ?>" name="<?= $this->get_field_name('textarea'); ?>"><?= $textarea; ?></textarea>
        </p>

        <p>
            <label for="<?= $this->get_field_id('link'); ?>"><?php _e('Paste the link for this block here:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('link'); ?>" name="<?= $this->get_field_name('link'); ?>" type="text" value="<?= $link; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('linktext'); ?>"><?php _e('What would you like the link text to say?'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('linktext'); ?>" name="<?= $this->get_field_name('linktext'); ?>" type="text" value="<?= $linktext; ?>" />
        </p>
    <?
    }
}

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_slide_widget");'));
