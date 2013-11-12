		</div> <!-- End .content-wrapper -->

		<div class="footer-wrapper">
			<footer class="container">
		        <div class="grid">
		        	<div class="nav-wrapper unit one-of-one">
		        		<?php wp_nav_menu( array( 'theme_location' => 'primary-footer-menu', 'container' => false) ); ?>
						<p>&copy; <?php echo date("Y"); ?> Company Name.</p>
					</div>
				</div>
			</footer>
		</div>

	<?php wp_enqueue_script( 'js-combo', get_bloginfo( 'template_directory' ) . '/js/public/script.js', array('jquery')); ?>

	<?php wp_footer(); ?><!-- required don't remove -->

	</body>
</html>
