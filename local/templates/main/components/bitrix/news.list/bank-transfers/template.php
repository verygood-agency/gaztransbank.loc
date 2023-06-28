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
<div class="transfers">
    <div class="row">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col col--md-6">
                <a
                    <?php if($arItem['PROPERTIES']['EX_LINK']['VALUE']): ?>
                        href="<?php echo $arItem['PROPERTIES']['EX_LINK']['VALUE']; ?>"
                    <?php else: ?>
                        href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>"
                    <?php endif; ?>
                    class="transfer transfer_b-offset transfer_blue"
                >
                    <span class="transfer__title">
                        <?php echo $arItem['NAME']; ?>
                    </span>
                    <img class="transfer__logo" src="<?php echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                </a>
            </div>
        <?php endforeach;?>
    </div>
</div>
