<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="garanty-info">
   <?foreach($arResult["ITEMS"] as $arItem){?>
   
   <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
   <?
    $lines = $arItem['PROPERTIES']['LINES']['VALUE'];
    foreach($lines as $key => $item){
    ?>
    <div class="key-val garanty-info__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <span class="key-val__title key-val__title_gray">
            <?=$arItem['PROPERTIES']['LINES']['VALUE'][$key];?>
        </span>
        <span class="key-val__desc">
          <? switch($arItem['PROPERTIES']['LINES']['VALUE'][$key]){
        case "E-mail:":
                echo '<a href="mailto:'.$arItem['PROPERTIES']['LINES']['DESCRIPTION'][$key].'">'.$arItem['PROPERTIES']['LINES']['DESCRIPTION'][$key].'</a>';
                break;
        case "Сайт:":
                echo '<a href="//'.$arItem['PROPERTIES']['LINES']['DESCRIPTION'][$key].'">'.$arItem['PROPERTIES']['LINES']['DESCRIPTION'][$key].'</a>';
                break;
            default:
                echo $arItem['PROPERTIES']['LINES']['DESCRIPTION'][$key];
          }?>
          
          
        </span>
    </div>
    <?}}?>
</div>
