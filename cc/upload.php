<?php
include ('includes/connect.php');
session_start();
if (!isset($_SESSION['username'])){
    header("location: login.php");
    $username=$_SESSION['username'];

}
else{
    $username=$_SESSION['username'];
    $query= mysqli_query($connection, "select id,username from
                    user_details WHERE username='$username' 
                    OR email='$username'");
    while ($row=mysqli_fetch_array($query))
    {
        $username=$row['username'];
        $id=$row['id'];



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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
</head>
<body>
	<div class="row">
		<?php include("includes/navbar.php") ?>
	</div>
	
	<div class="container-fluid">
		<div class="row row_margin_home">
			
		</div>
		<div class="row row_margin_home">
			<?php include("includes/side_nav.php") ?>
			<div class="col-md-1">
				
			</div>
            <div class="col-md-7">
                <div class="header_text2">
                    <h2>Upload Files</h2>

                    <form method="post" action="upload.php" enctype="multipart/form-data">
                        <!-- COMPONENT START -->
                        <div class="form-group">
                            <div class="input-group input-file" name="file">
                                <input type="text" class="form-control" placeholder='Choose a file...' />
                            <span class="input-group-btn">
		        		            <button class="btn btn-default btn-choose" type="button">Choose</button>
		    		        </span>
                        </div>
                        </div>
                        <!-- COMPONENT END -->
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>

                </div>
            </div>
		</div>
	</div>

	<?php include("includes/footer.php") ?>

    <script type="text/javascript">
        function bs_input_file() {
            $(".input-file").before(
                function() {
                    if ( ! $(this).prev().hasClass('input-ghost') ) {
                        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                        element.attr("name",$(this).attr("name"));
                        element.change(function(){
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function(){
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function(){
                            element.val(null);
                            $(this).parents(".input-file").find('input').val('');
                        });
                        $(this).find('input').css("cursor","pointer");
                        $(this).find('input').mousedown(function() {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        return element;
                    }
                }
            );
        }
        $(function() {
            bs_input_file();
        });
    </script>



</body>
</html>



    <?php
        if (isset($_POST['submit']))
        {
            $file= $_FILES['file']['name'];
            $file_loc=$_FILES['file']['tmp_name'];
            $file_size=$_FILES['file']['size'];
            $file_type=$_FILES['file']['type'];
            $folder="image/";
            $new_file_size=$file_size/1000000;
            $final_file=$file;
            if (move_uploaded_file($file_loc, $folder.$final_file))
            {
                $sql="INSERT into 
                      data(file_name, username, file_size, file_type) 
                      VALUES ('$final_file','$username','$new_file_size', '$file_type')";
                if (mysqli_query($connection,$sql))
                {
                   ?>
                    <script>
                        bootbox.alert("Successfully Uploaded!");
                        setTimeout(function() {
                            open('index.php?success="<?php if (isset($id)){echo md5($id); } ?>"', '_self').close();
                        },2000);
                    </script>
                   <?php

                }
            }
            else
            {
                ?>
                <script>
                    bootbox.alert("Something went worng. File couldn't upload!");
                    setTimeout(function() {
                        open('upload.php', '_self').close();
                    },2000);
                </script>
                <?php
            }
        }

    ?>


<?php }} ?>