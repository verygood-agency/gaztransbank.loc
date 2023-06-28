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
<div class="section section_default">
    <div class="box box_white box_default box-table">
        <h3 class="h3 table-section__title section__title">
            Почему необходимо арендовать сейфовую ячейку<br> именно в Газтрансбанке
        </h3>
        <div class="preim preim_sb">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="preim-item iconed icone_start">
                    <span class="preim-item__ico">
                        <img class="preim-item__pic" src="<?php echo CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']); ?>" width="28" height="28" loading="lazy" alt="<?php echo $arItem['NAME'];?>. ООО КБ «ГТ банк»">
                    </span>
                    <span class="preim-item__title">
                        <?php echo $arItem['NAME']; ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
