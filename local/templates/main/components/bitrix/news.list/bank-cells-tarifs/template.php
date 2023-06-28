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
<div class="activ-table activ-table_small  tarifs-table table">
    <div class="table__tr table__th">
        <div class="table__td" style="width:28%;">
            Вид аренды
        </div>
        <div class="table__td" style="width:36%;">
            Размеры ячеек
        </div>
        <div class="table__td" style="width:36%;">
            Комиссия, в т.ч. НДС
        </div>
    </div>
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="table__tr">
            <div class="table__td">
                <span class="table-mobile">
                    Вид аренды
                </span>
                <span class="table__item">
                    <span class="h5"><?php echo $arItem['NAME']; ?></span>
                </span>
            </div>
            <div class="table__td">
                <span class="table-mobile">
                    Размеры ячеек
                </span>
                <span class="table__item">
                    <?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']); ?>
                </span>
            </div>
            <div class="table__td">
                <span class="table-mobile">
                    Комиссия, в т.ч. НДС
                </span>
                <span class="table__item">
                    <?php echo htmlspecialchars_decode($arItem['DETAIL_TEXT']); ?>
                </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>
