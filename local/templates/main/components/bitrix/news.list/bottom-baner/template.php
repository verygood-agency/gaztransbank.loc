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
use \Bas\Pict;
?>
<?if ($arResult["ITEMS"]):?>
    <div class="section section_default section_b-l-offset section_gray">
        <div class="wrapper wrapper_default">
            <?foreach($arResult["ITEMS"] as $arItem){?>
            <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>1296, 'height'=>240), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
                $img2=CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], Array('width'=>345, 'height'=>120), BX_RESIZE_IMAGE_EXACT, true,false,false,65);

                $WebPimg = Pict::getWebp($arItem["PREVIEW_PICTURE"]);
                $WebPimg2 = Pict::getWebp($arItem["DETAIL_PICTURE"]);

                $sTitle = $arItem['PROPERTIES']['TITLE']['VALUE'];
                $sLink = !empty($arItem['PROPERTIES']['LINK']['VALUE']) ? $arItem['PROPERTIES']['LINK']['VALUE'] : null;
                $sDescription = $arItem['PROPERTIES']['DESC']['VALUE'];
                $sTitleTag = $sLink ? 'a' : 'div'
                ?>
                <div class="single-banner" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="single-banner__picture">
                        <a <?if (!empty($arItem['PROPERTIES']['LINK']['VALUE'])){echo ('href="'. $arItem['PROPERTIES']['LINK']['VALUE']. '"');} ?> class="picture" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <picture>
                                <?if ($WebPimg2['WEBP_SRC']):?>
                                    <source media="(max-width: 767px)" srcset="<?=$WebPimg2['WEBP_SRC'];?>" type="image/webp">
                                <?endif;?>
                                <?if ($WebPimg['WEBP_SRC']):?>
                                    <source srcset="<?=$WebPimg['WEBP_SRC'];?>" type="image/webp">
                                <?endif;?>
                                <?if ($img2['src']):?>
                                    <source media="(max-width: 767px)" srcset="<?=$img2['src'];?>" type="image/jpg">
                                <?endif;?>
                                <?if ($img['src']):?>
                                    <source srcset="<?=$img['src'];?>" type="image/jpg">
                                <?endif;?>
                                <img loading="lazy" alt="<?=$arItem['PROPERTIES']['TITLE']['VALUE']?>. ООО КБ «ГТ банк»" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                            </picture>
                        </a>
                    </div>
                    <?if ($sTitle || $sDescription):?>
                        <div class="single-banner__content">
                            <?if ($sTitle):?>
                                <a<?if ($sLink): ?> href="<?=$sLink?>"<?endif;?> id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <div class="single-banner__title"><?= $sTitle ?></div>
                                </a>
                            <?endif;?>
                            <?if ($sDescription):?>
                                <div class="single-banner__description"><?=$sDescription?></div>
                            <?endif;?>
                        </div>
                    <?endif;?>
                </div>
            <?}?>
        </div>
    </div>
<?else:?>
    <div class="section section_default section_gray"></div>
<?endif;?>

