<?php
/**
 * Patient Decision Aid (PDA) for Breast Cancer.
 * 
 * This work is originally coded by @omarqe and the team members. Please keep this copyright
 * notice for legal use. Some of the codes are derived from @omarqe's previous project, Payster.
 * 
 * @author 		Omar Mokhtar Al-Asad (@omarqe)
 * @link 		http://www.payster.me
 * @package		PDA
 **/

require( dirname(__FILE__) . '/load.php' );
?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Decision Aid | Breast Cancer</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<meta name="theme-color" content="#354b5e">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="ribbon_container">
		<!-- <div class="ribbon animated fadeInDown">
			We use cookie to ensure the best experience for you. Please read our <a>cookie use policy</a>.
			<a class="dismiss">&times;</a>
		</div> -->
	</div>

	<section style="background-image:url(images/ian-schneider-39678.jpg); color:#eee !important">
		<?php init_locale('main'); ?>
		<div class="main-overlay centralized">
			<div class="content animated fadeIn">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s</h5>', u('subtitle') );
				?>
				<div class="btn-action">
					<a class="btn" data-invoke="next_page" data-anim="fadeInUp"><?php o('begin'); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section style="background:rgb(38,50,56) url(images/videos/Puzzling.jpg); color:#eee">
		<?php init_locale('definition'); ?>
		<video autoplay loop muted>
			<source src="images/videos/Puzzling.mp4" type="video/mp4">
			<source src="images/videos/Puzzling.webm" type="video/webm">
		</video>

		<div class="main-overlay centralized" style="background:rgba(38,50,56,.9)">
			<div class="content">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s</h5>', u('subtitle') );
				?>

				<div class="compartment row">
					<?php for ( $i=1; $i<=4; $i++ ): ?>
					<div class="col-md-6">
						<div class="white-card hoverable">
							<div class="content">
								<?php
								$severe_alert = '';
								if ( $i >= 3 ){
									$severe_alert = __(
										'<br class="separator small">'
										. '<div class="notice text-only red italic small" style="margin-top:20px">%s</div>'
										, u('severe_alert')
									);
								}

								_e( '<h4>%s</h4>', u("stage{$i}") );
								_e( '<div class="desc">%1$s%2$s</div>', u("stage{$i}_desc"), $severe_alert );
								?>

								<?php if ( $i < 3 ): ?>
								<div class="btn-action">
									<a class="btn btn-success btn-sm" data-invoke="next_page"><?php _e("%s &rarr;", u('see_options')); ?></a>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endfor; ?>
				</div>

				<div class="btn-action text-right">
					<a class="btn btn-xs" data-invoke="prev_page"><?php _e('&larr; %s', u('previous')); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="active">
		<?php init_locale('treatment'); ?>
		<div class="section-container centralized">
			<div class="content" style="width:60%">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s</h5>', u('subtitle') );
				?>

				<div class="compartment row masonry">
					<?php
					$treatment_options = array(
						"lumpectomy" => array(
							"desc" => "lumpectomy_desc",
							"points" => 5
						),

						"mastectomy" => array(
							"desc" => "mastectomy_desc",
							"points" => 2
						),

						"alternative" => array(
							"desc" => 4,
							"points" => 4
						),
						"no_treatment" => array(
							"desc" => "no_treatment_desc"
						)
					);
					?>

					<?php
					$treatment_i = 0;
					foreach ( $treatment_options as $treatment_key => $treatment_data ):
						list( $desc, $points ) = get_list( ['desc', 'points'], $treatment_data );
					?>
					<div class="col-md-6 col-md-offset-3 grid-item">
						<div class="white-card hoverable">
							<div class="content text-left">
								<?php
								_e( '<h4><span class="num-badge %3$s">%d</span> %s</h4>',
									++$treatment_i, u($treatment_key), $treatment_i!=4?"blue":"red" ); ?>
								<div class="desc">
									<?php
									if ( !empty($desc) ){
										if ( is_integer($desc) ){
											for ( $di=1; $di<=$desc; $di++ ){
												_e( '<p>%s</p>', u("{$treatment_key}_desc{$di}") );
											}
										} else {
											_e( '<p>%s</p>', u($desc) );
										}
									}

									if ( !empty($points) ){
										_e('<ul>');
										for ( $pi=1; $pi<=$points; $pi++ ){
											_e('<li>%s</li>', u("{$treatment_key}_p{$pi}"));
										}
										_e('</ul>');
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>

					<div class="col-md-6 col-md-offset-3 grid-item">
						<div class="btn-action text-right">
							<a class="btn btn-dark btn-sm" data-invoke="prev_page">&larr; Previous page</a>
							<a class="btn btn-green btn-sm" data-invoke="next_page">Proceed &rarr;</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="section-container centralized">
			<div class="content" style="width:40%">
				<h1>What are you worried about?</h1>
				<h5 class="subtitle">These questions are common among breast cancer patients. Choose what you're concern about and click continue.</h5>

				<div class="compartment">
					<div class="white-card">
						<div class="content text-left">
							<div class="checkbox">
								<input type="checkbox" id="0">
								<label for="0">How long will I live? <small class="light">Cancer is considered cured if it does not come back in 5 years.</small></label>
							</div>

							<div class="checkbox">
								<input type="checkbox" id="0">
								<label for="0">Will the cancer come back</label>
							</div>

							<div class="checkbox">
								<input type="checkbox" id="0">
								<label for="0">Do I need another operation?</label>
							</div>

							<div class="checkbox">
								<input type="checkbox" id="0">
								<label for="0">Will I get lymphoedema?</label>
							</div>

							<div class="checkbox">
								<input type="checkbox" id="0">
								<label for="0">Will I lose my breast?</label>
							</div>

							<br class="separator">
							<div class="btn-action text-right" style="margin-top: 0">
								<a class="btn btn-green btn-sm">Continue &rarr;</a>
							</div>
						</div>
					</div>
					<?php
					$enquiry = get_common_enquiries();
					?>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="js/assets.js"></script>
</body>
</html>