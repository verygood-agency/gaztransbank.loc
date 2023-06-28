<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
<div class="preims">
    <div class="row">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col col--md-4">
                <div class="box-preim box-preim_offset">
                    <? if(!empty($arItem['PROPERTIES']['SVG']['VALUE'])){
                        $svg = CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']);
                        ?>
                        <a <?if ($arItem['PROPERTIES']['URL']['VALUE']){?> href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>" <?}?> >
                            <svg class="iconed__ico box-preim__ico <?=$arItem['PROPERTIES']['SVG_N']['VALUE'];?>">
                                <use xlink:href="<?=$svg;?>#<?=$arItem['PROPERTIES']['SVG_N']['VALUE'];?>"></use>
                            </svg>
                        </a>
                    <?}?>
                    <? if(!empty($arItem["PREVIEW_PICTURE"])){
                        $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>34, 'height'=>34), BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,75);
                        ?>
                        <a <?if ($arItem['PROPERTIES']['URL']['VALUE']){?> href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>" <?}?> class="box-sale-item__ico">
                            <img class="" src="<?=$img['src'];?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                        </a>
                    <?}?>
                    <a <?if ($arItem['PROPERTIES']['URL']['VALUE']){?> href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>" <?}?> class="box-preim__title title title_semi title_block">
                        <?echo $arItem['NAME']; ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>