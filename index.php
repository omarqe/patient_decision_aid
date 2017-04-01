<?php
/**
 * Patient Decision Aid (PDA) for Breast Cancer.
 * 
 * This work is originally coded by @omarqe and the team members. Please keep this copyright
 * notice for legal use.
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
			We use cookie to ensure the best experience for you. Please read our <a>cookie use policy</a>.
			<a class="dismiss">&times;</a>
		</div>
	</div>

	<section style="background-image:url(images/ian-schneider-39678.jpg); color:#eee !important">
		<div class="main-overlay centralized">
			<div class="content animated fadeIn">
				<h1>Patient Decision Aid</h1>
				<h5 class="subtitle">
					This website provides you information about the early stages (stage 1 &amp; 2) breast cancer including symptoms and treatments. To begin with, click the begin button below.
				</h5>
				<div class="btn-action">
					<a class="btn" data-invoke="next_page" data-anim="fadeInUp">Begin</a>
				</div>
			</div>
		</div>
	</section>

	<section style="background:rgb(38,50,56) url(images/videos/Puzzling.jpg); color:#eee">
		<video autoplay loop muted>
			<source src="images/videos/Puzzling.mp4" type="video/mp4">
			<source src="images/videos/Puzzling.webm" type="video/webm">
		</video>

		<div class="main-overlay centralized" style="background:rgba(38,50,56,.9)">
			<div class="content">
				<h1>What is breast cancer?</h1>
				<h5 class="subtitle">Cancer occurs when cells in our body turn abnormal and start to grow out of control. In breast cancer, these abnormal cells grow in the breast to become a lump. Breast cancer is usually painless and, if not treated, may spread to other parts of the body such as lymph nodes, lungs, liver, bones and brain. </h5>

				<div class="compartment row">
					<div class="col-md-6">
						<div class="white-card hoverable">
							<div class="content">
								<h4>Stage 1</h4>
								<div class="desc">
									The breast cancer is 2cm or less in size. The lymph nodes under the arm are not affected and the cancer has not spread.
								</div>

								<div class="btn-action">
									<a class="btn btn-success btn-sm" data-invoke="next_page">See treatment options &rarr;</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="white-card hoverable">
							<div class="content">
								<h4>Stage 2</h4>
								<div class="desc">
									The breast cancer is between more than 2 and 5cm in size. The lymph nodes may be affected but the cancer has not spread.
								</div>

								<div class="btn-action">
									<a class="btn btn-success btn-sm" data-invoke="next_page">See treatment options &rarr;</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="white-card hoverable">
							<div class="content">
								<h4>Stage 3</h4>
								<div class="desc">
									The size of the breast cancer is more than 5cm or it has spread to the skin or chest wall.
									<br class="separator small">
									<div class="notice text-only red italic small" style="margin-top:20px">If you notice this symptom on your body, please consult with the doctor immediately.</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="white-card hoverable">
							<div class="content">
								<h4>Stage 4</h4>
								<div class="desc">
									The breast cancer has spread to other parts of the body such as lungs, liver, bones and brain.
									<br class="separator small">
									<div class="notice text-only red italic small" style="margin-top:20px">If you notice this symptom on your body, please consult with the doctor immediately.</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-action text-right">
					<a class="btn btn-xs" data-invoke="prev_page">&larr; Previous page</a>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="section-container centralized">
			<div class="content" style="width:60%">
				<h1>Treatment options</h1>
				<h5 class="subtitle">These are the available treatment options for your case.</h5>

				<div class="compartment row masonry">
					<div class="col-md-6 col-md-offset-3 grid-item">
						<div class="white-card hoverable">
							<div class="content text-left">
								<h4><span class="num-badge blue">1</span> Lumpectomy</h4>
								<div class="desc">
									<p>Most women go for lumpectomy because it helps conserve their breast.</p>
									<ul>
										<li>In lumpectomy, only part of the breast is removed. The surgeon will remove the cancer lump and up to 1 cm of the surrounding breast tissue</li>
										<li>Cancer cells may move to the lymph nodes in the armpit. If so, they will be removed during the surgery.</li>
										<li>After a surgery, a drain is used to remove any fluid or blood that collects under the wound. This drain consists of a soft plastic tube connected to a plastic bottle. It will be removed once there is no more fluid or blood.</li>
										<li>Most women can go home within a day or two.</li>
										<li>Occasionally, another surgery may be needed if cancer cells are too close tothe edge of the tissue removed during lumpectomy. This happens in 20 out of 100 people. </li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-md-offset-3 grid-item">
						<div class="white-card hoverable">
							<div class="content text-left">
								<h4><span class="num-badge blue">2</span> Masectomy</h4>
								<div class="desc">
									<p>The whole breast (including the nipple) is removed leaving a flat chest wall with a scar.</p>
									<ul>
										<li>Most women spend 2-3 nights in hospital. Like lumpectomy, a drain which consists of a soft plastic tube connected to a plastic bottle will be used to remove any fluid or blood collecting under the wound. </li>
										<li>Some women may consider breast reconstruction surgery where a new breast shape is created. Your surgeon can discuss this further with you.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-md-offset-3 grid-item">
						<div class="white-card hoverable">
							<div class="content text-left">
								<h4><span class="num-badge blue">3</span> Alternative treatment</h4>
								<div class="desc">
									<p>Some women prefer alternative treatment such as food supplement, herbal medicine or spiritual healing. So far, there is no good scientific evidence to support using alternative treatment to cure breast cancer.</p>
									<p>Modern medicine is based on scientific evidence while alternative treatment is often based on individual practitioners’ experience.</p>
									<p>You may want to ask the following questions before considering alternative treatment:</p>
									<ul>
										<li>‘Is the alternative practitioner qualified in treating breast cancer?’</li>
										<li>‘Is there any scientic information based on human beings (not animals)?’</li>
										<li>‘If there are claims that a person is cured, ask whether is it a breast cancer or a benign breast lump?’</li>
										<li>‘What is the chance of alternative treatment curing breast cancer compared to surgery?’</li>
									</ul>
									<p>It is important to know that most breast cancers grow slowly and do not spread immediately. If the breast cancer does not grow or spread within a few months, it does not mean that the alternative treatment is effective.</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-md-offset-3 grid-item">
						<div class="white-card hoverable">
							<div class="content text-left">
								<h4><span class="num-badge red">4</span> No treatment</h4>
								<div class="desc">
									<p>You decided not to take any action on the disease.</p>
								</div>
							</div>
						</div>
					</div>

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

	<section class="active">
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
					$worries = array(
						array(
							"enquiry" => "How long will I live?",
							"answers" => array(
								"lumpectomy" => "In 5 years, out of 100 women with breast cancer, 80 may live and 20 may die (with radiotherapy).",
								"mastectomy" => "Same as lumpectomy.",
								"alternative" => "No good information is available. Ask the practitioner.",
								"no_treatment" => "Most women will die within 5 years."
							),
						)
					);
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