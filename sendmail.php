<?php

session_start();
if($_SESSION['SESS_id']=="" || $_SESSION['SESS_id']==" ") 
	{
	header("location:index.php");
  }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//ini_set('display_errors', true);
//error_reporting(E_ALL);
if(isset($_POST['Action']) && $_POST['Action']=='SendMail'  && !empty($_POST['answerQA']))
{
  
   $datastringA=$_POST['answerQA'];
   echo  $datastringA;

   $string=str_replace('<div class="message to ready">',"<li>",$datastringA);
   $stringN=str_replace('<div class="message from">',"<li>",$string);
   $stringF=str_replace('</div>',"</li>",$stringN);
   $messages="<ul>".$stringF."<ul>";
    
    // //$answer= explode("<br>", $datastringA);
    // $messages="<ul>";
    // $i=0;
    // foreach($answer as $val)
    // {
    //        $messages.= "<li>".$answer[$i]."</li>";
    //   $i++;    
    // }
    // $messages.="</ul>";
   //echo $messages;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer\PHPMailer\PHPMailer(true);
//$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'blinkInteract18@gmail.com';          // SMTP username
$mail->Password = 'trinabh18'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('blinkInteract18@gmail.com','BlinkInteract');
$mail->addReplyTo('supriya.ghumatkar@v2solutions.com', 'BlinkInteract');
$mail->addAddress('supriya.ghumatkar@v2solutions.com');   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = $messages;
//$bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';

$mail->Subject = 'Chat History';
$mail->Body    = $messages;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

    
}