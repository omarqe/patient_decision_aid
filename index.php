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
		<div class="ribbon animated fadeInDown">
			<?php o( 'cookie_use', '', __( '<a>%s</a>', u('cookie_use_policy')) ); ?>
			<a class="dismiss">&times;</a>
		</div>
	</div>

	<section class="active" style="background-image:url(images/alice-moore-192526.jpg); color:#fff !important">
		<?php init_locale('main'); ?>
		<div class="main-overlay centralized" style="background:rgba(255,82,82,.7)">
			<div class="content animated fadeIn">
				<?php
				_e( '<h1>%s</h1>', u('header') );
				_e( '<h5 class="subtitle">%s</h5>', u('subtitle') );
				?>
				<form method="post" autocomplete="off" data-invoke="begin">
				<div class="btn-action">
					<input type="text" class="form-control trans text-center" style="margin:0 auto 10px; width:180px; text-transform:capitalize" placeholder="Nickname" name="nickname" maxlength="15">
					<button class="btn btn-submit"><?php o('begin'); ?></button>
				</div>
				</form>
			</div>
		</div>
	</section>

	<section style="background:rgb(38,50,56) url(images/videos/Shoes.jpg); color:#fff">
		<?php init_locale('definition'); ?>
		<video autoplay loop muted>
			<source src="images/videos/Shoes.mp4" type="video/mp4">
			<source src="images/videos/Shoes.webm" type="video/webm">
		</video>

		<div class="main-overlay centralized" style="background:rgba(255,124,129,.8)">
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
									<a class="btn btn-pink btn-sm" data-stage="<?php _e($i); ?>" data-invoke="choose_stage"><?php _e("%s &rarr;", u('see_options')); ?></a>
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
		<?php init_locale("worries", "treatment"); ?>
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
					<?php _e('<a class="btn btn-pink btn-sm" data-invoke="next_page">%s &rarr;</a>', u('continue')); ?>
				</div>
			</div>
		</div>
	</section>

	<section>
		<?php init_locale('concerns', 'treatment'); ?>
		<div class="section-container centralized">
			<div class="content">
				<?php
				_e( '<h1>%s</h1>', u('header', '', '<span data-bind="nickname" style="text-transform:capitalize">Jane</span>') );
				_e( '<h5 class="subtitle">%s<div class="btn-action" style="margin-top:10px"><a class="btn btn-dark btn-xs" data-invoke="prev_page">&larr; %2$s</a></div></h5>',
					u('subtitle', '', '<span class="nickname" data-bind="nickname">Jane</span>'), u('previous') );
				?>

				<form method="post" data-invoke="concern">
				<div class="compartment">
					<table class="table table-pda">
						<thead>
							<tr>
								<th style="width:50%">I prefer surgery because</th>
								<th style="width:50%">I don't prefer surgery because</th>
							</tr>
						</thead>
						<tbody class="text-left">
							<?php
							foreach ( get_surgery_preferables() as $prefer_i => $prefer_values ):
								list($prefer_positive, $prefer_negative) = get_list([0,1], $prefer_values);
							?>
							<tr>
								<td>
									<div class="checkbox no-padding">
										<?php
										_e(
											'<input type="checkbox" name="surgery_prefer_pos[]" value="%1$s" id="%2$s">' .
											'<label for="%2$s">%3$s</label>',

											$prefer_positive,
											gen_id($prefer_positive),
											u($prefer_positive)
										);
										?>
									</div>
								</td>
								<td>
									<div class="checkbox no-padding">
										<?php
											_e(
												'<input type="checkbox" name="surgery_prefer_neg[]" value="%1$s" id="%2$s">' .
												'<label for="%2$s">%3$s</label>',

												$prefer_negative,
												gen_id($prefer_negative),
												u($prefer_negative)
											);
										?>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<div class="compartment text-left">
					<h4>I am concern ...</h4>
					<?php
					for ( $concern_i=1; $concern_i<=8; $concern_i++ ){
						$concern_input_name = "concern_option{$concern_i}";

						_e( '<div class="checkbox">' );
						_e( 
							'<input type="checkbox" name="concerns[]" value="%1$s" id="%2$s">'.
							'<label for="%2$s">%3$s</label>',
							$concern_input_name,
							gen_id($concern_input_name),
							u($concern_input_name)
						);
						_e( '</div>' );
					}
					?>
				</div>

				<div class="compartment text-left">
					<h4>Do you need more support?</h4>
					<table class="table table-striped">
						<tbody>
							<?php
							for ( $support_i=1; $support_i<=5; $support_i++ ):
								$support_input_name = "support_option{$support_i}";
								$support_input_id = gen_id($support_input_name);
							?>
							<tr>
								<td style="width:80%" data-label_required="<?php _e($support_input_name) ?>"><?php o($support_input_name) ?></td>
								<td style="width:10%">
									<div class="radio no-padding">
										<?php
										_e( '<input type="radio" name="%1$s" id="%2$s" value="yes" data-required="%1$s">', $support_input_name, $support_input_id );
										_e( '<label for="%1$s">%2$s</label>', $support_input_id, u('yes_text') );
										?>
									</div>
								</td>
								<td style="width:10%">
									<div class="radio no-padding">
										<?php
										_e( '<input type="radio" name="%1$s" id="n_%2$s" value="no" data-required="%1$s">', $support_input_name, $support_input_id );
										_e( '<label for="n_%1$s">%2$s</label>', $support_input_id, u('no_text') );
										?>
									</div>
								</td>
							</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>

				<div class="compartment text-left">
					<h4><?php o('ready_prompt'); ?></h4>
					<div class="form-group">
						<label data-label_required="ready_for_decision"><?php o("ready_decision_prompt"); ?></label>
						<div class="radio" style="padding-bottom:5px">
							<input type="radio" name="ready_for_decision" id="ready_for_decision_yes" data-required="ready_for_decision" value="yes">
							<?php _e( '<label for="ready_for_decision_yes">%s</label>', u('yes_text') ); ?>
						</div>
						<div class="radio">
							<input type="radio" name="ready_for_decision" id="ready_for_decision_no" data-required="ready_for_decision" value="no">
							<?php _e( '<label for="ready_for_decision_no">%s</label>', u('no_text') ); ?>
						</div>
					</div>
					
					<div class="form-group">
						<label data-label_required="ready_for_treatment"><?php o('ready_treatment_prompt'); ?></label>
						<?php
						foreach ( ['lumpectomy', 'mastectomy', 'alternative', 'no_treatment'] as $ready_locale_key ){
							$ready_treatment_id = gen_id("ready_treatment_$ready_locale_key");

							_e( '<div class="radio" style="padding-bottom:5px">' );
							_e( '<input type="radio" name="ready_for_treatment" data-required="ready_for_treatment" id="%2$s" value="%1$s">', $ready_locale_key, $ready_treatment_id );
							_e( '<label for="%2$s">%1$s</label>', u($ready_locale_key), $ready_treatment_id );
							_e( '</div>' );
						}
						?>
					</div>
				</div>

				<div class="compartment text-left">
					<h4 style="margin-bottom:5px"><?php o('extras_prompt', '', '<span class="nickname" data-bind="nickname">Jane</span>'); ?></h4>
					<h5 class="subtitle light"><label for="extras"><?php o('extras_sub'); ?></label></h5>
					<textarea class="form-control" placeholder="" id="extras" name="extras"></textarea>
				</div>

				<div class="btn-action text-right">
					<input type="hidden" name="action" value="concern">
					<button class="btn btn-pink btn-sm">Continue &rarr;</button>
				</div>
				</form>
			</div>
		</div>
	</section>

	<section>
		<?php init_locale("download"); ?>
		<div class="section-container centralized">
			<div class="content" style="width:40%">
				<?php
				_e( '<h1>%s</h1>', u('header', '', '<span data-bind="nickname" class="nickname">Jane</span>') );
				_e( '<h5 class="subtitle">%s<div class="btn-action" style="margin-top:10px"><a class="btn btn-dark btn-xs" data-invoke="prev_page">&larr; %2$s</a></div></h5>',
					u('subtitle'), u('previous') );
				?>

				<div class="btn-action">
					<br class="separator small" style="margin-bottom:30px">
					<div class="small" style="margin-bottom:5px">
						<div class="checkbox">
							<input type="checkbox" name="accept_data_keep" id="accept_data_keep" checked>
							<label for="accept_data_keep"><?php o('agree_data_keep'); ?></label>
						</div>
					</div>
					<a class="btn btn-pink" href="./download.php" target="_blank"><i class="fa fa-download"></i> Download</a>
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