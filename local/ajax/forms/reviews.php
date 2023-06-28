<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Json;

if (check_bitrix_sessid('sessid_feedback_popup') || check_bitrix_sessid('sessid_feedback') || check_bitrix_sessid()) {
    $context = Application::getInstance()->getContext();
    $request = $context->getRequest();
    if ($request->isAjaxRequest()) {
        if (
            $_REQUEST['name']
            && $_REQUEST['email']
            && $_REQUEST['message']
        ) {
          if($_FILES['file'] && $_FILES['file']['size'] > 5242880) {
            $fields = 'Файл должен быть меньше 5 мегабайт. <br> Удалите или измените файл';
            $result=[
              "status"=>"error",
              "text"=>$fields
            ];
          } else {
            if($_FILES['file'] && !($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "application/pdf")) {
              $fields = 'У загруженного файла неверный тип. Разрешены следующие типы файлов: jpg, jpеg и pdf. <br> Удалите или измените файл';
              $result = [
                "status" => "error",
                "text" => $fields
              ];
            } else {
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
                  $iBlockSectionId = 82;
                  $el = new CIBlockElement;
                  $eventName = 'FORM_REVIEWS';

                  $message = $product . "\n" .
                    "Имя: " . htmlspecialcharsbx($_REQUEST['name']) . "\n" .
                    "E-mail: " . htmlspecialcharsbx($_REQUEST['email']) . "\n" .
                    "Возраст: " . htmlspecialcharsbx($_REQUEST['age']) . "\n" .
                    "Профессия: " . htmlspecialcharsbx($_REQUEST['profession']) . "\n" .
                    "Место проживания: " . htmlspecialcharsbx($_REQUEST['city']) . "\n" .
                    "Сообщение: " . htmlspecialcharsbx($_REQUEST['message']) . "\n";

                  $fileId = null;
                  if ($_FILES['file'] && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "application/pdf") && $_FILES['file']['size'] <= 5242880) {
                    $fileId = CFile::SaveFile(
                      $_FILES['file'],
                      "mail_attachments"
                    );
                  }

                  if ($fileId) {
                    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');
                    $siteUrl = $protocol . $_SERVER['SERVER_NAME'];

                    $message .= "Файл: " . $siteUrl . CFile::GetPath($fileId);
                  }

                  $message .= "\nСтраница, с которой была отправлена форма: " . $_SERVER['HTTP_REFERER'];

                  $arLoadProductArray = array(
                    "IBLOCK_ID" => $iBlockId,
                    "IBLOCK_SECTION_ID" => $iBlockSectionId,
                    "NAME" => $product . " - " . $name,
                    "ACTIVE" => "N",
                    "PREVIEW_TEXT" => $message,
                    "PROPERTY_VALUES"=> ["POLICY" => date("d.m.Y H:i:s")],
                  );


                  if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    $params = array(
                      "EVENT_NAME" => $eventName,
                      "LID" => SITE_ID,
                      "C_FIELDS" => array(
                        "TEXT" => $message,
                        'TITLE' => $name
                      ),
                    );

                    Event::send($params);
                    //Event::sendImmediate($params);
                    $text = "Сообщение отправлено";
                    $result = [
                      "status" => "success",
                      "text" => $text,
                      "captcha" => "reset"
                    ];
                  } else {
                    $result = [
                      "status" => "error",
                      "text" => "Ошибка создания элемента: " . $el->LAST_ERROR,
                      "captcha" => "reset"
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
            }
          }
        } else {
            $fields = "Заполните обязательные поля";
            $result=[
                "status"=>"error",
                "text"=>$fields
            ];
        }
        echo Json::encode($result);
    }
} else {
    $fields = "Ошибка при отправке формы.";
    $result=[
        "status"=>"error",
        "text"=>$fields
    ];

    echo Json::encode($result);
}
