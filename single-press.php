<?
/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

$publishedLocation = rwmb_meta('published-location', $args = array('type=text'));
$publishDate = rwmb_meta('publish-date', $args = array('type=text'));
$publishedWebsite = rwmb_meta('published-website', $args = array('type=text'));

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
        <article>
            <header class="small-header">
                <div class="width-contain">
                    <h1 class="entry-title"><? the_title(); ?></h1>
                </div>
            </header>

            <div class="entry-content scrollto-padding" id="scrollto-entry-content">
                <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

                <section>
                    <div class="width-contain">
                        <div class="third">
                            <h2>Press information</h2>

                            <? if (!empty ($publishedLocation)) : ?>
                                <div class="full">
                                    <strong>Published in:</strong>
                                    <?= $publishedLocation; ?>
                                </div>
                            <? endif; ?>

                            <? if (!empty ($publishDate)) : ?>
                                <div class="full">
                                    <strong>Publish date:</strong>
                                    <?= $publishDate; ?>
                                </div>
                            <? endif; ?>

                            <? if (!empty ($publishedWebsite)) : ?>
                                <div class="full">
                                    <strong>Website:</strong>
                                    <a href="<?= $publishedWebsite; ?>">
                                        <?
                                            $removeHTTP = explode("http://", $publishedWebsite);
                                            $baseURL = explode("/", $removeHTTP[1]);
                                            echo $baseURL[0];
                                        ?>
                                    </a>
                                </div>
                            <? endif; ?>
                        </div>

                        <div class="two-thirds">
                            <?= do_shortcode(wpautop(get_the_content())); ?>
                        </div>
                    </div>
                </section>
                <? include(locate_template('/partials/cta.php')); ?>
            </div>

            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	       </footer>
        </article>
    </main>
<? get_footer(); ?>
