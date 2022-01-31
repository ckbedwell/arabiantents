<?
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package digicrab
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function digicrab_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter('body_class', 'digicrab_body_classes');

if (version_compare($GLOBALS['wp_version'], '4.1', '<')) :
    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string The filtered title.
     */
    function digicrab_wp_title($title, $sep) {
        if (is_feed()) {
            return $title;
        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo('name', 'display');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if (($paged >= 2 || $page >= 2) && ! is_404()) {
            $title .= " $sep " . sprintf(__('Page %s', 'digicrab'), max($paged, $page));
        }

        return $title;
    }
    add_filter('wp_title', 'digicrab_wp_title', 10, 2);

    /**
     * Title shim for sites older than WordPress 4.1.
     *
     * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function digicrab_render_title() {
        ?>
        <title><? wp_title('|', true, 'right'); ?></title>
        <?
    }
    add_action('wp_head', 'digicrab_render_title');
endif;



function breadcrumbs () {
    echo '<div class="fill"><div class="width-contain"><div class="alignleft breadcrumbs">';
    $pageUrl = $_SERVER["REQUEST_URI"];
    $crumbs = explode("/", $pageUrl);
    array_pop($crumbs);

    $count = count($crumbs);
    $i = 0;
    foreach($crumbs as $crumb){
        if($i == 0) {
          echo '<a href="/" class="home-breadcrumb">Home</a>';
          }
        else if($i == $count - 1) {
            if ($crumb === 'theming-image-gallaery') {
                echo '<strong>Theming Image Gallery</strong>';
            } else {
                echo '<strong>' . ucwords(str_replace("-"," ", $crumb)) . '</strong>';
            }
          }
        else {
          $currentCrumb = $currentCrumb . '/' . $crumb;
          echo '<a href="' . $currentCrumb . '">' . ucwords(str_replace("-"," ", $crumb)) . '</a>';
          }

        $i++;
        }
    echo '</div>

          <div class="alignright wrapper breadcrumb-share clickable">
            <span class="share-text">
                Share this <span class="icon-plus-circle"></span>
                <div class="horizontal-align wrapper">
                    <div class="alignleft full material-card fade-in">';
                    include(locate_template('/partials/share-buttons.php'));
                echo '</div>
                </div>
            </span>
        </div></div></div>';
  }



function sized_by_count($count, $max = 'half', $min = 'quarter', $oneFull = false) {

    if ($count % 3 == 0 || $count == 5 || $count == 10) {
        if($min == 'third' || $min == 'quarter') {
            $size = 'third';
        }
        else {
            $size = $min;
        }
    }

    else if ($count > 10) {
        if ($min != 'quarter') {
            $size = $min;
        }
        else {
            $size = 'quarter';
        }
    }

    else if($count % 4 == 0 || $count == 7) {
        if($min == 'third') {
            if($max == 'half') {
                $size = 'half';
            }
            else {
                $size = 'third';
            }
        }

        else if($min != 'quarter') {
            $size = $min;
        }

        else {
            $size = 'quarter';
        }
    }

    else {
        $size = $max;
    }

    if($oneFull === true) {
        if($count == 1) {
            $size = 'no-margin just-one full';
        }
    }

    return $size;
    }



function get_the_featured_image($postID) {
  $imgID = get_post_thumbnail_id($postID); //get the id of the featured image
  $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
  $imgURL = $featuredImage[0]; //get the url of the image out of the array
  $altText = get_post_meta($imgID , '_wp_attachment_image_alt', true);
  $captionText = get_post(get_post_thumbnail_id())->post_excerpt;
  $sizes = null;
  if (isset(wp_get_attachment_metadata($imgID, false)['sizes'])) {
    $sizes = wp_get_attachment_metadata($imgID, false)['sizes'];
  }
  return array('full_url'=>$imgURL, 'alt'=>$altText, 'caption'=>$captionText, 'sizes'=>$sizes);
}

