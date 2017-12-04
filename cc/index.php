<?php
session_start();
if(!isset($_SESSION['username']))
{
   header("location: login.php");
}
else
{

?>
<!DOCTYPE html>
<html>
<head>
	<title>Online File Storage</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
	<script type="text/javascript" src="js/npm.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<script src="https://use.fontawesome.com/6e655bd209.js"></script>
</head>
<body>
	<div class="row">
		<?php include("includes/navbar.php") ?>
	</div>
	
	<div class="container-fluid">
		<div class="row row_margin_home">
			
		</div>
		<div class="row row_margin_home margin_bottom">
			<?php include("includes/side_nav.php") ?>
			<div class="col-md-1">
				
			</div>
			<?php include("includes/home_content.php") ?>
		</div>
	</div>

	<?php include("includes/footer.php") ?>
</body>
</html>


<?php } ?>