
<?php
include ('connect.php');
if (!isset($_SESSION))
{
    session_start();
}
$username=$_SESSION['username'];
$query= mysqli_query($connection, "select id,username from
                    user_details WHERE username='$username' 
                    OR email='$username'");
while ($row=mysqli_fetch_array($query))
{
    $username=$row['username'];
    $id=$row['id'];
}
?>



<div class="col-md-2">
				<nav class="nav-sidebar">
	                <ul class="nav">
	                	<hr>
	                    <li> <a href="upload.php?id=<?php echo md5($id); ?>"><i class="fa fa-cloud-upload fa-lg" aria-hidden="true"></i> New Upload</a></li>
	                    <hr>
	                    <li><a href="my_files.php?id=<?php echo md5($id); ?>"><i class="fa fa-folder-open fa-lg" aria-hidden="true"></i> My Files</a></li>
	                    <hr>
	                    <li><a href="recent.php?id=<?php echo md5($id); ?>"><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i> Recent</a></li>
	                    <hr>
	                    <li><a href="share.php"><i class="fa fa-share-alt fa-lg" aria-hidden="true"></i> Shared</a></li>
	                    <hr>
	                    <li><a href="trash.php?id=<?php echo md5($id); ?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Trash</a></li>
	                    <hr>
	                    <p class="size_text"><li>15MB Free of 200MB</li></p>
	                </ul>
        		</nav>
			</div>
