<?php    
    require_once "function.php";
    $function = new databaseFunctions();
    $id = $_POST['id'];
    $exists = $function->checkUser($id);
    if ($id != '') {
    if ($exists) {
        $function->deleteUser($id);
        echo json_encode(
            array(
                'status' => true,
                'message' => 'Deleted',
                'delete_parent_id' => 'row_' . $id
            )
        );
    } else {
        echo json_encode(
            array(
                'status' => false,
                'message' => 'User does not exist',
                'delete_parent_id' => ''
            )
        );
    }
}
    else{
        echo json_encode(
            array(
                'status' => false,
                'message' => 'Eror page',
                'delete_parent_id' => ''
            )
        ); 
    }


exit();
?>