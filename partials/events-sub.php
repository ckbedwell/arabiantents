<?
// CAN'T USE A UNIVERSAL FUNCTION FOR EACH NAV SECTION WITHOUT MAKING IT OVERLY COMPLICATED. REDEFINED PER NAVIGATION SECTION / FILE.

function third_level_nav($id) {
        $ideas = wp_get_post_tags($id);
        $count = count($ideas);
        $size = sized_by_count($count, 'half', 'fifth', true);
        foreach($ideas as $idea) : ?>
            <div class="<?= $size; ?>-margined no-padding">
                <a href="<?= get_term_link($idea); ?>" class="full display-card-small image-link additional-service-catering" title="<?= get_term($idea)->name; ?>" style="background-image:url(<?= get_field('term_image', 'post_tag' . '_' . get_term($idea)->term_id); ?>);"></a>
                <?= get_term($idea)->name; ?>
            </div>
    <? endforeach;
    }

?>

<section class="events-sub">
        <div class="width-contain-1000">
            <div class="full no-padding additional-info">


            <div class="sub-menu-full text-center">


                    <div class="fifth-margined no-padding six-elements_kmp">
                        <a class="full display-card-small image-link additional-service-wine"  href="/event-design/weddings" style="background-image:url(/wp-content/uploads/2016/01/Viva-la-Fiesta-couple.jpg);"></a>
                        Weddings
                    </div>

                    <div class="fifth-margined no-padding six-elements_kmp">
                       <a class="full display-card-small image-link additional-service-wine" href="/event-design/parties" style="background-image:url(/wp-content/uploads/2016/03/Screen-Shot-2016-03-24-at-11.36.37.png);"></a>
                       Parties
                    </div>

                    <div class="fifth-margined no-padding six-elements_kmp">
                        <a class="full display-card-small image-link additional-service-wine" href="/event-design/christmas-decorators" style="background-image: url(/wp-content/uploads/2018/08/JessicaMilbergPhotographyCommercialPhotographer-NEW-2.jpg);"></a>
                        Christmas
                    </div>

                    <div class="fifth-margined no-padding six-elements_kmp">
                       <a class="full display-card-small image-link additional-service-wine" href="/event-design/festivals" style="background-image:url(/wp-content/uploads/2016/01/party.jpg);"></a>
                       Festivals
                    </div>
                    <div class="fifth-margined no-padding six-elements_kmp">
                        <a class="full display-card-small image-link additional-service-wine" href="/event-design/corporate" style="background-image:url(/wp-content/uploads/2019/03/corporate_optimised.jpg);"></a>
                        Corporate
                    </div>
                    <div class="fifth-margined no-padding six-elements_kmp">
                        <a class="full display-card-small image-link additional-service-wine" href="/galleries/ideas" style="background-image:url(/wp-content/uploads/2018/12/club-cairo-Jessica-Milberg-Photography-.jpg);"></a>
                        Event styling ideas
                    </div>
                </div>
            </div>
        </div>

</section>