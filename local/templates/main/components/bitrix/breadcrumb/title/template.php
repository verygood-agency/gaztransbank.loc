<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(!empty($arResult)) {
    $titleReturn = '';
    $descriptionReturn = '';

    $itemSize = count($arResult) - 1;
    for ($index = $itemSize; $index >= 0; $index--) {
        $titleReturn .= htmlspecialcharsex($arResult[$index]["TITLE"]);
        if ($index <> 0) {$titleReturn .= " — ";}
    }

    $titleReturn .= " — ООО КБ «ГТ банк»";

    if (empty($APPLICATION->GetPageProperty("title"))):
        $APPLICATION->SetPageProperty("title", $titleReturn);
    endif;
}

return "";
?>

