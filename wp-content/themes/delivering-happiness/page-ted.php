<?php
/*
Template Name: Ted
*/
get_header();
?>

<!-- /Blog section-->
<div class="ted-landing-page">
	<div class="wrapper">
		<section class="ted-hero-banner">
			<h6>"There is a difference between <span class="cl1">knowing</span> the path and <span class="cl">walking</span> the path."<br/> <smal><i>Morpheus</i>, The Matrix</smal></h6>
			<h1><img src="<?php bloginfo('template_url') ?>/assets/images/global/ted_logo.jpg"></h1>
			<div class="heading">
				<h5 align="right"><span class="tx">87%</span>of the world’s<br/>workforce is unhappy </h5>
				<h5 align="left"><span class="cl">to change the way we <br/>work... with happiness</span></h5>
			</div>
			<p>
				At Delivering Happiness we provide coaching and consulting services to help organizations <br/>
				achieve success by applying the frameworks of happiness to their internal culture. <br/>
				We're changing the world, by making happy work.
			</p>
			<article class="content">
				<iframe src="http://go.deliveringhappiness.com/l/66522/2015-03-16/9cpy" width="100%" height="67" type="text/html" frameborder="0" allowTransparency="true" style="border: 0" scrolling="no"></iframe>
			</article>
		</section>
	</div>	
	<section class="three-column blue get-involved cross-fade">
		<div class="wrapper">
			<div class="col left-col">
				<div class="download-product">
					<div class="content">
						<div class="v-aling"><h3>Download our <br/>Hello doc</h3></div>
					</div>
				</div>
				<div class="hover-content">
					<div class="v-aling">
						<p></p>
						<a href="#" class="button blue" onclick="jQuery('#download_roadmap_form').show();return false;">Download</a>
					</div>
				</div>
			</div>
			<div class="col middle-col">
				<div class="calculate">
					<div class="content">
						<div class="v-aling"><h3>Calculate<br/>your<br/>happiness</h3></div>
					</div>
				</div>
				<div class="hover-content">
					<div class="v-aling">
						<p>Unhappy employees cost the U.S. $550 billion a year (Gallup). How much could happiness save you?</p>
						<a href="<?php echo home_url(); ?>/services/calculate-your-roi/" class="button blue">LET’S CALCULATE!</a>
					</div>
				</div>
			</div>
			<div class="col right-col">
				<div class="work-survey">
					<div class="content">
						<div class="v-aling"><h3>Take the<br/>happiness at<br/>work survey</h3></div>
					</div>
				</div>
				<div class="hover-content">
					<div class="v-aling">
						<p>Are you happy at work? The results will show what you like and what needs to change.</p>
						<a href="<?php echo home_url(); ?>/services/the-happiness-at-work-survey" class="button blue">LET’S GO!</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="rounded-block happy-work">
		<div class="modal-box" id="download_roadmap_form" style="display:none;">
			<p>Please enter your information below to download our Hello Doc and find out how Delivering Happiness helps organizations create their own unique and sustainable work cultures to unleash happiness, human potential and business success. </p>
			<?php //gravity_form(6, true, true, false, null, true); ?>
			<iframe src="http://go.deliveringhappiness.com/l/66522/2015-02-16/42kr" width="100%" height="270" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
			<p>We value your privacy. Read our <a href="/privacy/">Privacy Policy</a>.</p>
			<span class="close">close</span>
		</div>
	</section>
<!-- /Get involved section-->
</div>

<?php get_footer(); ?>