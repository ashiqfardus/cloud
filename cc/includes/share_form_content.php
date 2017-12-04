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
?>
<div class="col-md-6">
    <div class="">
        <h2 class="header_text2"><b>Share File</b></h2>


        <form action="shared_form.php?id=<?php echo $_GET['id'];?>" method="post">
            <div class="row row_margin_h">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="usr">Enter Username Or Email:</label>
                        <input type="text" class="form-control" id="inputdefault" placeholder="Enter Username Or Email" name="name">
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

<?php
        $file_id=$_GET['id'];
        $select_query="SELECT * FROM data WHERE username='$username' AND id='$file_id'";
        $run=mysqli_query($connection,$select_query);
            $row=mysqli_fetch_array($run);
            $username = $row['username'];
            $file_name = $row['file_name'];
            $file_type = $row['file_type'];
            $file_size = $row['file_size'];
            $files_id = $row['id'];
        if (isset($_POST['submit']))
        {
            $name=$_POST['name'];
            $sql="SELECT username from user_details WHERE username='$name'";
            $run_query=mysqli_query($connection,$sql);
            $ucheck=mysqli_num_rows($run_query);
            if ($ucheck==0)
            {
                echo "<script>alert('User does not exit!');
			</script>";
            }
            else
            {
                if ($username==$name)
                {
                    echo "<script>alert('File cannot be shared to your own.');
			</script>";
                }
                else
                {
                    $insert_query="INSERT into shared(file_name, file_size, file_type, shared_by, shared_to)
                          VALUES ('$file_name','$file_size','$file_type','$username','$name')";
                    if (mysqli_query($connection,$insert_query))
                    {
                        echo "<script>alert('File has been shared successfully.');
                        window.location.href='index.php';
                        </script>";

                    }
                }
            }
        }
?>
