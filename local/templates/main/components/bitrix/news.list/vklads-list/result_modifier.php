<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

//Разделяем вклады на обычные и доступные только для пролонгации
$arDeposits = [];
$arProlongation = [];
foreach($arResult["ITEMS"] as $keyItem => $arItem){
  if ($arItem["PROPERTIES"]["PROLONGATION"]["VALUE"] == "Да") {
    array_push($arProlongation, $arItem);
  } else {
    array_push($arDeposits, $arItem);
  }
}
$arResult["ITEMS"] = [];
$arResult["ITEMS"]["DEPOSITS"] = $arDeposits;
$arResult["ITEMS"]["PROLONGATION"] = $arProlongation;