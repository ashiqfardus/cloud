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

?>


<div class="col-md-7 ">
    <?php
        if(isset($_GET['id']))
        {
            $page_id=$_GET['id'];
            $sql="SELECT * FROM data WHERE id='$page_id'";
            $run=mysqli_query($connection,$sql);
            while ($row=mysqli_fetch_array($run))
            {
                $post_image=$row['file_name'];
                $file_type=$row['file_type'];
                $file_id=$row['id'];

    ?>
    <div class="header_text2">
        <div class="row">
            <?php
            if ($file_type=='application/pdf')
            {
                echo "<iframe src=\"image/$post_image\" width=\"100%\" style=\"height:500px; \"></iframe>";
            }
            elseif ($file_type=='application/zip'||$file_type=='application/octet-st') {
                ?>

                <img src="image/rar.png" style="height: 300px; width: 300px;" >
                <?php
            }
            elseif ($file_type=='text/plain') {
                $re=getcwd()."/image/$post_image";
                $fp=fopen($re, "r");
                $mf=fread($fp, 1000);
                ?>
                <p><?php echo $mf; ?></p>
                <?php
            }

            elseif($file_type=='application/x-bittor' || $file_type=='application/vnd.ms-p' ||$file_type=='application/vnd.open' )
            {
                ?>

                <img src="image/white.jpg" class="img-responsive" >
                <?php
            }
            elseif ($file_type=='image/png' || $file_type='image/jpeg') {
                ?>

                <img src="image/<?php echo "$post_image" ?>" class="img-responsive" >
                <?php
            }

            ?>
        </div>
        <div class="row row_margin_h">
                <a href="remove_p.php?del=<?php echo $file_id;?>"><button  type="button" class="btn btn-danger">Remove</button></a>
                <a href="shared_form.php?id=<?php echo $file_id;?>"><button  type="button" class="btn btn-primary">Share</button></a>
                <a href="download.php?id=<?php echo $post_image;?>"><button  type="button" class="btn btn-default">Download</button></a>
        </div>
    </div>
</div>
<?php }}} ?>