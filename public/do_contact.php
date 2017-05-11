<?php 
require_once "Mail.php";
//lamp/php/etc/php.ini
//[mail function]
$email = $_POST["email"];
$from = '<huuhung.luyt@gmail.com>';
$to = '<huuhung.luyt@gmail.com>';
$subject = $_POST["subject"];
$body = $_POST["message"];

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);
$message = $body;
$message.='\n'.$email;
$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'huuhung.luyt@gmail.com',
        'password' => 'whitehat.luyt'
    ));

$mail = $smtp->send($to, $headers, $message);

if (PEAR::isError($mail)) {
    echo "ERROR:Update failed";
    exit();
} else {
    echo "SUCCESS:Update successful:";
        exit();
}
?>
