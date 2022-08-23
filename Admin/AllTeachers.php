<?php
session_start();
define('TITLE', 'All Teachers');
define('PAGE', 'Allteacher');
include('includes/header.php');
include('../dbcon.php');

if(isset($_SESSION['is_adminlogin']))
{
    $aemail = $_SESSION['aEmail'];
}
else
{
    header('location:login.php');
}
?>

<div class="col-sm-4 mb-5">
 <form action="AdminAddteacher.php" method="POST">
 <button type="submit" class="btn btn-success mt-5" value="ADD" name="addteacher"><i class="fas fa-plus fa-1x"></i></button>
 </form>
  <!-- Main Content area start Middle -->
  <?php
    $sql = "SELECT * FROM registration_tb";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0)
  {
  while ($row = mysqli_fetch_assoc($result))
  {
   echo '<div class="card mt-5 mx-5">';
   echo '<div class="card-header">';
   echo 'Teacher ID : '. $row['id'];
   echo '</div>';
   echo '<div class="card-body">';
   echo '<h5 class="card-title">Teacher Name : ' . $row['username'] . '</h5>';
   echo '<p class="card-text">Email : ' . $row['email'] . '</p>';
   echo '<p class="card-text">Mobile Number : ' . $row['mobile'] . '</p>';
   echo '<div class="float-right">';
   echo '<form action="" method="POST"> <input type="hidden" name="id" value='. $row["id"] .'><button type="submit" class="btn btn-danger mr-3" name="view" value="View" ><i class="far fa-eye"></i></button><button type="submit" class="btn btn-secondary" name="close" value="Close"><i class="far fa-trash-alt"></i></button></form>';
   echo '</div>' ;
   echo '</div>' ;
   echo'</div>';
  }
 } 
 else 
 {
  echo '<div class="alert alert-info mt-5 col-sm-6" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, 0 Teacher Found .</p>
  <hr>
  <h5 class="mb-0">No Teacher</h5>
  </div>';
 }
?>
</div> <!-- Main Content area End Middle -->

<?php

if(isset($_POST['view'])){
 $sql = "SELECT * FROM registration_tb WHERE id = {$_POST['id']}";
 $result = mysqli_query($con, $sql);
 $row = mysqli_fetch_assoc($result);
 }

 if(isset($_POST['close']))
 {
    $sql = "DELETE FROM registration_tb WHERE id = {$_POST['id']}";
    $result = mysqli_query($con, $sql);
    if($result == TRUE)
    {
      echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
    }
    else
    {
      echo "Unable to Delete";
    }
 }

?>

<div class="col-sm-5 mt-5 jumbotron">
  <!-- Main Content area Start Last -->
  <form action="" method="POST">
    <h4 class="text-center">Teacher Details</h4>
    <div class="form-group">
      <label for="request_id">Teacher ID</label>
      <input type="text" class="form-control" id="request_id" name="request_id" value="<?php if(isset($row['id'])) {echo $row['id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="requestername">Name</label>
      <input type="text" class="form-control" id="requestername" name="requestername" value="<?php if(isset($row['username'])) {echo $row['username']; }?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="address1">Password</label>
        <input type="text" class="form-control" id="address1" name="address1" value="<?php if(isset($row['cpassword'])) {echo $row['cpassword']; }?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="address2">Status</label>
        <input type="text" class="form-control bg-dark text-light" id="address2" name="address2" value="<?php if(isset($row['status'])) {echo $row['status']; }?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label for="requestercity">Registration Date</label>
        <input type="text" class="form-control" id="requestercity" name="requestercity" value="<?php if(isset($row['register_date'])) {echo $row['register_date']; }?>" readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label for="requesteremail">Email</label>
        <input type="email" class="form-control" id="requesteremail" name="requesteremail" value="<?php if(isset($row['email'])) {echo $row['email']; }?>">
      </div>
      <div class="form-group col-md-4">
        <label for="requestermobile">Mobile</label>
        <input type="text" class="form-control" id="requestermobile" name="requestermobile" value="<?php if(isset($row['mobile'])) {echo $row['mobile']; }?>">
      </div>
    </div>
    <br>
    <div class="float-right">
      <button type="submit" class="btn btn-success" name="assign">Update</i></button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</div>



<?php
include('includes/footer.php'); 
?>