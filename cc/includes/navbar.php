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
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" style="font-size: 40px; font-weight: bold;" href="index.php">OFS</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		      <form class="navbar-form navbar-left" action="search.php" method="post">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" name="name">
		        </div>
		        <button type="submit" class="btn btn-default" name="search">Submit</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="profile.php?id=<?php echo md5($id); ?>"><?php echo "$username" ?></a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="profile.php?id=<?php echo md5($id); ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
		            <li><a href="edit_profile.php?id=<?php echo md5($id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile</a></li>
		            <li><a href="change_password.php?id=<?php echo md5($id); ?>"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>