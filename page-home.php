<?php get_header(); ?>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?><!-- start loop -->

		<section>
			<div class="container">
				<div class="grid">
					<?php get_template_part( 'inc/gridpress/_views' ); ?>
				</div>
			</div>
		</section>

		<?php get_sidebar(); ?>

	<?php endwhile; endif; ?><!-- end loop -->
<?php get_footer(); ?>