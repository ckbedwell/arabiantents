<?
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package digicrab
 */
?>
            <footer class="parent-contain point-five-trans site-footer" role="contentinfo">
                <div class="parent-contain footer-info">
                    <div class="width-contain width-contain-750-mob">
                         <div class="alignright two-thirds">
                            <div class="award-winning-banner">
                                <div>
                                    <img data-src="/wp-content/themes/arabiantents/images/british-awards.jpg">
                                </div>
                                <div>
                                <a href="https://www.youtube.com/watch?v=eAq0liEcCV8" target="_blank"><img data-src="/wp-content/uploads/2019/01/Award-Logo.png"></a>
                                    
                                </div>

                                <div>
                                    <img data-src="/wp-content/themes/arabiantents/images/House-of-Hud-300x300.png">
                                </div>
                                <div>
                                    <img src="/wp-content/themes/arabiantents/images/festival-winner.jpg">
                                </div>
                                <div>
                                    <img src="/wp-content/themes/arabiantents/images/TWG-2019.jpg">
                                </div>
                            </div>

                             <p class="smallFont">We are a passionate, award-winning and inter-disciplinary team focused on making your next event a huge success.</p>

                            <div class="alignleft full row-padding-small wrapper">
                                <nav class="alignleft vertical-align footer-navigation" role="navigation">
                                    <? wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu')); ?>
                                </nav>
                                <? if (is_active_sidebar('contact-details') || is_active_sidebar('contact-details')) { dynamic_sidebar('contact-details'); } ?>
                            </div>
                        </div>

                        <div class="alignleft third">
                            <h4 class="site-branding"><a href="<?= esc_url(home_url('/')); ?>" rel="home"><? bloginfo('name'); ?></a></h4>
                            <? if (is_active_sidebar('address-details') || is_active_sidebar('address-details')) { dynamic_sidebar('address-details'); } ?>
                            <div style="font-size: 12px; margin-top:20px;"><p>Copyright © <?php echo date("Y"); ?></p></div>
                        </div>
                    </div>
                </div>
        	</footer>
        </div>

        <? include(locate_template('/partials/enquiry-reminders.php')); ?>
        <? include(locate_template('/partials/overlays.php')); ?>

        <script>
            document.getElementById('html').classList.remove('no-js');
        </script>

        
		<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-105815387-1', 'auto');
        </script>

        <style>
            #iframe-designstudio-button {
              padding: 0;
            }
        </style>
        <script scr="<?= get_template_directory_uri() ?>/js/js.js"></script>
        <? wp_footer(); ?>
        <p class="admin-only hide"><?= get_num_queries(); ?> queries in <? timer_stop(1, 5); ?> seconds. </p>
        
        
        
<div id="off-canvas-search" class="dark-div">
    	<div class="search-inner">
        <div class="width-contain">
            <form action="#">
                <input name="s" id="leaf-seach" class="form-control search-field" placeholder="TYPE AND HIT ENTER..." autocomplete="off" type="text">
                <a href="#" class="search-toggle"><i class="icon-cross"></i></a>
            </form>
        </div>
        </div>
    </div>

    </body>
</html>