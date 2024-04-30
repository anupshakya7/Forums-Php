<?php

$showErrors = false;
$showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $cpassword = $_POST['signupcPassword'];

    //Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE `email`= '$email';";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    if($numRows > 0) {
        $showErrors = "Email already in use";
    } else {
        if($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO `users` (`email`, `password`, `timestamp`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql_insert);
            if($result) {
                $showAlert = true;
                header('location: /codewithharry/Forums-Php/index.php?signupsuccess=true');
                exit();
            }
        } else {
            $showErrors = "Password donot Match";
        }
    }
    header('location: /codewithharry/Forums-Php/index.php?signupsuccess=false&error='.$showErrors.'');

}
