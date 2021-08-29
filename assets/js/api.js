
const deleteUser = (dataId) => {
  
 //console.log(result);

Swal.fire({
    title: 'Are you sure?',
    text: "You want to delete this user",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    
    if (result.isConfirmed) {
        //console.log(dataId);
        $.ajax({
            type : "POST",  //type of method
            data : { id : dataId},// passing the values
            url  : "../process/delete_user.php",  //your page
            success : function (result){
                //console.log(result);
                let pageDeleter= document.getElementById("delete"+dataId);
                pageDeleter.parentNode.parentNode.remove();

                let response = JSON.parse(result);
                if(response.status){
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: 'The user you tried to delete has been removed!'
                      });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'The user you tried to delete could not be removed!'
                      });
                }
            }
            });
        
        
    }
  });
  

}

const editUser = (dataId) => {
  $.redirect("../users/edit.php",
    {
        id : dataId,
    });
 
}

const addEditThrower = (data) => {
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
if(data == 1){
Toast.fire({
  icon: 'success',
  title: 'data added successfully'
})
}
else if (data == 2){
  Toast.fire({
    icon: 'success',
    title: 'Data edted successfully'
  })
}
}
const resetEditUSername = () =>{
  let moduleAdder= document.querySelector(".editUsernameData");
  //console.log(moduleAdder);
  moduleAdder.remove();
  //console.log(moduleAdder);
}
const editUsername = (data,oldUsername) => {
  resetEditUSername();
  let moduleAdder= document.getElementById("editUsername");
  //console.log(oldUsername);
  //console.log(moduleAdder);
  let div = document.createElement('div');
  div.innerHTML = `


  <form action="../process/changeUsername.php" id="editUserValidate" method="POST">
  <div class="row form-group">
      
      <label for="inputOldUsername" hidden>OldUsername</label>
        <input name ="oldusername" type="text" class="form-control" id="oldusername" placeholder="Old username" value="${oldUsername}" hidden>
      </div>
    <div class="row form-group">
      <div class="col">
      <label for="inputUsername">Username</label>
        <input name ="username" type="text" class="form-control" id="username" placeholder="New username">
      </div>
      <div class="col">
      <label for="inputPassword">Password</label>
        <input name ="password" type="password" class="form-control" id="password" placeholder="Verify Password">
      </div>
    </div>
   <br>
    <button  name = "submit" type="submit" class="btn btn-primary">Submit</button>

  `;
div.classList.add('editUsernameData');
moduleAdder.appendChild(div);

}

