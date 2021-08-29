<?php

 $dbhost = "";
 $dbuser = "";
 $dbpass = "";
 $db = "";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
//  if($conn){
//      echo"done";
//  }
//  else{
//      echo"not done";
//  }
 
 return $conn;

 ?>