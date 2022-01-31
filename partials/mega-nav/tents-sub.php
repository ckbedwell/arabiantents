<?
    function display_tents($tent_type, $specific = null) {
        $args = array(
            'post_type' => ['tent', 'product'],
            'tent_type' => $tent_type
           );

        $query = new WP_Query($args);

        while ($query->have_posts()) : $query->the_post();
                $featuredImage = get_the_featured_image($post->ID);
                $count = $query->post_count;
                if($specific != null) {
                    $size = $specific;
                    }
                else {
                    $size = sized_by_count($count, 'half', 'fifth', true);
                    }
                ?>
                <div class="<?= $size; ?>-margined no-padding" id="post-<? the_ID(); ?>">
                    <div class="full wrapper">
                        <a href="<? the_permalink(); ?>" class="full display-card featured-image image-link" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></a>
                        <? the_title(); ?>
                    </div>
                </div>
                <? endwhile;
        }

?>

<section class="tents-sub">
        <div class="width-contain-1000">
            <div class="full no-padding additional-info">
                <ul class="dropdown-menu" role="menu">
                    <li data-submenu-id="submenu-frame-tent-collection">
                        <span class="targeter maintainHover"><a href="/tents/frame-tent-collection">Frame Tent</a></span>
                        <div class="point-three-trans popover submenu-frame-tent-collection" style="display: block;">
                            <? display_tents('frame-tent-collection', 'sixth'); ?>
                        </div>
                    </li>

                    <li data-submenu-id="submenu-pole-tents">
                        <span class="targeter"><a href="/tents/pole-tents">Pole Tents</a></span>

                        <div class="point-three-trans popover submenu-pole-tents">
                            <? display_tents('pole-tents'); ?>
                        </div>
                    </li>

                    <li data-submenu-id="submenu-pearl-tents">
                        <span class="targeter"><a href="/tents/pearl-tents">Pearl Tents</a></span>

                        <div class="point-three-trans popover submenu-pearl-tents">
                            <? display_tents('pearl-tents', 'third'); ?>
                        </div>
                    </li>

                    <li data-submenu-id="submenu-stretch-tents">
                        <span class="targeter"><a href="/tents/stretch-tents">Stretch Tents</a></span>
                        <a href="/tents/stretch-tents" class="point-three-trans popover submenu-stretch-tents">
                            <h3>Stretch Tents</h3>
                            <p class="width-contain-320 alignleft">These organic, free-form tents give a modern twist to events and with our beautiful draping and lighting options they can be transformed to cover occasions that no other tent can reach!</p>
                            <span class="icon-arrow-right"></span>
                        </a>
                    </li>

                    <li data-submenu-id="submenu-clearspan-marquees">
                        <span class="targeter"><a href="/tents/clearspan-marquees">Clearspan Marquees</a></span>
                        <a href="/tents/clearspan-marquees" class="point-three-trans popover submenu-clearspan-marquees">
                            <h3>Clearspan Marquees</h3>
                            <p class="width-contain-320 alignleft">These practical clearspan marquees are often used when covering large numbers of people and are fitted with our linings, drapes and lighting to build immense event spaces.</p>
                            <span class="icon-arrow-right"></span>
                        </a>
                    </li>

                    <li data-submenu-id="submenu-glamping">
                        <span class="targeter"><a href="/tents/glamping">Glamping</a></span>
                        <div class="point-three-trans popover submenu-glamping">
                        <? display_tents('glamping', 'quarter'); ?>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </section>
