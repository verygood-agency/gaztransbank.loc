<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @var array $arResult
 */

use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;
use Bitrix\Main\LoaderException;

try {
    Extension::load(['main.core']);
} catch (LoaderException $e) {
}
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/modal.min.js');
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/modal.min.css');

if (!$this->__template) {
    $this->InitComponentTemplate();
}

Asset::getInstance()->addCss($this->__template->GetFolder() . '/parts/deposit-modal.css');

foreach ($arResult["ITEMS"]["DEPOSITS"] as $arItem) {
    echo view('forms.product', ['id' => 'vklad-'.$arItem['ID'], 'name' => 'Вклад '.$arItem['NAME']]);
}
foreach ($arResult["ITEMS"]["PROLONGATION"] as $arItem) {
  echo view('forms.product', ['id' => 'vklad-'.$arItem['ID'], 'name' => 'Вклад '.$arItem['NAME']]);
}