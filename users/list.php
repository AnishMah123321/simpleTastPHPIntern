<?php 
if(!isset($_SESSION)) { 
  session_start(); 
} 
if(isset($_SESSION['validationerror']))
{

}
if(isset($_GET['a'])){
$aedata=$_GET['a'];
}
require_once "../includes/header.php";
require_once "../process/function.php"; 
?>
<div class="container">
<div class="alert alert-primary" >
  <h1>User List</h1>
  </div>
  <a href="add.php">
<button class="btn btn-outline-secondary btn-sm" type="add" id="add" >Add User</button></a>

<?php
if (isset($_SESSION['validationerror'])){
echo "<div class='alert alert-danger' role='alert'><center>";
echo $_SESSION['validationerror'];
$_SESSION['validationerror']=null;
echo "</center></div>";
}

?>
<br><br>


<table class="table table-bordered" id="usersTable">
  <thead>
    <tr>
      <th scope="col">S.NO.</th>
      <th scope="col">Name</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Contact no.</th>
      <th scope="col">Status</th>
      <th scope="col">Created Date</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
 
  <!-- getting users from database -->
    <?php 
    $databaseFunctions= new databaseFunctions(); 
    $users = $databaseFunctions->getUsers();
    if ($users->num_rows > 0) {
      
      while($row = $users->fetch_assoc()) {
        $passdata= md5($row["username"]);
    ?>
    <tr class="actionHere">
      <th scope="row"><?php echo $row["sno"] ?></th>
      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["username"]?>
      <i class=" btn-sm bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#exampleModal" id="username<?php echo $passdata ?>"></i></td>
      <script>
       document.getElementById("username<?php echo $passdata?>").onclick = function () {
        editUsername("<?php echo $passdata ?>","<?php echo $row["username"] ?>");
    }
      </script>



      <td><?php echo $row["email"] ?></td>
      <td><?php echo $row["mobileNumber"] ?></td>
      <td><?php echo $row["status"] ?></td>
      <td><?php echo $row["createdDate"] ?></td>
      <td>
   
      <button class="btn btn-outline-secondary btn-sm edit" type="edit" name="edit" id="edit<?php echo $passdata ?>">Edit</button>

      <script>
       document.getElementById("edit<?php echo $passdata?>").onclick = function () {
        editUser("<?php echo $passdata ?>");
    }
      </script>
   
      <button class="btn btn-outline-secondary btn-sm delete" type="delete" name="delete" id="delete<?php echo $passdata ?>">Delete</button>
     <script>
       document.getElementById("delete<?php echo $passdata?>").onclick = function () {
        deleteUser("<?php echo $passdata ?>");
    }
      </script>

      </td>
    </tr>
    <?php
        }
      } else {
        ?>
      
      <th scope="row"></th>
      <td colspan="7"><center><b>No data found.</b></center></td>
<?php
        
      }
    ?>

</tbody>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id = "editUsername">
        <div class ="editUsernameData">
    </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>






<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript"  src="../assets/js/api.js"></script>
<script type="text/javascript" defer src="../assets/js/userTable.js"></script>

<?php
if(isset($aedata)){
echo "<script> addEditThrower('$aedata') </script>";
}
?>
<?php require_once "../includes/footer.php" ?>