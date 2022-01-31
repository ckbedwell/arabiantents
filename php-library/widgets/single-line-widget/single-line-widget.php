<?

class digicrab_three_fifty_single_line_widget extends WP_Widget {
    function __construct()
    {
        parent::WP_Widget(false, $name = 'Single Line Widget');
    }

    function widget($args, $instance)
    {
        extract($args);

        // these are our widget options
        $singleline = $instance['singleline'];

        echo $before_widget;

        // if the title is set
        if ($singleline) {
            echo $singleline;
        }

        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['singleline'] = strip_tags($new_instance['singleline']);

        return $instance;
    }

    function form($instance)
    {
        $singleline = esc_attr($instance['singleline']);
    ?>
        <p>
            <label for="<?= $this->get_field_id('singleline'); ?>"><?php _e('Single Line'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('singleline'); ?>" name="<?= $this->get_field_name('singleline'); ?>" type="text" value="<?= $singleline; ?>" />
        </p>
    <? }
}

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_single_line_widget");'));
