<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Json;

$_REQUEST['title'] = htmlspecialchars($_REQUEST['title']);
$_REQUEST['name'] = htmlspecialchars($_REQUEST['name']);
$_REQUEST['phone'] = htmlspecialchars($_REQUEST['phone']);
$_REQUEST['product'] = htmlspecialchars($_REQUEST['product']);
$_REQUEST['section'] = htmlspecialchars($_REQUEST['section']);
$_REQUEST['event'] = htmlspecialchars($_REQUEST['event']);
if ($_REQUEST['product']) {
  $_REQUEST['title'] .= " ". $_REQUEST['product'];
}

if ($_REQUEST['title'] && $_REQUEST['phone'] && $_REQUEST['section'] && $_REQUEST['event']) {
  if (htmlspecialcharsbx($_POST['g-recaptcha-response'])) {
    //Функция запроса google сервиса для reCaptcha
    function getCaptcha($UserKey)
    {
      global $reCaptchaSecretKey;
      $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $reCaptchaSecretKey . "&response={$UserKey}");
      $Return = json_decode($Response);
      return $Return;
    }

    $Return = getCaptcha(htmlspecialcharsbx($_POST['g-recaptcha-response']));

    if ($Return->success == true) {

      $message = $_REQUEST['title']. ": \n";
      if ($_REQUEST['name']) {
        $message .= "ФИО: " . $_REQUEST['name'] . "\n";
      }
      $message .= "Телефон: " . $_REQUEST['phone'] . "\n";
      $message .= "Страница, с которой была отправлена форма: ".$_SERVER['HTTP_REFERER'];

      CModule::IncludeModule("iblock");
      $iBlockId = getIblockIdByCode("feedback");
      $el = new CIBlockElement;
      $arLoadProductArray = array(
          "IBLOCK_ID"      => $iBlockId,
          "IBLOCK_SECTION_ID" => $_REQUEST['section'],
          "NAME"           => $_REQUEST['title']. " - ". $_REQUEST['phone'],
          "ACTIVE"         => "N",
          "PREVIEW_TEXT"   => $message,
          "PROPERTY_VALUES"=> ["POLICY" => date("d.m.Y H:i:s")],
      );

      if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
          $params = array(
              "EVENT_NAME" => $_REQUEST['event'],
              "LID" => SITE_ID,
              "C_FIELDS" => array(
                  "TEXT" => $message,
                  'TITLE' => $_REQUEST['phone']
              ),
          );

          Event::send($params);

          $text = "Спасибо, мы перезвоним Вам в ближайшее время";
          $result=[
              "status"=>"success",
              "text"=> $text,
          ];
      } else {
          $result=[
              "status"=>"error",
              "text"=>"Ошибка создания элемента: ".$el->LAST_ERROR,
          ];
      }
    } else {
      $fields = 'Не пройдена проверка "Я не робот"';
      $result = [
        "status" => "error",
        "text" => $fields,
        "captcha" => "reset"
      ];
    }
  } else {
    $fields = 'Пройдите проверку "Я не робот"';
    $result = [
      "status" => "warning",
      "text" => $fields
    ];
  }
} else {
    $fields = "Заполните обязательные поля";
    $result=[
        "status"=>"error",
        "text"=>$fields
    ];
}

//print_r($result);

echo json_encode($result);
?>