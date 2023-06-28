<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Json;

//if (check_bitrix_sessid('sessid_feedback_popup') || check_bitrix_sessid('sessid_feedback') || check_bitrix_sessid()) {
  $context = Application::getInstance()->getContext();
  $request = $context->getRequest();
  if ($request->isAjaxRequest()) {
    if (
      $_REQUEST['name']
      && $_REQUEST['phone']
      && $_REQUEST['product']
    ) {
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

          $id=htmlspecialcharsbx($_REQUEST['id']);
          $name=htmlspecialcharsbx($_REQUEST['name']);
          $city=htmlspecialcharsbx($_REQUEST['city']);
          $phone=htmlspecialcharsbx($_REQUEST['phone']);
          $product=htmlspecialcharsbx($_REQUEST['product']);
          $type=htmlspecialcharsbx($_REQUEST['type']);

          if (strpos($id, 'vklad') !== false) {
            //ФЛ - заявка вклад
            $iBlockSectionId = 58;
            $eventName = 'FORM_FL_DEPOSIT';
          } else if (strpos($id, 'schet') !== false) {
            //ФЛ - заявка счёт
            $iBlockSectionId = 66;
            $eventName = 'FORM_FL_SCHET';
          } else if ($type == "card-debet") {
            //ФЛ - заявка на дебетовую банковскую карту
            $iBlockSectionId = 71;
            $eventName = 'FORM_FL_CARD_DEBET';
          } else if ($type == "card-credit") {
            //ФЛ - заявка на кредитную банковскую карту
            $iBlockSectionId = 72;
            $eventName = 'FORM_FL_CARD_CREDIT';
          } else if (strpos($id, 'credit') !== false) {
            //ФЛ - заявка кредит
            $iBlockSectionId = 60;
            $eventName = 'FORM_FL_CREDIT';
          } else if (strpos($id, 'kredit') !== false) {
            //ЮЛ - заявка кредит
            $iBlockSectionId = 61;
            $eventName = 'FORM_UL_CREDIT';
          } else if (strpos($id, 'deposit') !== false) {
            //ЮЛ - заявка депозит
            $iBlockSectionId = 63;
            $eventName = 'FORM_UL_DEPOSIT';
          } else if (strpos($id, 'guarantee') !== false) {
            //ЮЛ - заявка банковская гарантия
            $iBlockSectionId = 64;
            $eventName = 'FORM_UL_GUARANTEE';
          } else if (strpos($id, 'rko') !== false) {
            //ЮЛ - заявка счёт
            $iBlockSectionId = 62;
            $eventName = 'FORM_UL_SCHET';
          } else if (strpos($id, 'salary') !== false) {
            //ЮЛ - заявка зарплатный проект
            $iBlockSectionId = 101;
            $eventName = 'FORM_UL_SALARY';
          } else if (strpos($id, 'ved') !== false) {
            //ЮЛ - заявка валютный счёт
            $iBlockSectionId = 109;
            $eventName = 'FORM_UL_VED';
          } else {
            //другое
            $eventName = 'FEEDBACK_FORM';
          }

          $message = $product."\n".
            "ФИО: ".$name."\n".
            "Телефон: ".$phone."\n".
            "Город: ".$city."\n".
            "Страница, с которой была отправлена форма: ".$_SERVER['HTTP_REFERER'];

          $arLoadProductArray = array(
            "IBLOCK_ID"      => $iBlockId,
            "IBLOCK_SECTION_ID" => $iBlockSectionId,
            "NAME"           => $product. " - ".$name,
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
                'TITLE' => $product." - ".$name
              ),
            );

            Event::send($params);
            //Event::sendImmediate($params);
            $text = "Сообщение отправлено";
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
    echo Json::encode($result);
  }
//} else {
//  $fields = "Ошибка при отправке формы.";
//  $result=[
//    "status"=>"error",
//    "text"=>$fields
//  ];
//
//  echo Json::encode($result);
//}
