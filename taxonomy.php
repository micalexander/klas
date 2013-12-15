<?php
/**
 * Template Name: Taxonomy template
 */
?>
<?php get_header(); ?>

		<section>

			<div class="container">
				<div class="grid">
					<?php get_template_part( 'inc/gridpress/taxonomy/_taxonomy-views' ); ?>
				</div>
			</div>

		</section>

		<?php get_sidebar(); ?><!-- optional -->

<?php get_footer(); ?>
