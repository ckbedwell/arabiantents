<?


/******************************** WIDGET CLASS NAME **************************************/

    class digicrab_three_fifty_blocks_icon_link_widget extends WP_Widget {


/**********************************CONSTRUCTOR ***************************************/

    function digicrab_three_fifty_blocks_icon_link_widget() {
           parent::WP_Widget(false, $name = 'Icon Link Widget');
        }

/****************************** INPUT FIELDS AND FRONT-END OUTPUT ****************************/

function widget($args, $instance) {
        extract($args);

    // these are our widget options
            $icon = $instance['icon'];
        $link = $instance['link'];
        $linktext = $instance['linktext'];

    echo $before_widget;

        // if the link is set
        if ($link) {
            echo '<a class="link-icon" href="' . $link . '">';
            }

        if ($icon == 'home') {
            echo '<span class="icon-home"></span>';
            }

        else if ($icon == 'clock') {
            echo '<span class="icon-clock"></span>';
            }

        else if ($icon == 'location') {
            echo '<span class="icon-location"></span>';
            }

        else if ($icon == 'quote') {
            echo '<span class="icon-bubble2"></span>';
            }

        else if ($icon == 'tick') {
            echo '<span class="icon-checkmark-circle2"></span>';
            }

        else if ($icon == 'user') {
            echo '<span class="icon-user"></span>';
            }

        else if ($icon == 'bubble') {
            echo '<span class="icon-bubble6"></span>';
            }

        else if ($icon == 'office') {
            echo '<span class="icon-office"></span>';
            }

        else if ($icon == 'truck') {
            echo '<span class="icon-truck"></span>';
            }

        else if ($icon == 'users') {
            echo '<span class="icon-users2"></span>';
            }

        else if ($icon == 'conversation') {
            echo '<span class="icon-bubbles9"></span>';
            }

        else if ($icon == 'plus-circle') {
            echo '<span class="icon-plus-circle2"></span>';
            }

        // if the link is set
        if ($link) {
            echo '<h2>' . $linktext . '</h2></a>';
            }

    echo $after_widget;

}

/********************************** @see WP_Widget::update *************************/
    function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['icon'] = strip_tags($new_instance['icon']);
    $instance['link'] = strip_tags($new_instance['link']);
    $instance['linktext'] = strip_tags($new_instance['linktext']);

   return $instance;
    }

 /*********************************** @see WP_Widget::form ************************/
function form($instance) {

    $icon = esc_attr($instance['icon']);
    $link = esc_attr($instance['link']);
    $linktext = esc_attr($instance['linktext']);

    ?>

    <p>
        <label for="<?= $this->get_field_id('icon'); ?>"><? _e('Select your icon'); ?></label>
        <select name="<?= $this->get_field_name('icon'); ?>" id="<?= $this->get_field_id('icon'); ?>" class="widefat">
            <?
            $options = array('home', 'clock', 'location', 'quote', 'tick', 'user', 'bubble', 'office', 'truck');
            foreach ($options as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', $icon == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            }
            ?>
        </select>
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

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_icon_link_widget");'));

