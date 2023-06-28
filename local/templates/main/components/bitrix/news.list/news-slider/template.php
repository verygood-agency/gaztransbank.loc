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
<div class="news--tiles news--tiles_offset ">
    <div class="news-tiles swiper-container">
        <div class="swiper-wrapper">
           <?foreach($arResult["ITEMS"] as $arItem){
                if(!empty($arItem['DATE_ACTIVE_FROM'])){
                    $date = FormatDate("d F Y",strtotime($arItem["DATE_ACTIVE_FROM"]));
                }else{
                    $date = FormatDate("d F Y",strtotime($arItem["DATE_CREATE"]));
                }

            ?>
            <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
            <div class="swiper-slide">
                <div class="news-tile news-tile_offset" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <span class="date date_default news-tile__date light">
                       <?=$date;?>
                    </span>
                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="news-tile__title light">
                         <?=$arItem['NAME'];?>
                    </a>
                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="btn btn__medium btn_gray">
                        <span class="btn__title">Подробнее</span>
                    </a>
                </div>
            </div>
            <?}?>
        </div>
    </div>
</div>

