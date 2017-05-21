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

$userdata = get_data();

init_locale( 'worries', 'definition', 'treatment', 'concerns' );
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
	margin:20px 0
}

ul li {
	padding: 0 0 10px 10px
}
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm">
	<page_footer>
		<table style="width:100%">
			<tr>
				<td style="width:50%; font-size:14px; padding:10px 15mm 5mm; color:#666;">www.breastcancerpda.com</td>
				<td style="width:50%; font-size:14px; padding:10px 15mm 5mm; color:#666; text-align:right">Monday, 22 May 2016</td>
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
			<td style="width:50%; font-weight:bold; color:#EC407A; font-size:18px;"><?php echo strtoupper( parse_arg('nickname', $userdata) ); ?></td>
			<td style="width:50%; font-weight:bold; color:#EC407A; font-size:18px; text-align:right"><?php printf( 'CANCER STAGE %s', parse_arg('cancer_stage', $userdata) ); ?></td>
		</tr>
	</table>

	<div class="section">
		<h1 class="heading">I. What is this for?</h1>
		<p>Hi <span class="pink">Nana Lina,</span> this report is generated specifically for you. What you see in this report is based on what responses to the PDA website. You can share this report to your doctor further guidance.</p>
	</div>

	<?php
	$knowing_important = parse_arg('knowing_important', $userdata);
	list( $prefers, $concern, $support, $ready, $preferred_treatment ) = get_list(
		['prefers', 'concern', 'support', 'ready', 'preferred_treatment'],
		$knowing_important
	);


	?>


	<div class="section">
		<h1 class="heading">Do prefer surgery?</h1>
		<?php
		if ( is_array($prefers) ){
			list( $prefer_surgery, $prefer_no_surgery ) = get_list(['surgery', 'no_surgery'], $prefers);

			foreach ( $prefer_surgery as $key ){
			}
		}
		?>
	</div>



	<div class="section">
		<h1 class="heading">II. Do you need more support?</h1>
		<ul style="margin:0; padding:0">
			<?php foreach( (array)parse_arg('support', $knowing_important) as $key => $value ): if ($value === false) continue; ?>
				<li><?php o($key); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<!-- <table style="width: 80%;border: solid 1px #5544DD; border-collapse: collapse" align="center">
		<thead>
			<tr>
				<th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Header 1</th>
				<th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Header 2</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width: 30%; text-align: left; border: solid 1px #55DD44">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris varius libero et purus sagittis, tincidunt ultrices tortor convallis. Nunc consectetur non mi id eleifend. Nam vehicula mattis imperdiet. Etiam consectetur libero turpis, non commodo risus feugiat ut. Maecenas in dolor sollicitudin, tincidunt turpis sed, iaculis massa. Phasellus malesuada molestie nunc eget lobortis. In pharetra, nisl ut ornare dictum, mi mauris iaculis nulla, nec interdum justo justo a nulla.
				</td>
				<td style="width: 70%; text-align: left; border: solid 1px #55DD44">
					Donec aliquet lectus ac ligula pretium malesuada. Aliquam iaculis orci dolor, eu pellentesque purus facilisis ac. Morbi in mi non arcu pharetra molestie. Suspendisse non nulla diam. Pellentesque tempus a lacus in accumsan. Nullam ut mi nibh. Proin dignissim orci quis velit vehicula, quis congue mauris ornare. Aliquam posuere interdum tortor eget tempor.
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Footer 1</th>
				<th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Footer 2</th>
			</tr>
		</tfoot>
	</table> -->
</page>
<!-- <page pageset="old">
	Nouvelle page !!!!
</page> -->