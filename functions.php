<?

session_start();
//  show_admin_bar(false);
/* Stop a bunch of notice errors by using this helper method to get the current post ID */
function post_id()
{
  $post_id = null;

  if (isset($_GET) && isset($_GET['post'])) {
    $post_id = $_GET['post'];
  } elseif (isset($_POST) && isset($_POST['post_ID'])) {
    $post_id = $_POST["post_ID"];
  }

  return $post_id;
}

function vd()
{
  foreach (func_get_args() as $args) {
    var_dump($args);
  }
  die;
}

// Include files but without having to set every variable global - which is bad
// Usage: inc('header.php', ['title' => 'Header Title']);
function inc($file_path, $variables = [])
{
  $file_path = locate_template($file_path);

  if (!file_exists($file_path)) {
    return "";
  }

  extract($variables, EXTR_SKIP);

  ob_start();
  include $file_path;

  return ob_get_clean();
}

if (!function_exists('digicrab_setup')) {
  function digicrab_setup()
  {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('featured-image', 1920);

    register_nav_menus(array(
      'primary' => __('Primary Menu', 'digicrab'),
      'footer' => __('Footer Menu', 'digicrab'),
      'home' => __('Home Menu', 'digicrab'),
    ));
  }
}


// function defer_parsing_of_js ( $url ) {
//     if ( FALSE === strpos( $url, '.js' ) ) return $url;
//     if ( strpos( $url, 'jquery.js' ) ) return $url;
//     return "$url' defer ";
// }
// add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

add_image_size('client-sizes', 180);

function footag_func($atts)
{
  return htmlentities($_SESSION['shortlistEmail']);
}
add_shortcode('footag', 'footag_func');

add_action('after_setup_theme', 'digicrab_setup');

add_action('widgets_init', 'wpe_remove_encourage_tls', 0);
function wpe_remove_encourage_tls()
{
  remove_action('init', 'wpesec_encourage_tls');
}

function digicrab_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Sidebar', 'digicrab'),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ));

  register_sidebar(array(
    'name'          => __('Contact Details', 'digicrab'),
    'id'            => 'contact-details',
    'description'   => 'Telephone, email and social media details',
    'before_widget' => '<div class="contact-details">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'          => __('Address', 'digicrab'),
    'id'            => 'address-details',
    'description'   => 'Address, Company Number and VAT Number',
    'before_widget' => '<div class="address-details">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'          => __('How it works text', 'digicrab'),
    'id'            => 'how-it-works',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'digicrab_widgets_init');

/**
 * Add surrounding div to sub-menu_order
 */

class Child_Wrap extends Walker_Nav_Menu
{
  function start_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<div class=\"custom-sub material-card point-eight-trans\"><div class=\"aligncenter\"><ul class=\"sub-menu\"><button class=\"clickable\">Go Back</button>\n";
  }
  function end_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul></div></div>\n";
  }
}

/**
 * Excerpt Length.
 */

