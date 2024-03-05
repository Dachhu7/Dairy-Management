

<a href='index.php' class='btn btn-primary'>Back To Listing</a>
<form action='' method='POST' class="form-horizontal" name="delivery"> 
    <div class="control-group">
        <label class="control-label" for="r_f_no">Shift</label >
        <div class="controls">
		<input type="radio" name="T" value="Morning"> Morning<br>
		  </div>
		  <div class="controls">
         <input type="radio" name="T" value="Evening"> Evening<br>
           
        </div>

    </div>
	
	 <div class="control-group">
        <label class="control-label" for="r_f_no">Type</label >
        <div class="controls">
		<input id="b" type="radio" name="TT" value="Buffalo" > Buffalo<br>
  <input id='c' type="radio" name="TT" value="Cow" >Cow<br>
            
        </div>

    </div>
	<div class="control-group">
        <label class="control-label" for="r_f_no">Farmer No:</label >
        <div class="controls">
            <input id="f_no" class="input-xlarge" type="text" placeholder="CCF****" name='r_f_no' value='<?php echo isset($row)?stripslashes($row['r_f_no']):''; ?>'/> 

            <?php echo $validation['fn'] ?>
        </div>

    </div>
    <div id="farmercheck" class="">

    </div>
    <div class="control-group">
        <label class="control-label" for="r_kg"> Milk in Liters:</label >
        <div class="controls">
            <input class="input-xlarge" id='kg' type="text" placeholder="4**" name='r_kg' value='<?php echo isset($row)?stripslashes($row['r_kg']):''; ?>'/> 
            <?php echo $validation['kg'] ?>
        </div>
    </div>
	 <div class="control-group">
        <label class="control-label" for="r_kg"> Fat:</label >
        <div class="controls">
            <input id='fat' class="input-xlarge" type="text" placeholder="4**" name='Fat' value='<?php echo isset($row)?stripslashes($row['Fat']):''; ?>'/> 
            <?php echo $validation['kg'] ?>
        </div>
    </div>
      <div class="control-group">
        <label class="control-label" for="Rate"> Rate:</label >
        <div class="controls">
            <input id='fat1' class="input-xlarge" type="text" placeholder="4**" name='Rate' keyup='SetUserName();' value/> 
           
        </div>
    </div>

   <div id="fatcheck" class="" >
     
    </div>
    
     
<!--<div class="control-group">
<label class="control-label" for="Rate">Rate:</label>
<div class="controls">
  <input type="text" id="fatcheck" class="">
</div>
</div>-->
	 <div class="control-group">
        <label class="control-label" for="r_kg"> Total Amount</label >
        <div class="controls">
            <input class="input-xlarge" id='tot' type="text" placeholder="4**" name='Amount' readonly onkeyup="Sum();" value<?php echo isset($row)?stripslashes($row['Amount']):''; ?>'/> 
            <?php echo $validation['kg'] ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="r_dt"> Time Delivered:</label >
        <div id="datetimepicker1" class="controls input-append date" style="margin-left: 20px">
<!--            <input class="input-xlarge" type="text" data-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" name='r_dt' value='<?php echo date('Y-m-d'); echo isset($row)?stripslashes($row['r_dt']):''; ?>'/> 
            -->
            <input class="input-xlarge" type="text"  name='r_dt' readonly value='<?php echo date('Y-m-d'); ?>'/> 
<!--           
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
            </span>-->
            <?php echo $validation['dt'] ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="r_deliverer"> Milk Delivered by:</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="Deliverer-X.." name='r_deliverer' value='<?php echo isset($row)?stripslashes($row['r_deliverer']):'' ?>'/> 
        </div>
    </div>
    <div class="control-group">

        <div class="controls">
            <input type='submit' value='Save' class="btn btn-success btn-large " /> 
            <input type='hidden' value='1' name='submitted' /> 
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
//        $(function() {
//            $('#datetimepicker1').datetimepicker({
//                language: 'pt-BR',
//                format: 'yyyy-MM-dd'
//            });
//        });
        $("#f_no").on("keyup", function(thisevent) {
            $.post('checkfarmer.json.php', {fname: delivery.f_no.value}, function(jsondata) {
                $('#farmercheck').html(jsondata);
                //$('#farmercheck').addClass('control-group');
            });

        });
        
        $("#fat").on("keyup", function(thisevent) {
            var x;
            if (document.getElementById('b').checked)
            var x = document.getElementById("b").value;
        else
            var x = document.getElementById("c").value;
            
            
            $.post('checkfat.json.php', {fat: delivery.fat.value,type:x}, function(jsondata) {
                $('#fatcheck').html(jsondata);
                //$('#farmercheck').addClass('control-group');
            });

        });
		
    
       
    
});
</script>
<script type="text/javascript">

      function Sum() {
      var txtFirstNumberValue = document.getElementById('rate1').value;
      var txtSecondNumberValue = document.getElementById('kg').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('tot').value = result;
         
      }
}
   
</script>

