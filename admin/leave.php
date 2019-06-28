<?php require('header.php'); ?>
<style >
.badge
{
font-size: 30px;
}
</style>
    <div id="wrapper">

      <?php  include("sidebar.php"); ?>
      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Apply for leave <small></small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i><?php echo $_SESSION['emp_data']->name->value;?>

              <span id="current_date" style="display:none;"><?php echo date("m-d-Y"); ?></span></li>
            <span class="badge" id="casual" style="display:none;" ><?php echo $_SESSION['emp_data']->casual_leave_c->value;?></span>
             <span class="badge" id="sick" style="display:none;"><?php echo $_SESSION['emp_data']->sick_leave_c->value;?></span>
              <input type="hidden" id="probation_period" value="<?php echo $_SESSION['emp_data']->probation_period_c->value;?>" >
            </ol>
            
        </div><!-- /.row -->
<div class=" col-sm-4 "><span><a href="Leave and Work Time Policy_2019 .pdf" class="btn btn-sm btn-info">click here to read outright Leave and Work Time Policy</a></span> <h2>Your leave balance</h2>
  <button type="button" class="btn btn-primary btn-block">Toatal leave  <span class="badge" id="toatal"><?php echo ($_SESSION['emp_data']->casual_leave_c->value+$_SESSION['emp_data']->sick_leave_c->value);?></span></button>   
 <button type="button" class="btn btn-success btn-block">casual leave <span class="badge" id="casual1" ><?php echo $_SESSION['emp_data']->casual_leave_c->value;?></span></button>   
  <button type="button" class="btn btn-danger btn-block">sick leave <span class="badge" id="sick1"><?php echo $_SESSION['emp_data']->sick_leave_c->value;?></span></button>  </div>
 
<div class=" col-sm-4 ">

  <div class="form-group">
    <label for="date_start">start date:</label><label style="float: right;"> half day</label><input style="float: right;" type="checkbox" name="hd1" id="hd1" value="1">
    <input type="text" class="form-control datepicker" id="date_start" name="date_start"   autocomplete="off">
  </div>
  <div class="form-group">
    <label for="date_end">end date:</label><label style="float: right;"> half day</label><input style="float: right;" type="checkbox" name="hd2" id="hd2">
    <input type="text" class="form-control datepicker" id="date_end"  name="date_end"  autocomplete="off"  >
  </div>
  <div class="form-group">
    <label for="type of leave">type of leave:</label>
    <select class="form-control" id="leave_type"  name="leave_type" >
      <!-- <option value="">select leave type</option> -->
      <option value="sick">sick</option>
      <option value="casual">casual</option>
    </select>
  </div>
  <div class="form-group">
    <label for="Reason for applying leave"> Reason for applying leave:</label>
    <input type="text" class="form-control" id="reason" name="reason" >
  </div>

<img src="https://i.pinimg.com/originals/1c/02/38/1c02389831bb2b9faf1cf4f8b809c265.gif" class="img img-responsive" width=""  style="display: none; position: absolute;
  
  z-index: -1;" id="loading">
  <button type="submit" class="btn btn-primary" id="submit" >Submit</button>

</div>


 <script>
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: 0}); 
  } );
  </script>
 </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->


<?php      echo "<script>
var probation_period=".$_SESSION['emp_data']->probation_period_c->value."; 
var sick=".$_SESSION['emp_data']->casual_leave_c->value.";
var casual=".$_SESSION['emp_data']->sick_leave_c->value.";
var current_date=".date("m-d-Y").";
</script>" ;                   ?>

   <?php include('footer.php'); ?>
   <script src="js/validation.js"></script>
