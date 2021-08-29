<?php
require_once "../includes/header.php";

if(!isset($_SESSION)) { 
    session_start(); 
  } 


if(isset($_GET['error'])){
$error = $_GET['error'];
if ($error == 1){
    $errormessage="Captcha Error";
}

}

else if (isset($_SESSION['validationerror'])){
    $errormessage =  $_SESSION['validationerror'];
    $_SESSION['validationerror']=null;

}
else {
    $errormessage = "no error";
}
?>
<br><br>
<br><br>

<div class = "container">
<div class='alert alert-danger' role='alert'><center>
<?php echo $errormessage ?>
</center></div>

  
<a href="list.php">
<button class="btn btn-outline-secondary btn-sm" id="back">Go to list</button>
</a>
</div>
<?php
require_once "../includes/footer.php"
?>



