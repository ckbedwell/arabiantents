<?

class digicrab_three_fifty_blocks_contact_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(false, $name = 'Contact Widget');
    }

    function widget($args, $instance)
    {
        extract($args);

        // these are our widget options
        $telephone = $instance['telephone'];
        $email = $instance['email'];
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $linkedin = $instance['linkedin'];
        $pinterest = $instance['pinterest'];
        $googleplus = $instance['googleplus'];
        $instagram = $instance['instagram'];
        $youtube = $instance['youtube'];

        echo $before_widget;

        // if the telephone number is set
        if ($telephone) {
            echo '<a title="Telephone" class="telephone" href="tel:' . $telephone .'"><span class="icon-phone"></span>' . $telephone . '</a>';
        }

        // if the email address is set
        if ($email) {
            echo '<a title="Email" class="email" href="mailto:' . $email . '"><span class="icon-envelop"></span>' . $email . '</a>';
        }

        echo '<ul class="social-icons">';

        // if the facebook link is set
        if ($facebook) {
            echo '<li><a title="Facebook" class="facebook" target="_blank" href="' . $facebook . '"><span class="icon-facebook"></span></a></li>';
        }



        // if the linkedin link is set
        if ($linkedin) {
            echo '<li><a title="Linkedin" class="linkedin" target="_blank" href="' . $linkedin . '"><span class="icon-linkedin"></span></a></li>';
        }

        // if the pinterest link is set
        if ($pinterest) {
            echo '<li><a title="Pinterest" class="pinterest" target="_blank" href="' . $pinterest . '"><span class="icon-pinterest"></span></a></li>';
        }

        // if the google plus link is set
        if ($googleplus) {
            echo '<li><a title="Google Plus" class="googleplus" target="_blank" href="' . $googleplus . '"><span class="icon-google-plus"></span></a></li>';
        }

        // if the instagram link is set
        if ($instagram) {
            echo '<li><a title="Instagram" class="instagram" target="_blank" href="' . $instagram . '"><span class="icon-instagram"></span></a></li>';
        }

        // if the instagram link is set
        if ($youtube) {
            echo '<li><a title="youtube" class="youtube" target="_blank" href="' . $youtube . '"><span class="icon-youtube-square"></span></a></li>';
        }

	echo '<li><a class="search-toggle" href="#"><span class="icon-search"></span></a></li>';
        echo $after_widget;
    }

	

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['telephone'] = strip_tags($new_instance['telephone']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['linkedin'] = strip_tags($new_instance['linkedin']);
        $instance['pinterest'] = strip_tags($new_instance['pinterest']);
        $instance['googleplus'] = strip_tags($new_instance['googleplus']);
        $instance['instagram'] = strip_tags($new_instance['instagram']);
        $instance['youtube'] = strip_tags($new_instance['youtube']);

        return $instance;
    }

    function form($instance)
    {
        $telephone = esc_attr($instance['telephone']);
        $email = esc_attr($instance['email']);
        $facebook = esc_attr($instance['facebook']);
        $twitter = esc_attr($instance['twitter']);
        $linkedin = esc_attr($instance['linkedin']);
        $pinterest = esc_attr($instance['pinterest']);
        $googleplus = esc_attr($instance['googleplus']);
        $instagram = esc_attr($instance['instagram']);
        $youtube = esc_attr($instance['youtube']);
    ?>

        <p>
            <label for="<?= $this->get_field_id('telephone'); ?>"><?php _e('Telephone number to display:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('telephone'); ?>" name="<?= $this->get_field_name('telephone'); ?>" type="text" value="<?= $telephone; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('email'); ?>"><?php _e('Email address to display:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('email'); ?>" name="<?= $this->get_field_name('email'); ?>" type="text" value="<?= $email; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('facebook'); ?>"><?php _e('Your link to Facebook:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('facebook'); ?>" name="<?= $this->get_field_name('facebook'); ?>" type="text" value="<?= $facebook; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('twitter'); ?>"><?php _e('Your link to Twitter:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('twitter'); ?>" name="<?= $this->get_field_name('twitter'); ?>" type="text" value="<?= $twitter; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('linkedin'); ?>"><?php _e('Your link to Linkedin:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('linkedin'); ?>" name="<?= $this->get_field_name('linkedin'); ?>" type="text" value="<?= $linkedin; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('pinterest'); ?>"><?php _e('Your link to Pinterest:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('pinterest'); ?>" name="<?= $this->get_field_name('pinterest'); ?>" type="text" value="<?= $pinterest; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('googleplus'); ?>"><?php _e('Your link to Google Plus:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('googleplus'); ?>" name="<?= $this->get_field_name('googleplus'); ?>" type="text" value="<?= $googleplus; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('instagram'); ?>"><?php _e('Your link to Instagram:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('instagram'); ?>" name="<?= $this->get_field_name('instagram'); ?>" type="text" value="<?= $instagram; ?>" />
        </p>

<p>
    <label for="<?= $this->get_field_id('youtube'); ?>"><?php _e('Your link to youtube:'); ?></label>
    <input class="widefat" id="<?= $this->get_field_id('youtube'); ?>" name="<?= $this->get_field_name('youtube'); ?>" type="text" value="<?= $youtube; ?>" />
</p>
    <? }
}

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_contact_widget");'));