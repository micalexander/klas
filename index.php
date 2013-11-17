<?php get_header(); ?>

		<section>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?><!-- start loop -->

			<div class="container">
				<div class="grid">
					<?php get_template_part( 'inc/gridpress/_views' ); ?>
				</div>
			</div>

			<?php endwhile; endif; ?><!-- end loop -->

			<nav role="navigation" class="single-post-nav">
				<?php posts_nav_link('|;','&laquo; Newer Posts ','Older Posts &raquo;'); ?>
			</nav>

		</section>

		<?php get_sidebar(); ?>

<?php get_footer(); ?>
