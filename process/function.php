<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 

class databaseFunctions{
    
    function getUsers(){
        require_once "connection.php";
        $stmt = "SELECT * FROM USERS"; 
        $qry = mysqli_query($conn,$stmt);
        mysqli_close( $conn );
        return $qry;
    }

    function addUsers($email,$name,$username,$password,$contact,$status){
        require "connection.php";
        $stmt = "INSERT INTO `users` (`sno`, `name`, `username`, `password`, `email`, `mobileNumber`, `status`, `createdDate`) VALUES (NULL, '$name', '$username', '$password', '$email', '$contact', '$status', current_timestamp());"; 
        $qry = mysqli_query($conn,$stmt);
        mysqli_close( $conn );
        header("Location: ../users/list.php?a=1");
    }
    
    function validateUsername($username) {
        require_once "connection.php";
        $stmt = "SELECT * FROM USERS"; 
        $qry = mysqli_query($conn,$stmt);

        if ($qry->num_rows > 0 && $_SESSION['addedit']== "add") {
            while($row = $qry->fetch_assoc()) {
                if($row["username"] == $username){
                    $_SESSION['validationerror'] = "Username already taken";
                    mysqli_close( $conn );
                    header("Location: ../users/add.php");
                    
                    return 0;
                }
            }
        }
        else if ($qry->num_rows > 0 && $_SESSION['addedit']== "edit") {
            $sessid=$_SESSION['editid'];
            while($row = $qry->fetch_assoc()) {
                if ($row['sno'] != $sessid){
                if($row["username"] == $username){

                    $_SESSION['validationerror'] = "Username already taken";
                    mysqli_close( $conn );
                    header("Location: ../users/edit.php?sno=$sessid");
                    return 0;
                }
            }
            }
        }
        mysqli_close( $conn );
        return 1;

    }

    function editUsers($email,$name,$username,$password,$contact,$status){
        require "connection.php";
        $sessid=$_SESSION['editid'];
        $stmt = "UPDATE `users` SET `name` = '$name', `username` = '$username', `password` = '$password', `email` = '$email', `mobileNumber` = '$contact', `status` = '$status' WHERE `users`.`sno` = $sessid;"; 
        $qry = mysqli_query($conn,$stmt);
        mysqli_close( $conn );
        header("Location: ../users/list.php?a=2");

    }

    function deleteUser($delid){

        require "connection.php";
        $stmt = "DELETE FROM `users` WHERE MD5(username) = '$delid';";
        $qry = mysqli_query($conn,$stmt);
    }
    function checkUser($id)
	{
		require "connection.php";
        $stmt = "SELECT * FROM `users` WHERE MD5(username) = '$id';"; 
		$result = mysqli_query($conn, $stmt);
		if ( mysqli_num_rows($result) > 0) {
			mysqli_close( $conn );
			return true;
		} else {
			mysqli_close( $conn );
			return false;
		}
	}   

    function validatepassword($username,$password){
        require "connection.php";
        $stmt = "SELECT * FROM `users` WHERE `username` = '$username' && `password` = '$password';"; 
		$result = mysqli_query($conn, $stmt);
        if ( mysqli_num_rows($result) > 0) {
			mysqli_close( $conn );
			return 1;
		} else {
			mysqli_close( $conn );
			return 0;
		}

    }
    function editUsername($oldUsername,$username){
        require "connection.php";
        $stmt = "UPDATE `users` SET `username` = '$username' WHERE `users`.`username` = '$oldUsername';"; 
		$result = mysqli_query($conn, $stmt);
        mysqli_close( $conn );
    }

}
?>