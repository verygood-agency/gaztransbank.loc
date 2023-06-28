<?php

//ini_set('session.cookie_httponly', 1);
//ini_set('session.cookie_secure', 1);

//AddEventHandler("main", "OnBeforeProlog", "ChangeHeaders");
//function ChangeHeaders() {
//  header("X-Powered-CMS: ", true);
//}



define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/log.txt");

CModule::AddAutoloadClasses("", array(
    '\Bas\Pict' => '/local/php_interface/user_class/classPict.php',
    '\VG\Image' => '/local/php_interface/user_class/ResizeImage.php',
    
    '\Local\Utils\Settings' => '/local/classes/Utils/Settings.php',
    '\Local\Cities\City' => '/local/classes/Cities/City.php',
    '\Local\helpers\ArrayHelper' => '/local/classes/helpers/ArrayHelper.php',
    '\Local\helpers\Component' => '/local/classes/helpers/Component.php',
    '\Local\helpers\JavaScript' => '/local/classes/helpers/JavaScript.php',
    '\Local\helpers\StringHelper' => '/local/classes/helpers/StringHelper.php',
    '\Local\helpers\Type' => '/local/classes/helpers/Type.php',
    '\Local\Calcs\AbstractCalc' => '/local/classes/Calcs/AbstractCalc.php',
    '\Local\Calcs\Calc' => '/local/classes/Calcs/Calc.php',

    '\Local\Calcs\Credits\AbstractCreditCalc' => '/local/classes/Calcs/Credits/AbstractCreditCalc.php',
    '\Local\Calcs\Credits\FlCredit' => '/local/classes/Calcs/Credits/FlCredit.php',
    '\Local\Calcs\Deposits\AbstractDepositeCalc' => '/local/classes/Calcs/Deposits/AbstractDepositeCalc.php',
    '\Local\Calcs\Deposits\DepositeCalc' => '/local/classes/Calcs/Deposits/DepositeCalc.php',
    '\Local\Calcs\Guarantee\AbstractGuaranteeCalc' => '/local/classes/Calcs/Guarantee/AbstractGuaranteeCalc.php',
    '\Local\Calcs\Guarantee\BankGuaranteeCalc' => '/local/classes/Calcs/Guarantee/BankGuaranteeCalc.php',
    '\Local\Calcs\Types\AnnuetCalc' => '/local/classes/Calcs/Types/AnnuetCalc.php',
    '\Local\Calcs\Types\DepositesCalc' => '/local/classes/Calcs/Types/DepositesCalc.php',
    '\Local\Calcs\Types\DifferencCalc' => '/local/classes/Calcs/Types/DifferencCalc.php',
    '\Local\Calcs\Types\GuaranteeCalc' => '/local/classes/Calcs/Types/GuaranteeCalc.php',
));

include($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
include($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/functions.php');

\Local\Cities\City::init();

//Функция обновления курсов валют (вызывается агентом через каждые 10 минут)
  // подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
  use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
  function currencyUpdateAgent()
  {
    //подключаем модуль highloadblock
    CModule::IncludeModule('highloadblock');

    //Функция получения экземпляра класса:
    function GetEntityDataClass($HlBlockId) {
      if (empty($HlBlockId) || $HlBlockId < 1)
      {
        return false;
      }
      $hlblock = HLBT::getById($HlBlockId)->fetch();
      $entity = HLBT::compileEntity($hlblock);
      $entity_data_class = $entity->getDataClass();
      return $entity_data_class;
    }

    $link = '';
    $html = '';

    //Получение ссылки из highload блока для запроса данных
    $entity_data_class = GetEntityDataClass(8);
    $rsData = $entity_data_class::getList(array(
      'select' => array('UF_LINK'),
      'filter' => array('UF_CODE' => 'currency')
    ));
    while($el = $rsData->fetch()){
      $link = $el['UF_LINK'];
    }

    //Получение данных из restful сервиса
    if ($link) {
      $html = file_get_contents($link);
      $html = substr($html, $l = strpos($html, '<main class="main">'), strpos($html, '</main>') - $l);
      $html = str_ireplace('<main class="main">', '', $html);
      $html = str_ireplace('<div class="section rating-section section_default section_gray section_last">', '', $html);
      $html = str_ireplace('<div class="wrapper wrapper_default">', '', $html);
      $html = str_lreplace('</div>', '', $html);
      $html = str_lreplace('</div>', '', $html);
    }

    //Обновление данных в highload блоке
    if ($html) {
      $idForUpdate = 1;
      $entity_data_class = GetEntityDataClass(8);
      $result = $entity_data_class::update($idForUpdate, array(
        'UF_DATE' => date("d.m.Y H:i:s"),
        'UF_DATA' => $html
      ));
    }

    return "currencyUpdateAgent();";
  }

//Данные капчи
global $reCaptchaKey;
global $reCaptchaSecretKey;
$reCaptchaKey = '6LdDvwQgAAAAANEl8HcoRgtfFI9CYkanZFisfI7_';
$reCaptchaSecretKey = "6LdDvwQgAAAAAA0roGDl7c6_7ORwCDUudhxUBr2I";
