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

<div class="large-slider swiper-container">
    <div class="swiper-wrapper">
       <?foreach($arResult["ITEMS"] as $key => $arItem){
        $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>1920, 'height'=>826), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
        $img2=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>600, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
        ?>
       <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="swiper-slide <?if (empty($arItem['PROPERTIES']['DIM']['VALUE'])){echo ("large-slider_light");}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="large-slide">
                <div class="large-slide__pic">
                    <picture class="large-slide__picture">
                        <source media="(max-width: 760px)" srcset="<?=$img2['src'];?>" width="<?=$img2['width'];?>" height="<?=$img2['height'];?>">
                        <source srcset="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>">
                        <img <?if($key <> 0){print ('loading="lazy"');}?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                    </picture>
                </div>
                <div class="large-slide__wrapper wrapper wrapper_default">
                    <div class="large-slide__content">
                        <span class="h1 large-slide__title" style="<?$arItem['PROPERTIES']['TITLE_COLOR']['VALUE']=="Белый цвет" ? : print "color: #343434;"?>">
                            <?=htmlspecialchars_decode($arItem['NAME']);?>
                        </span>
                        <div class="large-slide__desc">
                            <p style="line-height:1.1;">
                                <span style="font-size: 36pt;<?$arItem['PROPERTIES']['SUBTITLE_COLOR']['VALUE']=="Белый цвет" ? : print "color: #002f5a;"?>"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE'];?></span>
                            </p>
                            <span style="<?$arItem['PROPERTIES']['PREVIEW_COLOR']['VALUE']=="Белый цвет" ? : print "color: #343434;"?>">
                                <?=$arItem['PREVIEW_TEXT'];?>
                            </span>
                        </div>
                        <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])){?>
                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" class="btn btn_box btn_red">
                               <?=$arItem['PROPERTIES']['LINK']['DESCRIPTION'];?>
                            </a>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
        <?}?>
    </div>
    <div class="swiper-pagination"></div>
</div>