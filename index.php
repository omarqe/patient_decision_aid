<!DOCTYPE html>
<html>
<head>
	<title>Patient Decision Aid | Breast Cancer</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
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
			<div class="content">
				<h1>Patient Decision Aid</h1>
				<h5 class="subtitle">
					This website provides you information about the early stages (stage 1 &amp; 2) breast cancer including symptoms and treatments. To begin with, click the begin button below.
				</h5>
				<div class="btn-action">
					<a class="btn" data-invoke="next_page">Begin</a>
				</div>
			</div>
		</div>
	</section>

	<section class="active">
		<div class="section-container centralized">
			<div class="content">
				<h1>What is breast cancer?</h1>
				<h5 class="subtitle">Breast cancer is the most common cancer among women in Malaysia and around the world. One in twenty women will develop breast cancer in their lifetime.</h5>

				<div class="compartment">
					<div class="row">
						<div class="col-md-6">
							<div class="white-card hoverable">
								<div class="content">
									<h4>Stage 1</h4>
									<div class="desc">
										The breast cancer is 2cm or less in size. The lymph nodes under the arm are not affected and the cancer has not spread.
									</div>

									<div class="btn-action">
										<a class="btn btn-success btn-sm">I have this symptom</a>
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
										<a class="btn btn-success btn-sm">I have this symptom</a>
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
					</div> <!-- .row -->
				</div>

				<div class="btn-action">
					<a class="btn btn-dark" data-invoke="prev_page">&larr; Previous page</a>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/assets.js"></script>
</body>
</html>