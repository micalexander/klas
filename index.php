<?php get_header(); ?>

		<section>

			<div class="container">
				<div class="grid">
					<?php get_template_part( 'inc/gridpress/_page-views' ); ?>
				</div>
			</div>

			<nav role="navigation" class="single-post-nav">
				<?php posts_nav_link('|;','&laquo; Newer Posts ','Older Posts &raquo;'); ?>
			</nav>

		</section>

		<?php get_sidebar(); ?>

<?php get_footer(); ?>
