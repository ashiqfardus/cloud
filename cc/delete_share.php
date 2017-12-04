<?php
include("includes/connect.php");
if(isset($_GET['del'])){
    $delete_id=$_GET['del'];
    $delete_query= "DELETE FROM shared where id='$delete_id' ";
    if(mysqli_query($connection,$delete_query)){
        echo "<script>alert('Post has been deleted');
			window.location.href='share.php';
			</script>";

    }
}
?>