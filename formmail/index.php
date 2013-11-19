<?php

$to = 'normattconstruction@gmail.com';
$subject = 'Normatt.com Form Submission';
$successurl = '/formmail/success';
$falureurl = '/formmail/failure';

$email_sanitized = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

if(filter_var($email_sanitized, FILTER_VALIDATE_EMAIL)){
  $from = $email_sanitized;
}
else{
  $unique = time();
  $from = "INVALID-EMAIL-$unique@normatt.com";
}

$message  = "Website Form Submission\n\n";
$message .= "Name: {$_POST['name']}\n";
$message .= "Organization: {$_POST['organization']}\n";
$message .= "Phone: ({$_POST['phone_area']}) {$_POST['phone_prefix']}-{$_POST['phone_suffix']}\n";
$message .= "Email: {$_POST['email']}\n\n";
$message .= "Category: {$_POST['category1']}, {$_POST['category2']}, {$_POST['category3']}, {$_POST['category4']}, {$_POST['category5']}\n\n";
$message .= "Address:\n{$_POST['address']}\n{$_POST['city']}, IL\n\n";
$message .= "Details:\n{$_POST['details']}\n\n";
$message .= "System Data:\n";
$message .= "HTTP REFERER: {$_SERVER["HTTP_REFERER"]}\n";
$message .= "REMOTE ADDR: {$_SERVER["REMOTE_ADDR"]}\n";
$message .= "USER AGENT: {$_SERVER["HTTP_USER_AGENT"]}";

$addl_headers = "From: $from";
if (mail($to, $subject, $message, $addl_headers)){
  header("Location: $successurl");
} else {
  header("Location: $failureurl");
}
