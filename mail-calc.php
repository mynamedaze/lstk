<?php
$name = $_POST['d-name'];
$phone = $_POST['d-tel'];
$floorsInfo = $_POST['d-floors'];
$widthInfo = $_POST['d-width'];
$lengthInfo = $_POST['d-length'];
$fundamentInfo = $_POST['d-fundament'];
$fieldInfo = $_POST['d-field'];
$cityInfo = $_POST['d-city'];
$moreInfo = $_POST['d-more-info'];

$name = htmlspecialchars($name);
$phone = htmlspecialchars($phone);
$floorsInfo = htmlspecialchars($floorsInfo);
$widthInfo = htmlspecialchars($widthInfo);
$lengthInfo = htmlspecialchars($lengthInfo);
$fundamentInfo = htmlspecialchars($fundamentInfo);
$fieldInfo = htmlspecialchars($fieldInfo);
$cityInfo = htmlspecialchars($cityInfo);
$moreInfo = htmlspecialchars($moreInfo);

$name = urldecode($name);
$phone = urldecode($phone);
$floorsInfo = urldecode($floorsInfo);
$widthInfo = urldecode($widthInfo);
$lengthInfo = urldecode($lengthInfo);
$fundamentInfo = urldecode($fundamentInfo);
$fieldInfo = urldecode($fieldInfo);
$cityInfo = urldecode($cityInfo);
$moreInfo = urldecode($moreInfo);

$name = trim($name);
$phone = trim($phone);
$floorsInfo = trim($floorsInfo);
$widthInfo = trim($widthInfo);
$lengthInfo = trim($lengthInfo);
$fundamentInfo = trim($fundamentInfo);
$fieldInfo = trim($fieldInfo);
$cityInfo = trim($cityInfo);
$moreInfo = trim($moreInfo);

$mess = "Заявка с ЛСТК (квиз): \n Имя: ".$name."\n Телефон: ".$phone."\n Количество этажей: ".$floorsInfo."\n Ширина: ".$widthInfo."\n Длина: ".$lengthInfo."\n Наличие фундамента: ".$fundamentInfo."\n Район (край/область): ".$fieldInfo."\n Населенный пункт: ".$cityInfo."\n Примечания: ".$moreInfo;

$message = $mess;

mail("crm@lstkpartner.ru", "Заявка с ЛСТК", $mess,"From: crm@lstkpartner.ru \r\n");

if (isset($phone) && !empty($phone)) {
        require 'vendor/autoload.php';
        require 'amo.php';
}