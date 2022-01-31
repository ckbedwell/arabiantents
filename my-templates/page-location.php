<?
/**
 * Template Name: Location Page

 */

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

        <? include(locate_template('featured-image.php')); ?>

        <div class="entry-content scrollto-padding" id="scrollto-entry-content">
            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section class="entry-content">
                <div class="width-contain">
                    <div class="width-contain-700 padded branding-bg get-directions">
                            <h3 class="text-center">How to find us</h3>
                            <img src="/wp-content/uploads/2016/05/find-us.jpg" alt="find-us"/>
                            <p>The safest and most direct way to come down to Hollands Lane is off the A2037 by turning down Nep Town Road which will effortlessly turn into Mill Road and later Dropping Holms before it becomes Hollands Lane (which is essentially a track!)</p>

                            <p>Towards the end of Dropping Holms, your Sat Nav will more than likely tell you to turn left on to Station Road however this is the unassuming junction (the sign is rather small!) to stay on the straight and narrow onto Hollands Lane. Past this junction, you will see a sign to ‘Rye Farm’ at the start of the track (the middle of 3 tracks), which is bumpy in places and is around a mile long – follow this to the end until you see a gate with a road that leads left to the farmhouse and right to an oak-clad barn where the showroom is located.</p>
                        </div>

                    <div class="width-contain-700 intro">
                        <?= do_shortcode(wpautop(get_the_content())); ?>
                    </div>
                </div>
            </section>
        </div>




	<footer class="entry-footer">
		<? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	</footer>
    <? include(locate_template('/partials/cta.php')); ?>
</main>
<? get_footer(); ?>