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
<?foreach($arResult["ITEMS"] as $key=> $arItem){?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<div class="activ activ_offset" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
    <div class="activ-table table">
        <?if($key == 0){?><div class="table__tr table__th">
            <div class="table__td" >
                Наименование
            </div>
            <div class="table__td" >
                Площадь
            </div>
            <div class="table__td" >
                Адрес
            </div>
            <div class="table__td" >
                Стоимость
            </div>
            <div class="table__td" ></div>
        </div><?}?>
        <div class="table__tr">
            <div class="table__td" style="width:27%;">
                <span class="table-mobile">
                    Наименование
                </span>
                <span class="table__item">
                    <?=$arItem['PROPERTIES']['TITLE']['VALUE'];?>
                </span>
            </div>
            <div class="table__td" style="width:16%;">
                <span class="table-mobile">
                    Площадь
                </span>
                <span class="table__item">
                    <?=$arItem['PROPERTIES']['SQUARE']['VALUE'];?>
                </span>
            </div>
            <div class="table__td" style="width:34%;">
                <span class="table-mobile">
                    Адрес
                </span>
                <span class="table__item">
                    <?=$arItem['PROPERTIES']['ADDRES']['VALUE'];?>
                </span>
            </div>
            <div class="table__td" style="width:16%;">
                <span class="table-mobile">
                    Стоимость
                </span>
                <span class="table__item">
                    <span class="title title_semi"><?=$arItem['PROPERTIES']['PRICE']['VALUE'];?></span>
                </span>
            </div>
            <div class="table__td" style="width:7%;">
                <span class="arrow arrow_blue arrow_default arrow-js m-btn">
                    <span class="arrow__title">
                        Подробнее
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="activ__content">
        <?=$arItem['PREVIEW_TEXT'];?>
    </div>
</div>
<?}?>









