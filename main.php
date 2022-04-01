<!DOCTYPE html>
<html lang="en">
<?php
include("include/head.php");
include("include/nav.php");

?>

<body>
	<div class="container-fluid">
		<div class="row">
			<?php include("include/after_nav.php"); ?>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
		</div>

		<div class="row mt-4">
			<div class="card col-sm-4 wow fadeInUp" style="width: 200px !important;">
				<img class="card-img-top" src="images/school.jpg" alt="Card image cap" style="width: 200px; height:100px; margin:auto;">
				<div class="card-body text-center">
				<h5 class="card-title text-center">Thành lập</h5>
					<span style="font-size:20pt" class="card-text counter">31</span>
					<span style="font-size:20pt" class="card-text">/</spanp>
					<span style="font-size:20pt" class="card-text counter">7</span>
					<span style="font-size:20pt" class="card-text">/</span>
					<span style="font-size:20pt" class="card-text counter">1991</span>
				</div>
			</div>
			<div class="card col-sm-4 wow fadeInUp" style="width: 200px !important;">
				<img class="card-img-top" src="images/teachers.jpg" alt="Card image cap" style="width: 200px;height:100px; margin:auto;">
				<div class="card-body">
					<h5 class="card-title text-center">Giáo viên</h5>
					<p style="font-size:20pt" class="card-text text-center counter">80</p>
				</div>
			</div>
			<div class="card col-sm-4 wow fadeInUp" style="width: 200px !important;">
				<img class="card-img-top" src="images/students.jpg" alt="Card image cap" style="width: 200px; height:100px; margin:auto;">
				<div class="card-body">
					<h5 class="card-title text-center">Học sinh</h5>
					<p style="font-size:20pt" class="card-text text-center counter">1437</p>
				</div>
			</div>
		</div>
		<div class="row"></div>
	</div>
	<?php include("include/footer.php"); ?>
	<script>
		new WOW().init();
		jQuery(document).ready(function($) {
			$('.counter').counterUp({
				delay: 10,
				time: 1000
			});
		});
	</script>
</body>

</html>