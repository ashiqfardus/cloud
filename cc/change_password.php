<?php
include ('includes/connect.php');
session_start();
if (!isset($_SESSION['username'])){
    header("location: login.php");
}
else{
    $username=$_SESSION['username'];
    $query= mysqli_query($connection, "select id,username,email from
                    user_details WHERE username='$username' 
                    OR email='$username'");
    while ($row=mysqli_fetch_array($query))
    {
        $username=$row['username'];
        $id=$row['id'];
        $email=$row['email'];
    }


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

            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="">
                    <h2 class="header_text2"><b>Change Paswword</b></h2>


                    <form action="change_password.php?edit_form=<?php echo "$username"; ?>" method="post">
                        <div class="row row_margin_h">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">Old Password:</label>
                                    <input type="Password" class="form-control" id="inputdefault" placeholder="Enter Old Password" name="old_pass">
                                </div>
                            </div>
                        </div>
                        <div class="row row_margin_h">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">New Password:</label>
                                    <input type="Password" name="pass1" class="form-control" id="inputdefault" placeholder="Enter New Password">
                                </div>
                            </div>
                        </div>
                        <div class="row row_margin_h">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">Repeat Password:</label>
                                    <input type="Password" name="pass2" class="form-control" id="inputdefault" placeholder="Repeat Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-12 row_margin_h text_right">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">

            </div>

        </div>
	</div>

	<?php include("includes/footer.php") ?>
</body>
</html>

<?php
include ('includes/connect.php');
if (isset($_POST['submit'])){
    $old_pass=$_POST['old_pass'];
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];

    //old passwordcheck
    $queryP="SELECT password from user_details WHERE username='$username'";
    $run=mysqli_query($connection,$queryP);
    while ($result=mysqli_fetch_array($run))
    {
        $pass=$result['password'];
        if ($old_pass!="")
        {
            $old_pass=md5($old_pass);
            if ($pass==$old_pass)
            {
                if ($pass1!="" && $pass2!="" )
                {
                    if ($pass1==$pass2)
                    {
                        if (strlen($pass1)>15 || strlen($pass1)<5)
                        {
                            ?>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-danger margin_bottom content_margin">
                                    <strong>Password length must be between 5-15 digit!!</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <?php
                            echo "<script>
                                setTimeout(function() {
                                    open('change_password.php?id=$id', '_self').close();
                                },500);
                                </script>";
                        }
                        else
                        {
                            $pass1 = md5($pass1);
                            $passChange = "UPDATE user_details SET password='$pass1' WHERE username='$username'";
                            if (mysqli_query($connection, $passChange)) {
                                ?>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success margin_bottom content_margin">
                                        <strong>Password Changed!!</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <?php
                                echo "<script>
                                setTimeout(function() {
                                    open('change_password.php?id=$id', '_self').close();
                                },1000);
                                </script>";
                            }
                        }
                    }
                    else
                    {
                        ?>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger margin_bottom content_margin">
                                <strong>New Password didn't match!!</strong>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <?php
                        echo "<script>
                                setTimeout(function() {
                                    open('change_password.php?id=$id', '_self').close();
                                },500);
                                </script>";
                    }
                }
                else
                {
                    ?>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-danger margin_bottom content_margin">
                            <strong>Any Of the field of New Password is empty!!</strong>
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <?php
                    echo "<script>
                                setTimeout(function() {
                                    open('change_password.php?id=$id', '_self').close();
                                },500);
                                </script>";
                }
            }
            else
            {
                ?>
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="alert alert-danger margin_bottom content_margin">
                        <strong>Old Password didn't match!!</strong>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
                <?php
                echo "<script>
                                setTimeout(function() {
                                    open('change_password.php?id=$id', '_self').close();
                                },500);
                                </script>";
            }
        }
        else
        {
            ?>
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="alert alert-danger margin_bottom content_margin">
                    <strong>Old Password is empty!!</strong>
                </div>
            </div>
            <div class="col-md-3">
            </div>
            <?php
            echo "<script>
                                setTimeout(function() {
                                    open('change_password.php?id=$id', '_self').close();
                                },500);
                                </script>";
        }
    }



}
?>


<?php } ?>