<?php
    include ('includes/connect.php');
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
</head>
<body>

	<div class="container-fluid">
		<?php include("includes/navbar_login.php") ?>
	</div>
	<div class="container">
		<div class="row row_margin">
			<h2 class="header_text2">SignUp Form</h2>
		</div>
	</div>
	<div class="row row_margin_h">
		<div class="container">
			<form class="form-horizontal" method="post" action="signup.php" >
			  <div class="form-group">
			    <label class="control-label col-sm-4 col-md-4" for="email">Username:</label>
			    <div class="col-sm-4 col-md-4">
			      <input type="text" class="form-control" id="email" placeholder="Enter Username" name="username">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-4 col-md-4" for="email">Email:</label>
			    <div class="col-sm-4 col-md-4">
			      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-4 col-md-4" for="pwd">Password:</label>
			    <div class="col-sm-4 col-md-4"> 
			      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-4 col-md-4" for="pwd">Repeat Password:</label>
			    <div class="col-sm-4 col-md-4"> 
			      <input type="password" class="form-control" id="pwd" placeholder="Repeat password" name="password2">
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
			      <p class="signup_text">Already have an account? <a href="index.php"> Login</a></p>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>



<?php
include "includes/connect.php";
if (isset($_POST['submit'])){
    $username=$_POST['username'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $password2= $_POST['password2'];

    //Check Username
    $userCheck= mysqli_query($connection, "SELECT username from user_details WHERE username='$username'");
    $uCheck = mysqli_num_rows($userCheck);
    //Email Check
    $emailCheck = mysqli_query($connection, "SELECT email FROM user_details WHERE email='$email'");
    $eCheck = mysqli_num_rows($emailCheck);

    if ($uCheck==0)
    {
        if ($eCheck==0)
        {
            //Check all fields are empty or not
            if ($username!="" && $email !="" && $password!="" && $password2!="")
            {
                //check password match
                if ($password==$password2)
                {
                    //Check password length
                    if (strlen($password)>15 || strlen($password)<5)
                    {

                        ?>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Password Must be between 5-15 character.
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <?php
                    }
                    else
                    {
                        //Encrypting password
                        $password=md5($password);
                        $query = mysqli_query($connection, "
                                                  INSERT INTO user_details (username,email,password)
                                                  VALUES ('$username', '$email', '$password')");

                        $query = mysqli_query($connection, "
                                                  INSERT INTO profile_details (username)
                                                  VALUES ('$username')");
                        ?>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-success margin_bottom">
                                <strong>Registration Successfully Completed!!</strong> Please Login Now.
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <?php
                        echo "<script>
                                setTimeout(function() {
                                    open('login.php', '_self').close();
                                },2000);
                                </script>";
                    }
                }
                else
                {
                    ?>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-danger margin_bottom">
                            <strong>Error!</strong> Password didn't match.
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
                        <strong>Error!</strong> Any of the field is empty.
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
                    <strong>Error!</strong> Email already exists.
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
                <strong>Error!</strong> Username already exists.
            </div>
        </div>
        <div class="col-md-3">
        </div>
        <?php
    }
}




?>