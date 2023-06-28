<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

use \VG\Image;

//Подготовка детальной картинки
if ($arResult["PREVIEW_PICTURE"]) {
  $arSizes = [
    ['WIDTH'=>'1920', 'HEIGHT'=>'546', 'W'=>'1920'],
    ['WIDTH'=>'1024', 'HEIGHT'=>'480', 'W'=>'1024'],
    ['WIDTH'=>'768', 'HEIGHT'=>'350', 'W'=>'768'],
    ['WIDTH'=>'375', 'HEIGHT'=>'188', 'W'=>'375']
  ];
  $arPicture = [
    'SOURCES' => [],
    'SRC' => $arResult["PREVIEW_PICTURE"]['SRC'],
    'ALT' => $arResult["PREVIEW_PICTURE"]['ALT'],
    'WIDTH' => $arResult["PREVIEW_PICTURE"]['WIDTH'],
    'HEIGHT' => $arResult["PREVIEW_PICTURE"]['HEIGHT']
  ];
  foreach ($arSizes as $keySize=>$arSize) {
    $arResizeImage = Image::resizeImageWebp($arResult["PREVIEW_PICTURE"], ['width' => $arSize['WIDTH'], 'height' => $arSize['HEIGHT']],BX_RESIZE_IMAGE_EXACT,true);
    if ($keySize == 0) {
      $arPicture['SOURCES']['WEBP']['SRCSET'] = $arResizeImage['src_webp'] . ' '. $arSize['W']. 'w';
      $arPicture['SOURCES']['WEBP']['TYPE'] = 'image/webp';
      $arPicture['SOURCES'][$arResult["PREVIEW_PICTURE"]['CONTENT_TYPE']]['SRCSET'] = $arResizeImage['src'] . ' '. $arSize['W']. 'w';
      $arPicture['SOURCES'][$arResult["PREVIEW_PICTURE"]['CONTENT_TYPE']]['TYPE'] = $arResult["PREVIEW_PICTURE"]['CONTENT_TYPE'];
    } else {
      $arPicture['SOURCES']['WEBP']['SRCSET'] = $arPicture['SOURCES']['WEBP']['SRCSET']. ', '. $arResizeImage['src_webp'] . ' '. $arSize['W']. 'w';
      $arPicture['SOURCES'][$arResult["PREVIEW_PICTURE"]['CONTENT_TYPE']]['SRCSET'] = $arPicture['SOURCES'][$arResult["PREVIEW_PICTURE"]['CONTENT_TYPE']]['SRCSET']. ', '. $arResizeImage['src'] . ' '. $arSize['W']. 'w';
    }
  }

  $arResult["PREVIEW_PICTURE"] = $arPicture;
}

//Подготовка картинок акций
foreach ($arResult["PROPERTIES"]["PROMOTION"]["VALUE"] as $keyPromotion => $idPromotion) {
  $arResult["PROPERTIES"]["PROMOTION"]["VALUE"][$keyPromotion] = CFile::GetFileArray($idPromotion);
}

//Подготовка картинок привилегий
foreach ($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"] as $keyAdvantages => $idAdvantages) {
  $arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"][$keyAdvantages] = CFile::GetFileArray($idAdvantages);
}