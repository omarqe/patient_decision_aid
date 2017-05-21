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

require_once( dirname(__FILE__) . '/load.php' );
init_locale( 'worries', 'definition', 'treatment', 'concerns' );

$userdata = get_data();
$nickname = parse_arg('nickname', $userdata);
?>
<style>
h1, h2, h3, h4, h5, h6, p {
	margin: 0 0 8px
}
* {
	font-size: 15px;
	color: #333
}

h1.heading {
	font-size: 21px;
}

span.pink {
	color: #EC407A;
	font-weight: bold
}

.section {
	margin:20px 0;
}

ul li {
	padding: 0 0 10px 10px
}
</style>
<page backtop="15mm" backbottom="20mm" backleft="15mm" backright="15mm">
	<page_footer>
		<table style="width:100%">
			<tr>
				<td style="width:50%; font-size:14px; padding:10px 15mm 5mm; color:#666;">www.breastcancerpda.com</td>
				<td style="width:50%; font-size:14px; padding:10px 15mm 5mm; color:#666; text-align:right"><?php echo date('l, j F Y \a\t H:ia'); ?></td>
			</tr>
		</table>
	</page_footer>

	<div style="background:#EC407A; padding:35px 35px 30px; padding-right:0; position:relative;">
		<table style="width:100%">
			<tr>
				<td style="width:85%">
					<h1 style="font-size:35px; display:block; margin:0 0 5px; color:#fff">Patient Decision Aid</h1>
					<h2 style="font-size:15px; margin:0; color:#fff">for early stage breast cancer.</h2>
				</td>
				<td style="text-align:right"><img src="images/ribbon.png" style="width:60px; height:76px; margin-top:-6px"></td>
			</tr>
		</table>
	</div>
	<table style="width:100%; margin-top:5px; margin-bottom:40px;">
		<tr>
			<td style="width:50%; font-weight:bold; color:#EC407A; font-size:18px;"><?php echo strtoupper( $nickname ); ?></td>
			<td style="width:50%; font-weight:bold; color:#EC407A; font-size:18px; text-align:right"><?php printf( 'CANCER STAGE %s', parse_arg('cancer_stage', $userdata) ); ?></td>
		</tr>
	</table>

	<div class="section">
		<h1 class="heading">What is this for?</h1>
		<?php printf( 'Hi <span class="pink">%s,</span> this report is generated specifically for you. What you see in this report is based on what responses to the PDA website. You can share this report to your doctor for further guidance.', $nickname ); ?>
	</div>

	<?php if ( !empty(parse_arg('worries',$userdata)) && $worries = parse_arg('worries',$userdata) ): ?>
	<div class="section" style="margin-bottom:0">
		<h1 class="heading">What are you concern about?</h1>
		<ul>
			<?php
			foreach( $worries as $worry_key ){
				printf( '<li>%s</li>', u($worry_key) );
			} ?>
		</ul>
	</div>
	<?php endif; ?>

	<?php
	$knowing_important = parse_arg('knowing_important', $userdata);
	list( $prefers, $concern, $support, $ready, $preferred_treatment, $extras ) = get_list(
		['prefers', 'concern', 'support', 'ready', 'preferred_treatment', 'extras'],
		$knowing_important
	);
	?>

	<?php if ( !empty(parse_arg('surgery',$prefers)) || !empty(parse_arg('no_surgery',$prefers)) ): ?>
	<div class="section" style="margin-bottom:0">
		<h1 class="heading">Do I prefer surgery?</h1>
		<?php
		foreach ( $prefers as $surgery_bool => $surgery_keys ){
			if ( empty($surgery_keys) || !is_array($surgery_keys) ) continue;

			$surgery_bool_heading = $surgery_bool == 'surgery'
				? "I prefer surgery because..."
				: "I don't prefer surgery because...";

			printf( '<h4 style="margin:5px 0">%s</h4>', $surgery_bool_heading );
			echo '<ul>';
			foreach ( $surgery_keys as $surgery_key )
				printf( '<li>%s</li>', u($surgery_key) );
			echo '</ul>';
		}
		?>
	</div>
	<?php endif; ?>

	<?php if ( is_array($concern) && !empty($concern) ): ?>
	<div class="section" style="margin-bottom:0">
		<h1 class="heading">I am concern ...</h1>
		<?php
		echo '<ul>';
		foreach ( $concern as $concern_key )
			printf( '<li>%s</li>', u($concern_key) );
		echo '</ul>';
		?>
	</div>
	<?php endif; ?>

	<div class="section" style="margin-bottom:0">
		<h1 class="heading">Do I need more support?</h1>
		<ul style="margin:0; padding:0">
			<?php foreach( (array)parse_arg('support', $knowing_important) as $key => $value ): if ($value === false) continue; ?>
				<li><?php o($key); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="section">
		<h1 class="heading">Am I ready to make decision? <span style="font-size:21px" class="pink"><?php o( $ready == 'yes' ? 'yes_text' : 'no_text' ); ?>.</span></h1>
	</div>

	<?php if ( $ready == 'yes' ): ?>
	<div class="section">
		<h1 class="heading">If I am ready to make decision, I would prefer <span style="font-size:21px" class="pink"><?php echo ucfirst(u($preferred_treatment)); ?></span> as a treatment.</h1>
	</div>
	<?php endif; ?>

	<?php if ( !empty($extras) ): ?>
	<div class="section" style="background:#eee; padding:30px">
		<h1 class="heading">Extra enquiries from me ..</h1>
		<p><?php echo $extras; ?></p>
	</div>
	<?php endif; ?>
</page>