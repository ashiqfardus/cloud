<?php
include ('includes/connect.php');
session_start();
if (!isset($_SESSION['username'])){
    header("location: login.php");
    $username=$_SESSION['username'];
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
    $query2=mysqli_query($connection,"SELECT profile_name,dob FROM profile_details WHERE username='$username'");
    while ($row2=mysqli_fetch_array($query2))
    {
        $name=$row2['profile_name'];
        $dob=$row2['dob'];

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
		<div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="margin_bottom">
                    <h2 class="header_text2"><b>Edit Your Profile</b></h2>
                    <form action="edit_profile.php?edit_form=<?php echo "$username"; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12 ">
                                    <label>Upload Image</label>
                                    <div class="input-group">
				            <span class="input-group-btn">
				                <span class="btn btn-default btn-file">
				                    Browse… <input type="file" id="imgInp" name="image">
				                </span>
				            </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <img id='img-upload'  />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">Name:</label>
                                    <input type="text" class="form-control" id="usr" name="name" value="<?php if (isset($name)){ echo $name; } ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">Email:</label>
                                    <input type="text" class="form-control" id="usr" name="email" value="<?php if (isset($email)){ echo $email; } ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">Gender:</label>
                                    <select class="form-control" id="sel1" name="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="usr">Date Of Birth:</label>
                                    <input type="Date" class="form-control" id="usr" name="dob" value="<?php if (isset($dob)){ echo $dob; } ?>" >
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


    <script type="text/javascript">
        $(document).ready( function() {
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });
        });
    </script>






    <?php
    if (isset($_POST['submit']))
    {
        $update_uName= $_GET['edit_form'];
        $file =$_FILES['image']['name'];
        $file_loc = $_FILES['image']['tmp_name'];
        $folder="profile_pic/";
        $final_file=ucfirst($file);
        $name=$_POST['name'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $dob=$_POST['dob'];

        if ($file!="" && $name!="" && $email!="" && $gender!="" && $dob!="")
        {
            if (move_uploaded_file($file_loc,$folder.$final_file))
            {

                $sql= "UPDATE profile_details SET 
                        profile_name='$name',
                       profile_pic='$final_file',
                       dob='$dob',
                       gender='$gender'
                       WHERE username='$update_uName'
                        ";
                mysqli_query($connection, "UPDATE user_details SET email='$email' WHERE username='$update_uName'");
                if (mysqli_query($connection,$sql))
                {
                    ?>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success margin_bottom content_margin">
                            <strong>Profile Updated!!</strong>
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <?php
                    echo "<script>
                                setTimeout(function() {
                                    open('profile.php?id=$id', '_self').close();
                                },500);
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
                    <strong>Error!</strong> Any of the field is empty.
                </div>
            </div>
            <div class="col-md-3">
            </div>
            <?php
            echo "<script>
                                setTimeout(function() {
                                    open('edit_profile.php?id=$id', '_self').close();
                                },500);
                                </script>";

        }
    }



    ?>
<?php } ?>