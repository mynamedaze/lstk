<?php
$name = $_POST['d-name'];
$phone = $_POST['d-tel'];
$mail = $_POST['d-mail'];

$name = htmlspecialchars($name);
$phone = htmlspecialchars($phone);
$mail = htmlspecialchars($mail);

$name = urldecode($name);
$phone = urldecode($phone);
$mail = urldecode($mail);

$name = trim($name);
$phone = trim($phone);
$mail = trim($mail);

$mess = "Заявка с ЛСТК: \n Имя: ".$name."\n Телефон: ".$phone."\n Эл. почта: ".$mail;

$message = $mess;
$email = $mail;
mail("crm@lstkpartner.ru", "Заявка с ЛСТК", $mess,"From: crm@lstkpartner.ru \r\n");

if (isset($phone) && !empty($phone)) {
        require 'vendor/autoload.php';
        require 'amo.php';
}