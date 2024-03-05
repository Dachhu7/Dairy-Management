
<form action='' method='POST' class="form-horizontal"> 
    <table align='center' border='2'>
        <tr>
            <td>
      <div class="control-group" align="center">
        <b> <u> Rate List </u> </b>
          </div>
        <div class="control-group">
        <label class="control-label" for="from"> From:</label >
        <div id="datetimepicker1" class="controls input-append date" style="margin-left: 20px">
            <input class="input-xlarge" type="text" data-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" name='from' value='<?php  echo stripslashes($row['from']) ?>'/> 
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
            </span>
           </div>
    </div>
      <div class="control-group">
        <label class="control-label" for="to"> To:</label >
        <div id="datetimepicker2" class="controls input-append date" style="margin-left: 20px">
            <input class="input-xlarge" type="text" data-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" name='to' value='<?php echo date('Y-m-d'); ?>'/> 
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
            </span>
           </div>
    </div>
     <div class="control-group">
        <label class="control-label" for="r_f_no">Type</label > &nbsp; &nbsp;
        
		<input type="radio" name="TT" value="Buffalo" > Buffalo &nbsp; &nbsp;
  <input type="radio" name="TT" value="Cow" > Cow<br>
            
       

    </div>
     <div class="control-group">
        <label class="control-label" for="rate"> Fat </label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="Fat" name='fat' id='' value='<?php echo stripslashes($row['Fat']) ?>'/> 
    </div>
    </div> 
       <div class="control-group">
        <label class="control-label" for="rate"> Rate (Liters)</label >
        <div class="controls">
            <input class="input-xlarge" type="text" placeholder="Rate" name='rate' id='r_kg' value='<?php echo stripslashes($row['rate']) ?>'/> 
    </div>
    </div>  <div class="control-group">

        <div class="controls">
            <input type='submit' value='Save' class="btn btn-success btn-large " /> 
            <input type='hidden' value='1' name='submitted' /> 
        </div>
    </div>
    </td>
    </tr>
    </table>
</form> 
<?php include '../../incl/footer.incl.php'; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $('#datetimepicker1,#datetimepicker2').datetimepicker({
                language: 'pt-BR',
                pickTime:false,
                format:'yyyy-MM-dd'
            });
        });
    });
</script>