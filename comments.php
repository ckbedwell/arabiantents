<?

/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package digicrab
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area">

  <? // You can start editing here -- including this comment! 
  ?>

  <? if (have_comments()) : ?>
    <h2 class="comments-title">
      <?
      printf(
        _nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'digicrab'),
        number_format_i18n(get_comments_number()),
        '<span>' . get_the_title() . '</span>'
      );
      ?>
    </h2>

    <? if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through 
    ?>
      <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><? _e('Comment navigation', 'digicrab'); ?></h2>
        <div class="nav-links">

          <div class="nav-previous"><? previous_comments_link(__('Older Comments', 'digicrab')); ?></div>
          <div class="nav-next"><? next_comments_link(__('Newer Comments', 'digicrab')); ?></div>

        </div><!-- .nav-links -->
      </nav><!-- #comment-nav-above -->
    <? endif; // check for comment navigation 
    ?>

    <ol class="comment-list">
      <?
      wp_list_comments(array(
        'style'      => 'ol',
        'short_ping' => true,
      ));
      ?>
    </ol><!-- .comment-list -->

    <? if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through 
    ?>
      <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><? _e('Comment navigation', 'digicrab'); ?></h2>
        <div class="nav-links">

          <div class="nav-previous"><? previous_comments_link(__('Older Comments', 'digicrab')); ?></div>
          <div class="nav-next"><? next_comments_link(__('Newer Comments', 'digicrab')); ?></div>

        </div><!-- .nav-links -->
      </nav><!-- #comment-nav-below -->
    <? endif; // check for comment navigation 
    ?>

  <? endif; // have_comments() 
  ?>

  <?
  // If comments are closed and there are comments, let's leave a little note, shall we?
  if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
  ?>
    <p class="no-comments"><? _e('Comments are closed.', 'digicrab'); ?></p>
  <? endif; ?>

  <? comment_form(); ?>

</div><!-- #comments -->