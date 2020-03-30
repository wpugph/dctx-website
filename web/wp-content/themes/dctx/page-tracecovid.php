<?php get_header(); ?>

<section class="hero">
	<div class="container clearfix">
		<div>
			<h2>Report your location.<br>Avoid transmission.</h2>
			<h4>TrackCOVID19.ph uses self check-in info to help people avoid COVID19 transmission hotspots and to speed up the contact tracing process for COVID19-positive cases.</h4>

			<div class="button-group">
				<a href="#" class="button">USE THE APP</a>
				<a href="javascript:;" class="button button-learn-more">LEARN MORE <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
			</div>
		</div>

		<div>
			<img src="<?php echo IMAGES; ?>covid-19-tracer.png" alt="COVID-19 Tracer">
		</div>
	</div>
</section>

<div class="curve">
	<img src="<?php echo IMAGES; ?>curve.svg">
</div>

<section class="preventions" id="preventions">
	<div class="container clearfix">
		<h2>Help flatten the curve.</h2>

		<div class="items clearfix">
			<div class="item">
				<h3>Self check-in</h3>
				<p>Going to the bank, store, or pharmacy? Check-in using the app to keep track of the places you’ve been.</p>
			</div>

			<div class="item">
				<h3>Avoid transmission hotspots</h3>
				<p>Monitor locations with high incidence of transmissions. Get notified when a location you visited has been visited by a COVID19-positive patient in the last 14 days.</p>
			</div>

			<div class="item">
				<h3>Speed up contact tracing</h3>
				<p>In the event that the user is confirmed COVID19-positive, upon the patient’s consent, the system will trace the patient’s location history to alert other users that were nearby.</p>
			</div>
		</div>
	</div>
</section>

<section class="about" id="about">
	<div class="container clearfix">
		<div>
			<img src="<?php echo IMAGES; ?>trace-covid-ph-logo.png" alt="traceCOVID.ph">
			<h3><strong>trace</strong>COVID.ph</h3>
		</div>

		<div>
			<h2>About traceCOVID.ph</h2>

			<p>Project TrackCOVID19.ph is a community initiative to help flatten the curb and stop the COVID19 disease from spreading, through the efforts of Filipino app developers, designers, data scientists, information security experts, and medical practitioners. </p>
			<p>TrackCOVID19.ph is an open source contact tracer platform that allows users to self-report their whereabouts to avoid COVID19 transmission hotspots and to inform the community about possible ones in the future. The platform also speeds up the contact tracing process for COVID19-positive patients through the user’s self-reported location history.</p>
		</div>
	</div>
</section>

<?php include_once('partials/volunteer.php'); ?>

<?php get_footer(); ?>