function new_excerpt_length($length)
{
  return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

/**
 * Excerpt for pages.
 */


add_action('init', 'my_custom_init');
function my_custom_init()
{
  add_post_type_support('page', 'excerpt');
  add_post_type_support('tent', 'excerpt');
  add_post_type_support('testimonial', 'excerpt');
  add_post_type_support('venue', 'excerpt');
  add_post_type_support('venue-dressing', 'excerpt');
}

/**** Lower SEO Yoast Priority ***/

add_filter('wpseo_metabox_prio', function () {
  return 'low';
});

/*** Rewrite Team URL ***/

function change_author_permalinks()
{
  global $wp_rewrite;
  $wp_rewrite->author_base = 'about/team';
}
add_action('init', 'change_author_permalinks');

/*** Add job title and telephone number fields ***/

function my_new_contactmethods($contactmethods)
{

  $contactmethods['telephone'] = 'Telephone Number';
  $contactmethods['jobtitle'] = 'Job Title';
  $contactmethods['order_number'] = 'Order to display in';
  return $contactmethods;
}

add_filter('user_contactmethods', 'my_new_contactmethods', 10, 1);


/*function stop_404_guessing($url) {
	return (is_404()) ? false : $url;
}
add_filter('redirect_canonical', 'stop_404_guessing');
*/

/*
* Lazy Load Inserted Images in Wordpress Content from the database
*/

function foresight_hires_img_replace($the_content)
{
  if (!empty($the_content)) {
    // Create a new istance of DOMDocument
    $post = new DOMDocument();
    // Load $the_content as HTML
    $post->loadHTML($the_content);
    // Look up for all the <img> tags.
    $imgs = $post->getElementsByTagName('img');

    // Iteration time
    foreach ($imgs as $img) {
      // Let's make sure the img has not been already manipulated by us
      // by checking if it has a data-src attribute (we could also check
      // if it has the fs-img class, or whatever check you might feel is
      // the most appropriate.
      if ($img->hasAttribute('data-src')) continue;

      // Also, let's check that the <img> we found is not child of a <noscript>
      // tag, we want to leave those alone as well.
      if ($img->parentNode->tagName == 'noscript') continue;

      // Let's clone the node for later usage.
      $clone = $img->cloneNode();

      $src = $img->getAttribute('src');
      $img->removeAttribute('src');
      $img->setAttribute('data-src', $src);
    };

    return $post->saveHTML();
  }
}

add_filter('the_content', 'foresight_hires_img_replace');

/**
 * Disable the emojis
 */
function disable_emojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array  $plugins
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

/*** ADD TAGS TO IMAGES ***/

function wptp_add_tags_to_attachments()
{
  register_taxonomy_for_object_type('post_tag', 'attachment');
}
add_action('init', 'wptp_add_tags_to_attachments');

function wptp_add_tags_to_pages()
{
  register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'wptp_add_tags_to_pages');

/**
 * Exclude Layouts from Tent Type Pages e.g. /tents/frame-tent-collection/ | /tents/pole-tents
 */

function be_exclude_category_from_blog($query)
{

  if ($query->is_main_query() && $query->is_tax('tent_type')) {
    $query->set('post_type', 'tent');
  }
}

add_action('pre_get_posts', 'be_exclude_category_from_blog');


/*** JQUERY LIBRARY FROM GOOGLE **/

function modify_jquery()
{
  if (!is_admin()) {
    // comment out the next two lines to load the local copy of jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', true, '2.2.2');
    wp_enqueue_script('jquery');
  }
}
add_action('init', 'modify_jquery');

/**
 * Enqueue scripts and styles.
 */
function digicrab_scripts()
{
  wp_enqueue_style('video-style', get_template_directory_uri() . '/css/jquery.background-video.css', array(), '1.1.1');
  wp_enqueue_style('minified-styles', get_template_directory_uri() . '/compiled/css/main.css', array(), '1.0.0');
  wp_enqueue_style('owl', get_template_directory_uri() . '/js/owl-carousel/assets/owl.carousel.css', array(), '1.1.1');

  wp_enqueue_script('digicrab-js', get_template_directory_uri() . '/js/digicrab.js', array(), '1.4', true);
  wp_enqueue_script('cookies', get_template_directory_uri() . '/js/cookies.js', array(), '1.1', true);
  wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js', array(), '1.1', false);
  wp_enqueue_script('video', get_template_directory_uri() . '/js/HTML5-Video/jquery.background-video.js', array(), '1.0', false);
  wp_enqueue_script('owl-sript', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array(), '1.0', false);
  wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array(), '1.0', false);

  //    wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/theme.js', array(), '1.0', false);
  wp_localize_script("digicrab-js", "form_obj", array(
    "ajax_url"      =>  admin_url("admin-ajax.php")
  ));
}

add_action('wp_enqueue_scripts', 'digicrab_scripts');

/*** ONLY EXTERNAL BLOGS IN MAIN QUERY -- INTERNAL BLOGS (BLOG) IN NEW WP QUERY ***/

function just_external($query)
{
  if ($query->is_main_query() && is_tag()) {
    $query->set('category_name', 'external-blogs');
  }
}
add_action('pre_get_posts', 'just_external');


/**
 * PHP library extras
 */

require get_template_directory() . '/php-library/template-tags.php';
require get_template_directory() . '/php-library/extras.php';
require get_template_directory() . '/php-library/ajax-functions.php';

require get_template_directory() . '/php-library/meta-boxes/home-page-meta.php';
require get_template_directory() . '/php-library/meta-boxes/service-page-meta.php';
require get_template_directory() . '/php-library/meta-boxes/tent-meta.php';
require get_template_directory() . '/php-library/meta-boxes/venue-meta.php';
require get_template_directory() . '/php-library/meta-boxes/furniture-meta.php';
require get_template_directory() . '/php-library/meta-boxes/press-meta.php';
require get_template_directory() . '/php-library/meta-boxes/photographer-meta.php';
require get_template_directory() . '/php-library/meta-boxes/call-to-action-meta.php';

