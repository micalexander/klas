<?php get_header(); ?>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?><!-- start loop -->

			<section>
				<?php if ( ! post_password_required() ) :?>
				<div class="container">
					<div class="grid">
						<?php get_template_part( 'inc/gridpress/_page-views' ); ?>
					</div>
				</div>
				<?php else: ?>
				    <form class="password-protected" action="<?php get_bloginfo('site_url'); ?>/wp-login.php?action=postpass" method="post">
				    <p>This page is password protected. Please enter your password below:</p>
				    <p><input name="post_password" id="" type="password" size="20" /><input type="submit" name="Submit" value="Submit" /></p>
				    </form>
				<?php endif; ?>
			</section>

			<?php get_sidebar(); ?>

	<?php endwhile; endif; ?><!-- end loop -->
<?php get_footer(); ?>
