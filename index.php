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

	<section class="active" style="background-image:url(images/alice-moore-192526.jpg); color:#fff !important">
		<?php init_locale('main'); ?>
		<div class="main-overlay centralized" style="background:rgba(255,82,82,.7)">
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

	<section style="background:rgb(38,50,56) url(images/videos/Shoes.jpg); color:#eee">
		<?php init_locale('definition'); ?>
		<video autoplay loop muted>
			<source src="images/videos/Shoes.mp4" type="video/mp4">
			<source src="images/videos/Shoes.webm" type="video/webm">
		</video>

		<div class="main-overlay centralized" style="background:rgba(255,82,82,.9)">
			<div class="content">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s<div class="btn-action" style="margin-top:10px"><a class="btn btn-xs" data-invoke="prev_page">&larr; Previous page</a></div></h5>', u('subtitle') );
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
									<a class="btn btn-pink btn-sm" data-invoke="next_page"><?php _e("%s &rarr;", u('see_options')); ?></a>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</section>

	<section>
		<?php init_locale('treatment'); ?>
		<div class="section-container centralized">
			<div class="content" style="width:80%">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s<div class="btn-action" style="margin-top:10px"><a class="btn btn-dark btn-xs" data-invoke="prev_page">&larr; %2$s</a></div></h5>',
					u('subtitle'), u('previous') );
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
					<div class="col-md-3 grid-item">
						<div class="white-card hoverable">
							<div class="content text-left">
								<?php
								_e( '<h4><span class="num-badge %3$s">%d</span> %s</h4>',
									++$treatment_i, u($treatment_key), $treatment_i!=4?"pink":"red" ); ?>
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

					<div class="col-md-12 grid-item">
						<div class="btn-action text-right">
							<a class="btn btn-pink btn-sm" data-invoke="next_page"><?php _e('%s &rarr;', u('continue')); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<?php init_locale("worries", "ajax"); ?>
		<div class="section-container centralized">
			<div class="content" style="width:40%">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s<div class="btn-action" style="margin-top:10px"><a class="btn btn-dark btn-xs" data-invoke="prev_page">&larr; %2$s</a></div></h5>',
					u('subtitle'), u('previous') );
				?>

				<div class="compartment">
					<div class="white-card">
						<div class="content text-left">
							<form method="post" data-invoke="choose_worry">
							<?php for ( $worry_i=1; $worry_i<=8; $worry_i++ ): $worry_hash = substr(hash('md5', $worry_i), 0, 8); ?>
							<div class="checkbox">
								<?php
								_e( '<input type="checkbox" name="worries[]" value="%1$d" id="%2$s">', $worry_i, $worry_hash );

								$worry_sub = u("enquiry{$worry_i}_sub");
								$worry_sub = $worry_sub != 'undefined'
									? __( ' <small class="light">%s</small></label>', $worry_sub )
									: '';


								_e( '<label for="%1$s">%2$s%3$s</label>', $worry_hash, u("enquiry{$worry_i}"), $worry_sub );
								?>
							</div>
							<?php endfor; ?>

							<br class="separator">
							<div class="btn-action text-right" style="margin-top: 0">
								<input type="hidden" name="action" value="worries">
								<button class="btn btn-pink btn-sm btn-submit"><?php _e('%s &rarr;', u('continue')); ?></button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="section-container centralized">
			<div class="content" style="width:60%">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s<div class="btn-action" style="margin-top:10px"><a class="btn btn-dark btn-xs" data-invoke="prev_page">&larr; %2$s</a></div></h5>',
					u('subtitle'), u('recompare') );
				?>

				<div class="compartment">
					<table class="table table-striped table-pda">
						<thead>
							<tr>
								<th style="width:20%">&nbsp;</th>
								<th style="width:20%">Lumpectomy</th>
								<th style="width:20%">Mastectomy</th>
								<th style="width:20%">Alternative treatment</th>
								<th style="width:20%">No treatment</th>
							</tr>
						</thead>

						<tfoot>
							<tr>
								<th style="width:20%">&nbsp;</th>
								<th style="width:20%">Lumpectomy</th>
								<th style="width:20%">Mastectomy</th>
								<th style="width:20%">Alternative treatment</th>
								<th style="width:20%">No treatment</th>
							</tr>
						</tfoot>

						<tbody class="text-left" id="worry_answers">
							<tr>
								<td colspan="5" class="text-center" style="padding:30px 10px">
									<p>Nothing to compare. Please go back to the previous page and try again.</p>
									<div class="btn-action" style="margin-top:10px">
										<?php _e('<a class="btn btn-dark btn-xs" data-invoke="prev_page">&larr; %s</a>', u('previous')); ?>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="btn-action text-right">
					<?php _e('<a class="btn btn-pink" data-invoke="next_page">%s &rarr;</a>', u('continue')); ?>
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