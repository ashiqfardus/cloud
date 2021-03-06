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


<div class="col-md-7 ">

    <?php
    $select_posts="SELECT DISTINCT * FROM shared where shared_to='$username' or shared_to='$email' order by date DESC";
    $run_posts=mysqli_query($connection,$select_posts);
    while($row=mysqli_fetch_array($run_posts)){
        $post_image=$row['file_name'];
        $file_type=$row['file_type'];
        $file_id=$row['id'];
        $date=$row['date'];
        $shared_by=$row['shared_by'];
        ?>
        <div class="col-md-3 content_margin">
            <div class="div_border3 " >
                <a href=""  data-toggle="modal" data-target="#<?php echo "$file_id" ?> " data-whatever="@mdo">
                    <img  class="custom_image" src="image/<?php if($file_type=='application/pdf'){echo "pdf.png";} elseif($file_type=='text/plain'){echo "txt.jpg"; } elseif($file_type=='application/vnd.ms-p'){echo "ppt.jpg"; } elseif($file_type=='application/vnd.open'){echo "msw.png"; }elseif($file_type=='application/octet-st'){echo "rar.png"; } elseif($file_type=='application/x-bittor'){echo "white.jpg"; } elseif($file_type=='application/zip'){echo "rar.png"; } elseif($file_type=='image/png' || $file_type='image/jpeg'){ echo "$post_image"; }  ?>">
                </a>
                <figcaption style="font-size: 11px; text-align: center; text-transform: capitalize;font-weight: bold;"><?php echo substr($post_image,0,15); ?></figcaption>
                <figcaption style="font-size: 10px; text-align: center;font-weight:;"><?php echo substr($shared_by,0,15); ?></figcaption>
                <figcaption style=" font-size:9px; text-align: center; text-transform: capitalize;font-weight: ;"> Modified Date-<?php echo substr($date,0,10); ?></figcaption>
            </div>
        </div>
        <div class="modal fade bs-example-modal-sm" id="<?php echo "$file_id" ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title figure_caption" id="gridSystemModalLabel">ashiq</h4>
                    </div>

                    <div class="modal-body">
                        <?php
                        if ($file_type=='application/pdf')
                        {
                            echo "<iframe src=\"image/$post_image\" width=\"100%\" style=\"height:500px; \"></iframe>";
                        }
                        elseif ($file_type=='application/zip'||$file_type=='application/octet-st') {
                            ?>

                            <img src="image/rar.png" class="img-responsive" style="width: 400px; height: 400px;" >
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

                    <div class="modal-footer">
                        <a href="shared_pages.php?id=<?php echo $file_id;?>"><button  type="button" class="btn btn-primary">Open In New Window</button></a>
                        <a href="delete_share.php?del=<?php echo $file_id;?>"><button  type="button" class="btn btn-danger">Remove</button></a>
                        <a href="download.php?id=<?php echo $post_image;?>"><button  type="button" class="btn btn-default">Download</button></a>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
