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
if(isset($_GET['res'])){
    $delete_id=$_GET['res'];
    $sql=mysqli_query($connection,"SELECT * FROM trash WHERE id='$delete_id' AND username='$username'");
    while ($row=mysqli_fetch_array($sql))
    {
        $file_name=$row['file_name'];
        $file_size=$row['file_size'];
        $file_type=$row['file_type'];

        $trash_query="INSERT into data(id,file_name,username,file_size,file_type)
                          VALUES ('$delete_id','$file_name','$username','$file_size','$file_type')";
        if (mysqli_query($connection,$trash_query))
        {
            $delete_query="DELETE FROM trash WHERE id='$delete_id' AND username='$username'";
            if (mysqli_query($connection,$delete_query))
            {
                echo "<script>alert('Successfully Restored!');
                            window.history.back();
                        </script>";
            }
        }
    }

}
?>
