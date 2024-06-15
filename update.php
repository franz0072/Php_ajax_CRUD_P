<?php
include 'connect.php';


if(isset($_POST['updateid'])){
    $user_id = $_POST['updateid'];

    $sql = "Select * from `crud` where id = $user_id";
    $result = mysqli_query($con,$sql);
    $response = array();
  
    while($row = mysqli_fetch_assoc($result)){
        //storing row as array
        $response = $row;
    }
    //convert object into json format with php built in function
    echo json_encode($response);
}else{
    $response['status'] = 200;
    $response['message'] = "Invalid or data not found";
}

//update query
if(isset($_POST["hiddendata"])){
    $uniqueid=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $email=$_POST['updateemail'];
    $mobile=$_POST['updatemobile'];
    $place=$_POST['updateplace'];

    $sql = "UPDATE `crud` SET name='$name', email='$email', mobile='$mobile', place='$place' WHERE id=$uniqueid";
    $result = mysqli_query($con,$sql);

}
?>