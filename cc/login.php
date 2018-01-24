<?php session_start(); ?>

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
</head>
<body>

	<div class="container-fluid">
		<?php include("includes/navbar_login.php") ?>
	</div>
	<div class="container">
		<div class="row row_margin">
			<h2 class="header_text2">Login Form</h2>
		</div>
	</div>
	<div class="row row_margin_h">
		<div class="container">
			<form class="form-horizontal" action="login.php" method="post">
			  <div class="form-group">
			    <label class="control-label col-sm-4 col-md-4" for="email">Username or Email:</label>
			    <div class="col-sm-4 col-md-4">
			      <input type="text" class="form-control" id="email" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" name="username" >
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-4 col-md-4" for="pwd">Password:</label>
			    <div class="col-sm-4 col-md-4"> 
			      <input type="password" class="form-control" id="pwd" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" name="password">
			    </div>
			  </div>
			  <div class="form-group"> 
			    <div class="col-sm-offset-4 col-sm-5">
			      <div class="checkbox">
			        <label><input type="checkbox" name="remember"> Remember me</label>
			      </div>
			    </div>
			  </div>
			  <div class="form-group"> 
			    <div class="col-sm-offset-4 col-sm-5">
			      <button type="submit" class="btn btn-default" name="submit">Submit</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<div class="col-sm-offset-4 col-sm-5">
			      <p class="signup_text">Don't have an account? <a href="signup.php"> SignUp</a></p>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: Ashiq Fardus
 * Date: 10/28/2017
 * Time: 2:54 AM
 */
include ('includes/connect.php');

if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $username=strtolower($username);
    $password= $_POST['password'];
    $password=md5($password);


    if ($username!="" || !$password!="")
    {
        $query = mysqli_query($connection,"SELECT * 
                          from user_details WHERE 
                          (username='$username' OR email='$username') AND password= '$password'");
        if (mysqli_num_rows($query)>0)
        {

            $_SESSION['username']= $username;
            header("location: index.php");
            if(!empty($_POST["remember"])) {
				setcookie ("username",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["username"])) {
					setcookie ("username","");
				}
				if(isset($_COOKIE["password"])) {
					setcookie ("password","");
				}
			 }
			}
        else
        {
            ?>
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="alert alert-danger margin_bottom">
                    <strong>Error!!</strong> Username Or Password didn't match.
                </div>
            </div>
            <div class="col-md-3">
            </div>
            <?php
        }
    }
    else
    {
        ?>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="alert alert-danger margin_bottom">
                <strong>Error!!</strong> Any of the field is empty.
            </div>
        </div>
        <div class="col-md-3">
        </div>
        <?php
    }
}
?>
