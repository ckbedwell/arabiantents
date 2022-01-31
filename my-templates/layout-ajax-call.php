<?
/*
 * Template Name: Layout Ajax Call
 * Description: Display all the Team Members on the website.
 */

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main, point-five-trans'); ?> role="main">

        <? get_template_part('featured-image'); ?>

        <div class="entry-content scrollto-padding" id="scrollto-entry-content">
            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section class="entry-content">
                <div class="width-contain">
                    <div class="full">
                        <div class="four-fifths no-padding-left">
                            <select multiple class="chosen-select" data-placeholder="Browse or search for furniture">
                                <?
                                WP_reset_query();
                                $terms = get_terms('furniture_type');

                                foreach($terms as $term){
                                    $termID = $term->slug;
                                    $termName = $term->name;

                                    $args = array (
                                        'post_type' => 'furniture',
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'furniture_type',
                                                'field' => 'slug',
                                                'terms' => $termID
                                               )
                                           )
                                       );

                                    $furnitureQuery = new WP_Query($args);
                                    echo '<optgroup label="' . $termName . '">';
                                    while($furnitureQuery->have_posts()) {

                                        $furnitureQuery->the_post();
                                        $title = get_the_title();
                                        $lower = strtolower($title);
                                        $lower = str_replace(' ', '-', $lower);
                                        $id = get_the_ID();
                                        echo $lower;
                                        echo '<option value="'. $id . '">' . $title . '</option>';
                                        }
                                    echo '</optgroup>';
                                    }
                                    ?>
                                </select>
                                <input class="edgefix" style="opacity: 0; width: 0; position: absolute; z-index: -10;">
                            </div>
                            <div class="fifth no-padding-right">
                                <button type="button" class="furniture-add">Add Items</button>
                            </div>
                    </div>

                    <table class="furniture-table text-center gallery">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="table-name">Name</th>
                                <th class="table-quantity">Quantity</th>
                                <th class="table-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>




	<footer class="entry-footer">
		<? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	</footer>

<? get_footer(); ?>
