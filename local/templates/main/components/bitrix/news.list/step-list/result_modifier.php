<?
/**
 * @var array $arParams
 * @var array $arResult
 */

$dbSection = CIBlockSection::GetList(Array(), array("CODE" => $arParams["PARENT_SECTION_CODE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false ,Array("UF_*"));
if($arSection = $dbSection->GetNext()){
    $arResult["SECTION_PP"] = $arSection;
}
?>