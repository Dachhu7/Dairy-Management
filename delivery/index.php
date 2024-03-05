

<?php 
include '../incl/header.incl.php';
include '../incl/conn.incl.php';
//include('../incl/auth.incl.php');



if(isset($_GET['delete'])){
    $id = (int) $_GET['id']; 
mysqli_query($conn,"DELETE FROM `delivery` WHERE `id` = '$id' ") ; 
echo (mysqli_affected_rows($conn)) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
}
?>
<h1>Deliveries</h1>
<br/>
<a href='add.php' class='btn btn-large btn-primary'  ><i class="icon-plus icon-white"></i>New Delivery</a><br/><br/> 
<table class="table table-hover table-striped table-condensed table-bordered">
    <thead class="" >
<!--        <th>#</th>-->
       
         <th>Farmer NO:</th>
        <th>Date</th>
        <th>Liters</th>
        <th>Fat</th>
        <th>Rate</th>
        <th>Total_Amt</th>
        <!--<th>Deliverer:</th>-->
        <?php if ($current_user['role'] != 'Clerk') {?><th style="text-align: center">Tasks</th><?php } ?>
        </thead>
    <tbody>
 <?php $dt= date('Y-m-d');
 //if (isset($_GET['Save'])) {
   //  $date= date('Y-m-d');
 //$result = mysqli_query($conn,"SELECT * FROM `delivery` WHERE r_dt='$date'") or trigger_error(mysqli_error($conn));
$result = mysqli_query($conn,"SELECT * FROM `delivery` WHERE r_dt like '$dt%'") or trigger_error(mysqli_error($conn)); 
//echo "SELECT * FROM `delivery` WHERE r_dt like '$dt%'";
$i=0;
while($row = mysqli_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
$i+=1;
echo "<tr>";  
 //echo '<td>'.$i.'</td>';
//echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['r_f_no']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['r_dt']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['r_kg']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Fat']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['Rate']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['Amount']) . "</td>"; 
//echo "<td valign='top'>" . nl2br( $row['r_deliverer']) . "</td>";  
  if ($current_user['role'] != 'Clerk') {
      echo '<td  style="text-align: center">
                <a href="'.PAGE_URL.'delivery/edit.php?edit=1&id='.$row['id'].'" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i>Edit</a> | 
                <a href="'.PAGE_URL.'delivery/?delete=1&id='.$row['id'].'" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>Delete</a> 
             </td>';
  }
echo "</tr>"; 
} 
 //}
echo "</tbody></table>"; 



include '../incl/footer.incl.php';
?>