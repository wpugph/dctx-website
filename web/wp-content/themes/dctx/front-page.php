<?php get_header(); ?>

<section class="hero">
	<div class="container clearfix">
		<div>
			<h2>DevCon Community of Technology eXperts<br>A project of DevCon &amp; DOST</h2>

			<p>With deep talents in digital technology, the Developers Connect (DevCon) organization formed DCTx or DevCon Community of Technology Experts, a volunteer-based worldwide community of experts from various fields working in partnership with the Department of Science and Technology (DOST) to develop digital platforms and solutions to help fight the COVID-19 pandemic.</p>

			<div class="button-group">
				<a class="button" href="#">Learn More</a>
				<a class="button" href="#">Contact Us</a>
			</div>
		</div>

		<div>
			<img src="<?php echo IMAGES; ?>logo-big.svg" alt="DevCon Community of Technology eXperts">
		</div>
	</div>
</section>

<section class="solutions" id="solutions">
	<div class="container clearfix">
		<h2 class="align-center">Our Solutions are</h2>

		<div class="cards display-flex flex-row">
			<div class="card display-flex flex-row flex-image-text">
				<div class="card-image card-image-user-search">
					<img src="<?php echo IMAGES; ?>icon-user-search.svg" alt="Be User-Friendly and for Mass Adoptation">
				</div>

				<div class="card-content">
					<h3>Scalability-Tested</h3>
					<p>We design solutions that are easy to use and can be quickly implemented, used and successfully adopted by the public.</p>
				</div>
			</div>

			<div class="card display-flex flex-row flex-image-text">
				<div class="card-image card-image-management">
					<img src="<?php echo IMAGES; ?>icon-management.svg" alt="Be Managed by Proper Authorities">
				</div>

				<div class="card-content">
					<h3>Cybersecure</h3>
					<p>Our solutions will be managed by the proper authorities such as health, government, and disaster relief agencies. </p>
				</div>
			</div>

			<div class="card display-flex flex-row flex-image-text">
				<div class="card-image card-image-user">
					<img src="<?php echo IMAGES; ?>icon-user.svg" alt="Be User-Initiated and Self-Sovereign">
				</div>

				<div class="card-content">
					<h3>Vulnerability-Tested</h3>
					<p>Our solutions will allow information to be user-initiated and self-sovereign, meaning here is better control over user data.</p>
				</div>
			</div>

			<div class="card display-flex flex-row flex-image-text">
				<div class="card-image card-image-shield">
					<img src="<?php echo IMAGES; ?>icon-shield.svg" alt="Protect the Privacy of Individuals">
				</div>

				<div class="card-content">
					<h3>Privacy-Protected</h3>
					<p>Our solutions will include features and security to protect user and user-provided data under the Data Privacy Act.</p>
				</div>
			</div>

			<div class="card display-flex flex-row flex-image-text">
				<div class="card-image card-image-open-source">
					<img src="<?php echo IMAGES; ?>icon-open-source.svg" alt="Be OPENSOURCED as ASF license">
				</div>

				<div class="card-content">
					<h3>Platform-Resilient</h3>
					<p>Our solutions will be open-sourced with Apache Software Foundation to accelerate  transparency, reliability and collaboration.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include_once('partials/volunteer.php'); ?>

<section class="projects" id="projects">
	<div class="container clearfix">
		<h2>Projects in development</h2>

		<div id="rapidpass">
			<div>
				<h3><img src="<?php echo IMAGES; ?>rapidpass-logo.svg"> RapidPass</h3>
				<p>A mobile verification app that quickly IDs and verifies authorized personnel and vehicles in checkpoints.</p>
	
				<ul>
					<li><i class="fa fa-check"></i> 2-step registration via unique SMS or emai</li>
					<li><i class="fa fa-check"></i> Printable QR code passes as ID cards or vehicle sticker</li>
					<li><i class="fa fa-check"></i> Quick scan via QR code equals quick pass in checkpoints and restricted areas</li>
				</ul>

				<a class="button" href="#">Learn more</a>
			</div>

			<img src="<?php echo IMAGES; ?>rapidpass-iphone.svg">
		</div>

		<div id="tracecovid">
			<div>
				<h3><img src="<?php echo IMAGES; ?>tracecovid-logo.svg"> TraceCOVID</h3>
				<p>A mobile app that shows the latest mapping of DOH-verified hotspots of COVID-19, and available facilities where users can get tested.</p>
	
				<ul>
					<li><i class="fa fa-check"></i> Find Covid-19 hotspots according to the latest DOH-verified data</li>
					<li><i class="fa fa-check"></i> Monitor the trend of COVID-19 cases in a selected location or hotspot</li>
					<li><i class="fa fa-check"></i> Find a testing facility in a selected location or location nearest you</li>
				</ul>

				<a class="button" href="<?php echo get_permalink(24); ?>">Learn more</a>
			</div>

			<img src="<?php echo IMAGES; ?>tracecovid-iphone.svg">
		</div>
	</div>
</section>

<?php get_footer(); ?>
