<?php
error_reporting(1);
include '../incl/header.incl.php';
include("../incl/conn.incl.php"); // include the connection settings
include 'validate.php';
?>
<h1>Add Farmers</h1>
<?php
$validation = array('valid' => true, 'nulls' => '', 'id' => '', 'no' => '');
if (isset($_POST['f_no'])) {
//    foreach ($_POST AS $key => $value) {
//        $_POST[$key] = mysqli_real_escape_string($conn, $value);
//    }
    $validation = validate_farmers($_POST['f_no'], $_POST['f_id'], $_POST['f_name'], $_POST['l_name'], $_POST['f_locallity'], $_POST['f_ac'], $_POST['f_phone'],$conn);
    if ($validation['valid'] == TRUE) {
        $sql = "INSERT INTO `farmers` ( `f_no` ,`f_id` , `f_name`,`l_name` , `f_locallity` ,  `f_ac` ,  `f_phone`  ) VALUES(  '{$_POST['f_no']}' ,'{$_POST['f_id']}' , '{$_POST['f_name']}' ,'{$_POST['l_name']}' , '{$_POST['f_locallity']}' ,  '{$_POST['f_ac']}' ,  '{$_POST['f_phone']}'  ) ";

        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        echo "Farmer Added.<br />";
       
    } else {
        echo $validation['nulls'];
    }
}
?>
<a href='index.php' class='btn btn-primary'>Back To Farmers</a>
<form action='' method='post' class="form-horizontal"> 
    <div class="control-group">
        <label class="control-label" for="f_no"> No:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="111" name='f_no' required pattern="[0-9]{1,3}" title="Please Enter maximum 3 numbers "/>
<?php echo $validation['no'] ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="f_id">ID No:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="111" name='f_id' required pattern="[0-9]{1,3}" title="Please Enter maximum 3 numbers "/> 
<?php echo $validation['id'] ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="f_name" > First Name:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="First Name" name='f_name' required pattern="[A-Z]{1}[a-z]{1,25}" title="Please Enter valid name"/> 
        </div>
    </div>
     <div class="control-group">
        <label class="control-label" for="l_name">Last Name:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="Last Name" name='l_name' required pattern="[A-Z]{1}[a-z]{1,25}" title="Please Enter valid name"/> 
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="f_locallity"> Locality of Farmer:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="Area-X.." name='f_locallity' required pattern="[A-Z]{1[]{}[a-z]{1,25}" title="Please Enter valid name"/> 
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="f_ac"> Farmer's A/C NO:</label >
        <div class="controls">
            <input  class="input-xlarge" type="text" placeholder="Bank account number ******.." name='f_ac'/> 
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="f_phone"> Farmer Phone NO:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="9999999999" name='f_phone' required pattern="[6789]{1}[0-9]{9}" title="Please Enter the valid phone no, First no starts from 9,8,7,6 and total 10 numbers"/> 
        </div>
    </div>
    <div class="control-group">

        <div class="controls">
            <input type='hidden' value='1' name='submitted' />
            <input type='submit' value='Add Farmer' class="btn btn-success btn-large" /> 
             
        </div>
    </div>
</form>


<?php
include '../incl/footer.incl.php';
?>
