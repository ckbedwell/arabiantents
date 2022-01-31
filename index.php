<?php get_header(); ?>
	<main class="site-main" role="main">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('content', get_post_format()); ?>
			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>
		<?php else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>
	</main>
<?php get_footer(); ?>