require get_template_directory() . '/php-library/meta-boxes/universal-meta.php';
require get_template_directory() . '/php-library/meta-boxes/post-meta.php';
require get_template_directory() . '/php-library/meta-boxes/contact-page-meta.php';
require get_template_directory() . '/php-library/meta-boxes/venue-dressing-meta.php';
require get_template_directory() . '/php-library/meta-boxes/event-page-meta.php';
require get_template_directory() . '/php-library/meta-boxes/layout-meta.php';
/*require get_template_directory() . '/php-library/meta-boxes/resources-page-meta.php';*/

require get_template_directory() . '/php-library/furniture/furniture.php';
require get_template_directory() . '/php-library/tents/tents.php';
require get_template_directory() . '/php-library/testimonials/testimonials.php';
require get_template_directory() . '/php-library/venues/venues.php';
require get_template_directory() . '/php-library/press/press.php';
require get_template_directory() . '/php-library/photographers/photographers.php';
require get_template_directory() . '/php-library/venue-dressing/venue-dressing.php';
require get_template_directory() . '/php-library/layouts/layouts.php';
require get_template_directory() . '/php-library/call-to-actions/call-to-actions.php';
require get_template_directory() . '/php-library/caterers/caterers.php';
require get_template_directory() . '/php-library/locations/locations.php';
require get_template_directory() . '/php-library/product-furniture/product-furniture.php';

require get_template_directory() . '/php-library/taxonomies/tent-type-taxonomy.php';
require get_template_directory() . '/php-library/taxonomies/furniture-type-taxonomy.php';
require get_template_directory() . '/php-library/taxonomies/location-taxonomy.php';
require get_template_directory() . '/php-library/taxonomies/colour-taxonomy.php';
require get_template_directory() . '/php-library/taxonomies/page-type-taxonomy.php';
require get_template_directory() . '/php-library/taxonomies/example-layout-taxonomy.php';
// require get_template_directory() . '/php-library/taxonomies/layout-type-taxonomy.php'; NOT USED

require get_template_directory() . '/php-library/widgets/contact-widget/contact-widget.php';
require get_template_directory() . '/php-library/widgets/slides-block-widget/slides-block-widget.php';
require get_template_directory() . '/php-library/widgets/address-widget/address-widget.php';

require get_template_directory() . '/php-library/shortcodes/call-specific-post.php';
require get_template_directory() . '/php-library/shortcodes/call-specific-testimonial.php';

if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}

if (function_exists('acf_set_options_page_menu')) {
  acf_set_options_page_menu('Arabian tents');
}

function my_pre_get_posts($query)
{
  if (is_admin()) {
    return $query;
  }
  if (isset($query->query_vars['tent_type']) && is_archive()) {
    $query->set('post_type', ['tent', 'product']);
  }
  return $query;
}

add_action('pre_get_posts', 'my_pre_get_posts');

/** FONT FORMATTING **/
function wpb_mce_buttons_2($buttons)
{
  array_unshift($buttons, 'styleselect');
  return $buttons;
}

add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

function my_mce_before_init_insert_formats($init)
{
  $style_formats = array(
    array(
      'title' => 'Normal',
      'block' => 'p'
    ),
    array(
      'title' => '12px',
      'block' => 'span',
      'classes' => 'twelvepx'
    ),
    array(
      'title' => '14px',
      'block' => 'span',
      'classes' => 'fourteenpx'
    ),
    array(
      'title' => '16px',
      'block' => 'span',
      'classes' => 'sixteenpx'
    ),
    array(
      'title' => '18px',
      'block' => 'span',
      'classes' => 'eighteenpx'
    ),
    array(
      'title' => '22px',
      'block' => 'span',
      'classes' => 'twentytwopx'
    ),
    array(
      'title' => '24px',
      'block' => 'span',
      'classes' => 'twentyfourpx'
    ),
    array(
      'title' => '26px',
      'block' => 'span',
      'classes' => 'twentysixpx'
    ),
    array(
      'title' => '28px',
      'block' => 'span',
      'classes' => 'twentyeightpx'
    ),
  );

  $init['style_formats'] = json_encode($style_formats);

  return $init;
}

add_filter('mce_css', 'editor_style');
function editor_style($url)
{
  if (!empty($url))
    $url .= ',';

  // Retrieves the plugin directory URL
  // Change the path here if using different directories
  $url .=  get_template_directory_uri() . '/editor-styles.css';

  return $url;
}

/** FONT FORMATTING END **/

// Attach callback to 'tiny_mce_before_init'
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');
