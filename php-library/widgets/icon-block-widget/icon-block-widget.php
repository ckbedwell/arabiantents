<?

/******************************** WIDGET CLASS NAME **************************************/

    class digicrab_three_fifty_blocks_icon_widget extends WP_Widget {


/**********************************CONSTRUCTOR ***************************************/

    function digicrab_three_fifty_blocks_icon_widget() {
           parent::WP_Widget(false, $name = 'Icon Block Widget');
        }

/****************************** INPUT FIELDS AND FRONT-END OUTPUT ****************************/

function widget($args, $instance) {
        extract($args);

    // these are our widget options
            $icon = $instance['icon'];
        $title = apply_filters('widget_title', $instance['title']);
        $textarea = $instance['textarea'];
        $link = $instance['link'];
        $linktext = $instance['linktext'];

    echo $before_widget;
        echo '<div class="widget-icon">';
        // if the text field is set
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

        else if ($icon == 'phone') {
            echo '<span class="icon-phone"></span>';
            }

        else if ($icon == 'calendar') {
            echo '<span class="icon-calendar2"></span>';
            }

        else if ($icon == 'graph') {
            echo '<span class="icon-stats-up"></span>';
            }

        else if ($icon == 'tablet') {
            echo '<span class="icon-mobile2"></span>';
            }

        else if ($icon == 'question-mark') {
            echo '<span class="icon-question2"></span>';
            }

        else if ($icon == 'wink') {
            echo '<span class="icon-wink2"></span>';
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

        echo '</div>';
    echo $after_widget;

}

/********************************** @see WP_Widget::update *************************/
    function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['icon'] = strip_tags($new_instance['icon']);
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['textarea'] = $new_instance['textarea'];
    $instance['link'] = strip_tags($new_instance['link']);
    $instance['linktext'] = strip_tags($new_instance['linktext']);

   return $instance;
    }

 /*********************************** @see WP_Widget::form ************************/
function form($instance) {

    $icon = esc_attr($instance['icon']);
    $title = esc_attr($instance['title']);
    $textarea = esc_attr($instance['textarea']);
    $link = esc_attr($instance['link']);
    $linktext = esc_attr($instance['linktext']);

    ?>

    <p>
        <label for="<?= $this->get_field_id('icon'); ?>"><? _e('Select your icon'); ?></label>
        <select name="<?= $this->get_field_name('icon'); ?>" id="<?= $this->get_field_id('icon'); ?>" class="widefat">
            <?
            $options = array('home', 'clock', 'location', 'quote', 'tick', 'user', 'bubble', 'office', 'truck', 'users', 'conversation', 'plus-circle', 'phone', 'calendar', 'graph', 'tablet',
            'question-mark', 'wink');
            foreach ($options as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', $icon == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            }
            ?>
        </select>
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

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_icon_widget");'));

