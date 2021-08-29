<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
require_once "../process/function.php";
$_SESSION['addedit']="edit";
if(isset($_POST['submit'])){
    $oldUsername = html_entity_decode($_POST['oldusername'], ENT_QUOTES);
    $username = html_entity_decode($_POST['username'], ENT_QUOTES);
    $password = html_entity_decode($_POST['password'], ENT_QUOTES);
   
    if (empty($username)) {
        $_SESSION['validationerror'] = "Username is required";
        header("Location: ../users/list.php");
    } 
    else{
        $databaseFunctions = new databaseFunctions();
        $checkusername=$databaseFunctions->validateUsername($username);
        $checkpassword=$databaseFunctions->validatepassword($oldUsername,$password);
        if ($checkusername == 1 && $checkpassword == 1 && $_SESSION['addedit']== "edit"){
            $databaseFunctions->editUsername($oldUsername,$username);
            header("Location: ../users/list.php");
        }
        else{
            $_SESSION['validationerror'] = "Wrong password";
            header("Location: ../users/list.php");
        }
    }
}
else{
        
}


?>