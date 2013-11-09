<?php get_header(); ?>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?><!-- start loop -->

		<section>

			<?php get_template_part( 'partial-flexible-content' ); ?>

		</section>

		<?php get_sidebar(); ?>

	<?php endwhile; endif; ?><!-- end loop -->
<?php get_footer(); ?>