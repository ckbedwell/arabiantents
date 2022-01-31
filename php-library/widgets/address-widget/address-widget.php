<?

class digicrab_three_fifty_blocks_address_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(false, $name = 'Address Widget');
    }

    function widget($args, $instance)
    {
        extract($args);

        // these are our widget options
        $address_first_line = $instance['address_first_line'];
        $address_second_line = $instance['address_second_line'];
        $address_third_line = $instance['address_third_line'];
        $address_fourth_line = $instance['address_fourth_line'];
        $address_fifth_line = $instance['address_fifth_line'];
        $address_six_line = $instance['address_six_line'];
        $company_number = $instance['company_number'];
        $vat_number = $instance['vat_number'];


        echo $before_widget;

        // if the telephone number is set
        if ($address_first_line) {
            echo '<p class="address-line">' . $address_first_line . '</p>';
        }

        if ($address_second_line) {
            echo '<p class="address-line">' . $address_second_line . '</p>';
        }

        if ($address_third_line) {
            echo '<p class="address-line">' . $address_third_line . '</p>';
        }

        if ($address_fourth_line) {
            echo '<p class="address-line">' . $address_fourth_line . '</p>';
        }

        if ($address_fifth_line) {
            echo '<p class="address-line">' . $address_fifth_line . '</p>';
        }

        if ($address_six_line) {
            echo '<p class="address-line">' . $address_six_line . '</p>';
        }

        if ($company_number) {
            echo '<p class="company-number">Company number: ' . $company_number . '</p>';
        }

        if ($vat_number) {
            echo '<p class="vat-number">VAT number ' . $vat_number . '</p>';
        }

        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['address_first_line'] = strip_tags($new_instance['address_first_line']);
        $instance['address_second_line'] = strip_tags($new_instance['address_second_line']);
        $instance['address_third_line'] = strip_tags($new_instance['address_third_line']);
        $instance['address_fourth_line'] = strip_tags($new_instance['address_fourth_line']);
        $instance['address_fifth_line'] = strip_tags($new_instance['address_fifth_line']);
        $instance['address_six_line'] = strip_tags($new_instance['address_six_line']);
        $instance['company_number'] = strip_tags($new_instance['company_number']);
        $instance['vat_number'] = strip_tags($new_instance['vat_number']);

        return $instance;
    }

    function form($instance) {
        $address_first_line = esc_attr($instance['address_first_line']);
        $address_second_line = esc_attr($instance['address_second_line']);
        $address_third_line = esc_attr($instance['address_third_line']);
        $address_fourth_line = esc_attr($instance['address_fourth_line']);
        $address_fifth_line = esc_attr($instance['address_fifth_line']);
        $address_six_line = esc_attr($instance['address_six_line']);
        $company_number = esc_attr($instance['company_number']);
        $vat_number = esc_attr($instance['vat_number']); ?>
        <p>
            <label for="<?= $this->get_field_id('address_first_line'); ?>"><?php _e('Address first line:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('address_first_line'); ?>" name="<?= $this->get_field_name('address_first_line'); ?>" type="text" value="<?= $address_first_line; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('address_second_line'); ?>"><?php _e('Address second line:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('address_second_line'); ?>" name="<?= $this->get_field_name('address_second_line'); ?>" type="text" value="<?= $address_second_line; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('address_third_line'); ?>"><?php _e('Address third line:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('address_third_line'); ?>" name="<?= $this->get_field_name('address_third_line'); ?>" type="text" value="<?= $address_third_line; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('address_fourth_line'); ?>"><?php _e('Address fourth line:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('address_fourth_line'); ?>" name="<?= $this->get_field_name('address_fourth_line'); ?>" type="text" value="<?= $address_fourth_line; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('address_fifth_line'); ?>"><?php _e('Address fifth line:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('address_fifth_line'); ?>" name="<?= $this->get_field_name('address_fifth_line'); ?>" type="text" value="<?= $address_fifth_line; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('address_six_line'); ?>"><?php _e('Address six line:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('address_six_line'); ?>" name="<?= $this->get_field_name('address_six_line'); ?>" type="text" value="<?= $address_six_line; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('company_number'); ?>"><?php _e('Company Number:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('company_number'); ?>" name="<?= $this->get_field_name('company_number'); ?>" type="text" value="<?= $company_number; ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('vat_number'); ?>"><?php _e('VAT Number:'); ?></label>
            <input class="widefat" id="<?= $this->get_field_id('vat_number'); ?>" name="<?= $this->get_field_name('vat_number'); ?>" type="text" value="<?= $vat_number; ?>" />
        </p>

        <?
    }
}

add_action('widgets_init', create_function('', 'return register_widget("digicrab_three_fifty_blocks_address_widget");'));
