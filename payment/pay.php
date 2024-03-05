<?php 
include '../incl/header.incl.php';
include '../incl/conn.incl.php';

if (isset($_GET['f_no'])) {
    $f_no = mysqli_real_escape_string($conn, $_GET['f_no']);
    $start = mysqli_real_escape_string($conn, $_REQUEST['start']);
    $end = mysqli_real_escape_string($conn, $_REQUEST['end']);
    $authority = '';

   // $rates = mysqli_query($conn,"SELECT * FROM `settings_rates` WHERE `to` <='$end' and `from` >='$start'");
    $rates = mysqli_query($conn,"SELECT * FROM `delivery`");
    while($row = mysqli_fetch_assoc($rates)) {
        $Rate=$row['Rate'];
        $Amount=$row['Amount'];
    }
//$rates = mysqli_fetch_row($ratesrows);

    $farmer = mysqli_fetch_array(mysqli_query($conn,"select f_no,f_name,last_paid,f_ac from farmers where f_no=$f_no"));
    //$farmer = mysqli_fetch_row($farmers);

    $result = mysqli_query($conn,"SELECT * FROM `delivery` WHERE r_f_no=$f_no and `r_dt` >='$start' and `r_dt` <= '$end'") or trigger_error(mysqli_error($conn));

    $farmer_total = 0;
    $total_amount=0;

    $authority = $current_user['name'];
    $datetime = strtotime(date('y-m-d'));
    $mysqldate = date("Y-m-d", $datetime);
    $updatesql="UPDATE `farmers` SET  `last_paid` =  '$mysqldate' WHERE  `f_no` =  '$f_no'";
    
    $insertcmd = mysqli_query($conn,$updatesql); //INSERT INTO `farmers` ( `p_to` ,  `p_date` ,  `p_ac` ,  `p_transacted_by`  ) VALUES(  '{$f_no}' ,  '{$mysqldate}' ,  '{$farmer['f_ac']}' ,  '{$authority}'  ) ");
    ?>
    <div id="printable">
        <table id="receipt"  >
            <thead style="margin-bottom: 20px">
            <th colspan="2"  ><h1>Farmer Payment Receipt</h1></th>
            </thead>
            <tbody>
                <tr><td><strong>Paid to</strong></td><td><?php echo $f_no . ' -- ' . $farmer['f_name']; ?> </td></tr>
                <tr><td><strong>In Account No</strong></td><td> <?php echo $farmer['f_ac']; ?></td></tr>
                <tr><td><strong>Rates</strong></td><td> <?php echo $Rate ?></td></tr>
                <tr><td><strong>For sales between</strong></td><td> <?php echo $start . ' to ' . $end ?></td></tr>
                <tr><td><strong>Paid on</strong></td><td> <?php echo date('y-m-d'); ?> </td></tr>
                <tr><td><strong>Authorized by:</strong></td><td><?php echo $current_user['name']; ?></td></tr>
        </table>  
        <h3>Details</h3>
        <?php
        echo '<table id="details" class="table table-hover table-striped table-condensed table-bordered">';
        echo '<thead class="" ><th>#</th><th>Date</th><th>Liters:</th><th>Rate</th><th>Amount</th></thead><tbody>';
        $count = 0;

        while ($row = mysqli_fetch_array($result)) {
            foreach ($row AS $key => $value) {
                $row[$key] = stripslashes($value);
            }
            $count+=1;
            $farmer_total+=nl2br($row['r_kg']);
            $total_amount+=nl2br($row['Amount']);
            echo "<tr>";
            echo '<td>' . $count . '</td>';
            //echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
            echo "<td valign='top'>" . nl2br($row['r_dt']) . "</td>";
            echo "<td valign='top'>" . nl2br($row['r_kg']) . "</td>";
            echo "<td valign='top'>" . nl2br($row['Rate']) . "</td>";
            echo "<td valign='top'>" . nl2br($row['Amount']) . "</td>";
            echo "</tr>";
        }
        echo "<tr><td>Total</td><td></td><td><strong> $farmer_total</td><td></td><td>$total_amount</strong></td><tr>";
        echo '</tbody></table>';
        ?>
        
        
<?php 
 $sql1="select * from farmers where f_no=".$f_no;  
       // echo $sql1;
        $result= mysqli_query($conn, $sql1);
        if(! $result ) {
      die('Could not get data: ' . mysqli_error($conn));
   }
        while ($row = mysqli_fetch_array($result)) {
        $pno=$row['f_phone'];
        $ac_no=$row['f_ac'];
        }
//$msg="Payment Done,Date Beetween Form-".$end.",TO-" .$start."Liters".($farmer_total). " Amount".($Amount);
$msg="Your a/c no. xxxxxxxxxx".$ac_no.",is credited with Rs.".($Amount)." on ".$end;
$curl = curl_init();

curl_setopt_array($curl, array(
   CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?route=4&sender=TESTIN&mobiles=".$pno."&authkey=269414AuNLoiDCp5c9a972c&message=".$msg."&country=91",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
} ?>

    </div>
    <br/><br/>

    <form method="post" action="" class="form-inline">
        <!--<label for="authority">Authorized By:</label><input type="text" id="authority" name="authority" >-->
        <input type="submit" id="print" class="btn btn-success" value="print Receipt">

    </form>
    <?php
}
?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#print').on('click', function() {
            printDiv('printable');

        });

    });
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<?php include '../incl/footer.incl.php'; ?>
