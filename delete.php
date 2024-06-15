<?php
include 'connect.php';

if(isset($_POST['deleteSend'])){
    $unique = $_POST['deleteSend'];

    $sql = "delete from `crud` where id=$unique";
    $result = mysqli_query($con,$sql);

}

?>