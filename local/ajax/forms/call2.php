<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Json;

$fio = htmlspecialchars($_REQUEST['fio']);
$organization = htmlspecialchars($_REQUEST['organization']);
$phone = htmlspecialchars($_REQUEST['phone']);
$consent = htmlspecialchars($_REQUEST['consent']);
$callbackTitle = htmlspecialchars($_REQUEST['title']);
if (empty($callbackTitle)) {
  $callbackTitle = 'Запрос на обратный звонок';
}
$eventName = htmlspecialchars($_REQUEST['eventname']);
if (empty($eventName)) {
  $eventName = 'FORM_CALLBACK';
}
$sectionId = htmlspecialchars($_REQUEST['sectionid']);
if (empty($sectionId)) {
  $sectionId = 70;
}

//$phone = "+7(999) 999-99-99";

if ($consent == "on") {
  if ($fio && $organization && $phone && $eventName) {
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

        CModule::IncludeModule("iblock");

        $iBlockId = getIblockIdByCode("feedback");
        $el = new CIBlockElement;

        $message =
            $callbackTitle. ": "."\n".
            "ФИО: ".$fio."\n".
            "Организация: ".$organization."\n".
            "Телефон: ".$phone."\n".
            "Страница, с которой была отправлена форма: ".$_SERVER['HTTP_REFERER'];

        $arLoadProductArray = array(
            "IBLOCK_ID"      => $iBlockId,
            "IBLOCK_SECTION_ID" => $sectionId,
            "NAME"           => $callbackTitle. " - ". $phone,
            "ACTIVE"         => "N",
            "PREVIEW_TEXT"   => $message,
            "PROPERTY_VALUES"=> ["POLICY" => date("d.m.Y H:i:s")],
        );

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            $params = array(
                "EVENT_NAME" => $eventName,
                "LID" => SITE_ID,
                "C_FIELDS" => array(
                    "TEXT" => $message,
                    'TITLE' => $phone
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
} else {
  $fields = "Необходимо подтвердить согласие с обработкой персональных данных";
  $result=[
    "status"=>"error",
    "text"=>$fields
  ];
}

//print_r($result);

echo json_encode($result);
?>