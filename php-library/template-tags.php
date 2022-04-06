<?

    // AUTHOR IMAGE
    if (! function_exists('author_image')) :
        function author_image($authorID, $size = 'full_size') {
            ?>


            <img class="rounded" src="<?= get_cupp_meta($authorID, $size); ?>">
            <noscript>
                <img class="rounded" src="<?= get_cupp_meta($authorID, $size); ?>">
            </noscript>


	<?
            }
            endif;

    // AUTHOR SOCIAL LINKS

    if (! function_exists('author_social_links')) :
        function author_social_links() {
            $twitter = get_the_author_meta('twitter');
            $facebook = get_the_author_meta('facebook');
            $googleplus = get_the_author_meta('googleplus');
        ?>

        <? if(!empty($twitter | $facebook | $googleplus)) : ?>
            <h5>Follow Me</h5>
            <ul class="social-icons">
                <? if(!empty($twitter)) : ?>
                    <li><a href="https://twitter.com/<?= $twitter; ?>" title="Twitter"><span class="icon-twitter"></span></a></li>
                <? endif; ?>

                <? if(!empty($facebook)) : ?>
                    <li><a href="<?= $facebook; ?>" title="Facebook"><span class="icon-facebook"></span></a></li>
                <? endif; ?>

                <? if(!empty($googleplus)) : ?>
                    <li><a href="<?= $googleplus; ?>" title="Google Plus"><span class="icon-google-plus"></span></a></li>
                <? endif; ?>
            </ul>
    <? endif; } endif;

    // POST PUBLISHED DATE
    if (! function_exists('published_date')) :
        function published_date() {
        ?>

        <span class="published-date"><span class="icon-clock"></span><? the_time('jS F Y') ?></span>

    <?
        }
        endif;



    if (! function_exists('posts_pagination')) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
    function posts_pagination() {
	   if ($GLOBALS['wp_query']->max_num_pages < 2) {
           return;
	       }
	?>
	<section class=" parent-contain">
        <nav class="width-contain" role="navigation">
            <? if (get_next_posts_link()) : ?>
                <div class="nav-previous"><? next_posts_link(__('Older posts', 'digicrab')); ?></div>
            <? endif; ?>

            <? if (get_previous_posts_link()) : ?>
                <div class="nav-next"><? previous_posts_link(__('Newer Posts', 'digicrab')); ?></div>
            <? endif; ?>
        </nav>
    </section>
	<?

    }
    endif;

if (! function_exists('post_pagination')) :

/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */

function post_pagination() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
	$next     = get_adjacent_post(false, '', false);

	if (! $next && ! $previous) {
		return;
	}
	?>
	<section class="parent-contain">
        <nav class="navigation post-navigation" role="navigation">
            <?
				previous_post_link('<div class="nav-previous">%link</div>', '%title');
				next_post_link('<div class="nav-next">%link</div>', '%title');
			?>
        </nav>
    </section>
	<?
}
endif;



if (! function_exists('digicrab_entry_footer')) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function digicrab_entry_footer() {
	// Hide category and tag text for pages.
	if ('post' == get_post_type()) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(__(', ', 'digicrab'));
		if ($categories_list && digicrab_categorized_blog()) {
			printf('<span class="cat-links">' . __('Posted in %1$s', 'digicrab') . '</span>', $categories_list);
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('', __(', ', 'digicrab'));
		if ($tags_list) {
			printf('<span class="tags-links">' . __('Tagged %1$s', 'digicrab') . '</span>', $tags_list);
		}
	}

	if (! is_single() && ! post_password_required() && (comments_open() || get_comments_number())) {
		echo '<span class="comments-link">';
		comments_popup_link(__('Leave a comment', 'digicrab'), __('1 Comment', 'digicrab'), __('% Comments', 'digicrab'));
		echo '</span>';
	}

	edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>');
}
endif;

if (! function_exists('display_the_archive_title')) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function display_the_archive_title($before = '', $after = '') {
	if (is_category()) {
		$title = sprintf(__('%s', 'digicrab'), single_cat_title('', false));
	   }

    elseif (is_tag()) {
		$title = sprintf(__('%s', 'digicrab'), single_tag_title('', false));
	   }

    elseif (is_author()) {
		$title = sprintf(__('Author: %s', 'digicrab'), '<span class="vcard">' . get_the_author() . '</span>');
	   }

    elseif (is_year()) {
		$title = sprintf(__('Year: %s', 'digicrab'), get_the_date(_x('Y', 'yearly archives date format', 'digicrab')));
	   }

    elseif (is_month()) {
		$title = sprintf(__('Month: %s', 'digicrab'), get_the_date(_x('F Y', 'monthly archives date format', 'digicrab')));
	   }

    elseif (is_day()) {
		$title = sprintf(__('Day: %s', 'digicrab'), get_the_date(_x('F j, Y', 'daily archives date format', 'digicrab')));
	   }

	elseif (is_post_type_archive()) {
		$title = sprintf(__('Archives: %s', 'digicrab'), post_type_archive_title('', false));
	   }

    elseif (is_tax()) {
		$tax = get_taxonomy(get_queried_object()->taxonomy);
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf(__('%s', 'digicrab'), single_term_title('', false));
	   }

    else {
		$title = __('Archives', 'digicrab');
	   }

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters('get_the_archive_title', $title);

	if (! empty($title)) {
		echo $before . $title . $after;
	}
}
endif;

if (! function_exists('the_archive_description')) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description($before = '', $after = '') {
	$description = apply_filters('get_the_archive_description', term_description());

	if (! empty($description)) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function digicrab_categorized_blog() {
	if (false === ($all_the_cool_cats = get_transient('digicrab_categories'))) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('digicrab_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		// This blog has more than 1 category so digicrab_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so digicrab_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in digicrab_categorized_blog.
 */
function digicrab_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('digicrab_categories');
}
add_action('edit_category', 'digicrab_category_transient_flusher');
add_action('save_post',     'digicrab_category_transient_flusher');
