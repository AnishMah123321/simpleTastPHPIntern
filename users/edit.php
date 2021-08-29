<?php 
if(!isset($_SESSION)) { 
    session_start(); 
    $_SESSION['addedit']="edit";

  } 
$id=$_POST['id'];
require_once "../includes/header.php";
require_once "../process/function.php"; 

?>
<?php
$databaseFunctions= new databaseFunctions(); 
$users = $databaseFunctions->getUsers();
if ($users->num_rows > 0) {
  
  while($row = $users->fetch_assoc()) {
    if(md5($row['username']) == $id){
        $sno=$row['sno'] ;
        $name=$row['name'] ;
        $username=$row['username'] ;
        $password=$row['password'] ;
        $email=$row['email'] ;
        $contact=$row['mobileNumber'] ;
        $_SESSION['editid']=$sno;
    }
  }
}
// echo $_SESSION['validationerror'];
?>

<br>
<div class="row">
  <div class="col-4"></div>
  <div class="col-4">
<div class="container border p-3">
<div class="alert alert-primary" >
  <h1>Edit User</h1>
  </div>
  <br>
<br>
<?php
if (isset($_SESSION['validationerror'])){
echo "<div class='alert alert-danger' role='alert'><center>";
echo $_SESSION['validationerror'];
$_SESSION['validationerror']=null;
echo "</center></div>";
}

?>
    
<form action="../process/curlPHP.php" id="addUsers" method="POST">
<div class="form-group">
    <label for="inputEmail">Email address</label>
    <input name ="email" type="email" class="form-control" id="email" placeholder="xxxxxxxxxxx@xxxx.xxx" value="<?php echo $email ?>">
  </div>
  <div class="form-group">
    <label for="inputName">Name</label>
    <input name ="name" type="name" class="form-control" id="name" placeholder="Your name" value="<?php echo $name?>">
  </div>
  <div class="row form-group">
    <div class="col">
    <label for="inputUsername">Username</label>
      <input name ="username" type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username?>" readonly>
    </div>
    <div class="col">
    <label for="inputPassword">Password</label>
      <input name ="password" type="password" class="form-control" id="password" placeholder="min-8 | max-30" value="<?php echo $password?>">
    </div>
  </div>
  <div class="row form-group">
  <div class="col">
    <label for="inputContact">Contact no.</label>
      <input name ="contact" type="contact" class="form-control" id="contact" placeholder="9XXXXXXXXX" value="<?php echo $contact?>">
    </div> 
    <div class="col"> 
    Status<br/>
        <select name="status" id="status" class="form-select">
        <option value="active" >active</option>
        <option value="inactive">inactive</option>
        </select>
    </div>
  </div>  
  <br>
  <div name ="recatchaCheck" class="g-recaptcha" data-sitekey="6Leb7CEcAAAAACMqTQ0D2_A-iKOPc3pKvT5QnfrN"></div>
      <br/>
 <a href="list.php">
 <button  name = "button" type="button" class="btn btn-primary">Go back</button>
</a>
  <button  name = "submit" type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>


  <div class="col-4"></div>
</div>

<?php require_once "../includes/footer.php" ?>
