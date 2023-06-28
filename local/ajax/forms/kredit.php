<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Json;

$eventName = 'FORM_FL_CREDIT';

if (check_bitrix_sessid('sessid_feedback_popup') || check_bitrix_sessid('sessid_feedback') || check_bitrix_sessid()) {
  $context = Application::getInstance()->getContext();
  $request = $context->getRequest();
  if ($request->isAjaxRequest()) {

    if (
      htmlspecialchars($_POST['policy'])
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
          $iBlockSectionId = 60;
          $el = new CIBlockElement;


          $message = "Условия кредита:\n"
            . "Кредит: " . htmlspecialchars($_POST['credit_name']) . "\n"
            . "Процентная ставка: " . htmlspecialchars($_POST['credit_percent']) . "\n"
            . "Сумма кредита: " . htmlspecialchars($_POST['sum']) . "\n"
            . "Срок кредита: " . htmlspecialchars($_POST['years']) . "\n"
            . "Ежемесячный платеж: " . htmlspecialchars($_POST['monthly_payment']) . "\n"
            . "\n";

          $message .= "Сведения о заявителе:\n"
            . "Фамилия: " . htmlspecialchars($_POST['family']) . "\n"
            . "Имя: " . htmlspecialchars($_POST['name']) . "\n"
            . "Отчество: " . htmlspecialchars($_POST['patronymic']) . "\n"
            . "Телефон: " . htmlspecialchars($_POST['phone']) . "\n"
            . "Электронная почта: " . htmlspecialchars($_POST['email']) . "\n"
            . "\n";

          $message .= "Паспортные данные:\n"
            . "Серия: " . htmlspecialchars($_POST['seria']) . "\n"
            . "Номер: " . htmlspecialchars($_POST['number']) . "\n"
            . "Кем выдан: " . htmlspecialchars($_POST['issued_by']) . "\n"
            . "Дата выдачи: " . htmlspecialchars($_POST['date_by']) . "\n"
            . "Код подразделения: " . htmlspecialchars($_POST['code']) . "\n"
            . "Дата рождения: " . htmlspecialchars($_POST['birth_date']) . "\n"
            . "Место рождения: " . htmlspecialchars($_POST['birth_place']) . "\n"
            . "Адрес регистрации: " . htmlspecialchars($_POST['address_reg']) . "\n"
            . "\n";

          $message .= "Семья:\n"
            . "Есть супруга: " . ($_POST['wife'] == 'yes' ? "Да" : "Нет") . "\n"
            . "Фамилия: " . htmlspecialchars($_POST['wife_family']) . "\n"
            . "Имя: " . htmlspecialchars($_POST['wife_name']) . "\n"
            . "Отчество: " . htmlspecialchars($_POST['wife_patronymic']) . "\n"
            . "Серия: " . htmlspecialchars($_POST['wife_seria']) . "\n"
            . "Номер: " . htmlspecialchars($_POST['wife_number']) . "\n"
            . "Кем выдан: " . htmlspecialchars($_POST['wife_issued_by']) . "\n"
            . "Дата выдачи: " . htmlspecialchars($_POST['wife_date_by']) . "\n"
            . "Код подразделения: " . htmlspecialchars($_POST['wife_code']) . "\n"
            . "Дата рождения: " . htmlspecialchars($_POST['wife_birth_date']) . "\n"
            . "Место рождения: " . htmlspecialchars($_POST['wife_birth_place']) . "\n"
            . "Адрес регистрации: " . htmlspecialchars($_POST['wife_address_reg']) . "\n"
            . "\n";

          $message .= "Доходы:\n"
            . "Ежемесячный доход: " . htmlspecialchars($_POST['income']) . "\n"
            . "Место работы: " . htmlspecialchars($_POST['work']) . "\n"
            . "Время работы на последнем месте: " . htmlspecialchars($_POST['work_time']) . "\n"
            . "Общий стаж: " . htmlspecialchars($_POST['experience']) . "\n"
            . "Должность: " . htmlspecialchars($_POST['position']) . "\n"
            . "\n";

          $message .= "\nСтраница, с которой была отправлена форма: " . $_SERVER['HTTP_REFERER'];

          $arLoadProductArray = array(
            "IBLOCK_ID" => $iBlockId,
            "IBLOCK_SECTION_ID" => $iBlockSectionId,
            "NAME" => 'Заявка на кредит ' . htmlspecialchars($_POST['family']) . " " . htmlspecialchars($_POST['name']) . " " . htmlspecialchars($_POST['patronymic']) . " от " . date('d.m.Y H:i'),
            "ACTIVE" => "N",
            "PREVIEW_TEXT" => $message,
          );

          if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            Event::send(array(
              "EVENT_NAME" => $eventName,
              "LID" => SITE_ID,
              "C_FIELDS" => array(
                "TEXT" => $message,
                'TITLE' => 'Заявка на кредит ' . htmlspecialchars($_POST['family']) . " " . htmlspecialchars($_POST['name']) . " " . htmlspecialchars($_POST['patronymic']) . " от " . date('d.m.Y H:i'),
              ),
            ));
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

    } else {
      $fields = "Необходимо заполнить все обязательные поля!";
      $result = [
        "status" => "warning",
        "text" => $fields
      ];
    };

    echo Json::encode($result);
  }
} else {
  $fields = "Ошибка при отправке формы.";
  $result = [
    "status" => "error",
    "text" => $fields
  ];

  echo Json::encode($result);
}
