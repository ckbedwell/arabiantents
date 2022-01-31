<?
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */
?>
<? timer_start(); ?>
<? if (isset($_GET['enquiry'])) { if ($enquiry = $_GET['enquiry']) { $active = 'active-overlay'; } } ?>
<!DOCTYPE html>
<html <? language_attributes(); ?> class="<? if (isset($active)) { echo $active; } ?> no-js" id="html">
<head>
    <!-- Pinterest verification -->
    <meta name="p:domain_verify" content="2aea98e6f4694a068f2d03dd8eb83768"/>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WJPMVD5');</script>
    <!-- End Google Tag Manager -->

    <meta charset="<? bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="F1_bijUcJ0wEU5Db3ED2lr5Wqy-E-XrTv_Na-hw4CsY" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<? bloginfo('pingback_url'); ?>">

    <? wp_head(); ?>
    <?
    $font_url = get_field( 'font_url', 'options' );
    $font_family = get_field( 'font_family', 'options' );
    $font_weight = get_field( 'font_weight', 'options' );
    if ($font_url && $font_family):
        ?>
        <link rel="stylesheet" href="<?= $font_url; ?>">
        <style>
            h1, h2 {
                font-family: <?= $font_family; ?>;
                font-weight: <?= $font_weight ? $font_weight : 400; ?>;
            }
        </style>
    <?php endif; ?>
    <script src="https://assets.what3words.com/sdk/v3/what3words.js"></script>
</head>

<body <? body_class(); ?>>
<div style="display: none;">
        <pre>
            <?php echo get_page_template(); ?>
        </pre>
</div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJPMVD5" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page" class="hfeed site">
    <header class="parent-contain point-four-trans site-header" role="banner">
        <div class="top-bar">
            <div class="width-contain">
                <? if (is_active_sidebar('contact-details') || is_active_sidebar('contact-details')) { dynamic_sidebar('contact-details'); } ?>
            </div>
        </div>

        <div class="width-contain width-contain-750-mob">
            <div class="site-branding point-three-trans aligncenter">
                <a class="point-three-trans image-link" href="<?= esc_url(home_url('/')); ?>" rel="home">
                    <img class="point-three-trans" src="/wp-content/themes/arabiantents/images/arabian-tents-logo.png" title="<? bloginfo('name'); ?>" alt="<? bloginfo('name'); ?>">
                </a>
            </div>
        </div>
        <nav class="main-navigation" role="navigation">
            <? wp_nav_menu(['theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'primary-menu', 'walker' => new Child_Wrap()]); ?>
            <? get_template_part('partials/mega-menu'); ?>
        </nav>
    </header>
    <div class="alignleft full branding-bg mobile-only mobile-banner">
        <button class="alignleft wrapper clickable more-info contact-menu" value="quick-enquiry">
            <span class="alignleft icon-phone"></span>
            <span class="vertical-align">Contact</span>
        </button>
        <button class="alignright clickable mobile-menu">
            <span class="icon-menu"></span>
            <span class="full to-open">Menu</span>
            <span class="full to-close">Close</span>
        </button>
    </div>