<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Json;

$eventName = 'FORM_VACANCY';

if (check_bitrix_sessid('sessid_feedback_popup') || check_bitrix_sessid('sessid_feedback') || check_bitrix_sessid()) {
    $context = Application::getInstance()->getContext();
    $request = $context->getRequest();
    if ($request->isAjaxRequest()) {
        if (
            $_REQUEST['name']
            && $_REQUEST['phone']
            && $_REQUEST['email']
            && $_REQUEST['vacancy']
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
                    $el = new CIBlockElement;

                    $name = htmlspecialcharsbx($_REQUEST['name']);
                    $phone = htmlspecialcharsbx($_REQUEST['phone']);
                    $email = htmlspecialcharsbx($_REQUEST['email']);
                    $vacancy = htmlspecialcharsbx($_REQUEST['vacancy']);

                    $fileId = null;
                    if ($_FILES['file'] && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "application/pdf") && $_FILES['file']['size'] <= 5242880) {
                      $fileId = CFile::SaveFile(
                        $_FILES['file'],
                        "mail_attachments"
                      );
                    }

                    $message = "Отклик на вакансию: " . $vacancy . "\n" .
                      "ФИО: " . $name . "\n" .
                      "Телефон: " . $phone . "\n" .
                      "E-mail: " . $email . "\n" .
                      "Страница, с которой была отправлена форма: " . $_SERVER['HTTP_REFERER'];

                    if ($fileId) {
                      $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');
                      $siteUrl = $protocol . $_SERVER['SERVER_NAME'];

                      $message .= "\n\nРезюме: " . $siteUrl . CFile::GetPath($fileId);
                    }

                    $arLoadProductArray = array(
                      "IBLOCK_ID" => $iBlockId,
                      "IBLOCK_SECTION_ID" => 65,
                      "NAME" => "Отклик на вакансию: " . $vacancy . " - " . $name,
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
                          "TITLE" => $vacancy . " - " . $name,
                        ),
                      );

                      Event::send($params);
                      $text = "Сообщение отправлено";
                      $result = [
                        "status" => "success",
                        "text" => $text,
                      ];
                    } else {
                      $result = [
                        "status" => "error",
                        "text" => "Ошибка создания элемента: " . $el->LAST_ERROR,
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
