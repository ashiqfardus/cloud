 <?php
    include ('includes/connect.php');
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
	if(isset($_GET['del'])){
        $delete_id=$_GET['del'];
        $sql=mysqli_query($connection,"SELECT * FROM data WHERE id='$delete_id' AND username='$username'");
		while ($row=mysqli_fetch_array($sql))
        {
            $file_name=$row['file_name'];
            $file_size=$row['file_size'];
            $file_type=$row['file_type'];

            $trash_query="INSERT into trash(id,file_name,username,file_size,file_type)
                          VALUES ('$delete_id','$file_name','$username','$file_size','$file_type')";
            if (mysqli_query($connection,$trash_query))
            {
                $delete_query="DELETE FROM data WHERE id='$delete_id' AND username='$username'";
                if (mysqli_query($connection,$delete_query))
                {
                    echo "<script>alert('Post has been deleted');
                            window.history.back();
                        </script>";
                }
            }
        }

	}
?>
