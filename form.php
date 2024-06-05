<?php
    
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$db = "wt";
$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn) {
    // echo"connection successfully";
    $name = $_POST["name"];
    $gmail = $_POST["email"];
    $phone = $_POST["phone"];
    $msg = $_POST["message"];
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'anujadeshpande59@gmail.com'; //your email
    $mail->Password = 'iyxlmvxbyqvbevwc'; //your password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('anujadeshpande@gmail.com'); //your gmail
    $mail->addAddress($gmail);
    $mail->isHTML(true);

    $sql = "INSERT INTO `farmbook` (`name`, `gmail`, `phone`, `message`) VALUES ( '$name', '$gmail', '$phone', '$msg'); ";
    $res = $conn->query($sql);
        if ($res){
            
    $mail->Subject = "AgriWell.com "; //$_POST["subject"]; // add subject \
    $mail->Body = "<h1>Thanks for visiting</h1>"; //$_POST["message"];  // message
    $mail->send();
            echo "<script> alert('done');</script>";
            header("Location: ./home.php");
        } else {
            echo "<script> alert('Error');</script>";
        }
}
else{
    die("Connection is not successful");
}



?>