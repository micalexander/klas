		</div> <!-- End .content-wrapper -->

		<div class="footer-wrapper">
			<footer class="container">
		        <div class="grid">
		        	<div class="nav-wrapper unit one-of-one">
		        		<nav class="footer">
		        			<?php wp_nav_menu( array( 'theme_location' => 'primary-footer-menu', 'container' => false) ); ?>
		        		</nav>
					</div>
					<p class="copy unit one-of-one">&copy; copyright <?php echo date("Y"); ?> Company</p>
				</div>
			</footer>
		</div>

	<?php wp_enqueue_script( 'js-combo', get_bloginfo( 'template_directory' ) . '/js/script.js', array('jquery')); ?>

	<?php wp_footer(); ?><!-- required don't remove -->

	</body>
</html>
