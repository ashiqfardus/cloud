<?php
include ('connect.php');
if (!isset($_SESSION))
{
    session_start();
}
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

//fetching all data
$sql= mysqli_query($connection, "SELECT * FROM profile_details WHERE username='$username'");
while ($result=mysqli_fetch_array($sql))
{
    $name=$result['profile_name'];
    $image=$result['profile_pic'];
    $dob=$result['dob'];
    $gender=$result['gender'];
}
?>


<div class="col-md-12">
	<div class="col-md-2">
		
	</div>
	<div class="col-md-8">
		<div class="header_text2">
			<img class=" img-circle" width="200" height="200" src="profile_pic/<?php echo $image;?>">
			<div class="row row_margin_home">
				<h4><b>Name:</b><?php if (isset($name)) echo $name; ?></h4>
				<h4><b>Email:</b> <?php if (isset($email)) echo $email; ?></h4>
				<h4><b>Gender:</b> <?php if (isset($gender)) echo $gender; ?></h4>
				<h4><b>Date Of Birth:</b> <?php if (isset($dob)) echo $dob; ?></h4>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		
	</div>
</div>
