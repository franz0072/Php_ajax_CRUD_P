<?php
include 'connect.php';


//we are using insertion with ajax , so dont need this.$name=$_POST['name']
//here we use extract method

//with one extract code access all data from ajax data
extract($_POST);

if (
    isset($_POST['nameSend']) && isset($_POST['emailSend'])
    && isset($_POST['mobileSend']) && isset($_POST['placeSend'])
) {

    $sql = "INSERT INTO crud (name, email, mobile, place) VALUES ('$nameSend', '$emailSend', '$mobileSend', '$placeSend')";
    //execute query
    $result = mysqli_query($con,$sql);
    


}

?>