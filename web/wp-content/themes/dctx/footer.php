	<?php include_once('partials/members.php'); ?>

	<?php include_once('partials/sponsors.php'); ?>

	<?php include_once('partials/get-involved.php'); ?>

	<footer id="footer">
		<img src="<?php echo IMAGES; ?>logo-big.svg" alt="DevCon Community of Technology eXperts" width="90">

		<p>DevCon Community of Technology eXperts</p>

		<?php 
			wp_nav_menu(array(
				'theme_location' => 'footer',
				'container' => '',
				'container_class' => '',
				'menu_class' => 'clearfix'
			)); 
		?>

		<?php
			$from_year = 2020; 
			$this_year = (int) date('Y'); 
			$date = $from_year . (($from_year != $this_year) ? ' - ' . $this_year : '');
		?>

		<p>&copy; <?php echo $date; ?> <a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>. All rights reserved.</p>
	</footer>

	<a href="#" id="back-to-top" title="Back to top"><i class="fa fa-arrow-circle-o-up"></i></a>

	<?php wp_footer(); ?>

	<?php if (is_page(24)): ?>
		<script>
			(function($) {
				$(document).ready(function() {
					$('.button-learn-more').click(function() {
						$('html, body').animate({
							scrollTop: $('#preventions').offset().top - 60
						}, 500);
					});
				});
			})(jQuery);
		</script>
	<?php endif; ?>
</body>
</html>
