<?php
session_start();
include_once  '../incl/conn.incl.php';
$fat=$_POST['fat'];
$type=$_POST['type'];

//echo $fat;
//echo $type;
//echo $fat;
$fqry=  mysqli_query($conn,"select * from settings_rates where Fat='". mysqli_real_escape_string($conn, $fat) ."' and Type='".mysqli_real_escape_string($conn, $type)."'")  or die("unable to fetch records" . mysqli_error($conn));
//echo "select * from settings_rates where Fat='". mysqli_real_escape_string($conn, $fat) ."'";
if(!mysqli_num_rows($fqry)<1){
    $farmer=mysqli_fetch_array($fqry);
    // $farmer=$farmers[0];
   // $_SESSION['Rate']=$farmer['rate'];
    ?>
 <div class="control-group">
<label class="control-label" for="Rate">Rate:</label>
<div class="controls">
<input class="input-xlarge" id='rate1' value="<?php echo $farmer['rate']; $_SESSION['Rate']=$farmer['rate'];?>">
 
 </div>
</div>
       
    <?php   }else{
       echo '<span class="label label-warning "><i class="icon-warning-sign icon-white"></i> Rate No Not Found!</span>';
   }

?>