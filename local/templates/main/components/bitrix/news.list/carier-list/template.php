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
$component->SetResultCacheKeys(array("ITEMS"));

$this->setFrameMode(true);
?>
<div class="row">
    <? foreach ($arResult["ITEMS"] as $arItem) {
        $zp = $arItem['PROPERTIES']['ZAP']['VALUE']
        ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <?
        if (!empty($arItem['DATE_ACTIVE_FROM'])) {
            $date = FormatDate("d F ", strtotime($arItem["DATE_ACTIVE_FROM"]));
        } else {
            $date = FormatDate("d F", strtotime($arItem["DATE_CREATE"]));
        }

        ?>
        <div class="col col--lg-4 col--md-6">
            <div class="tile tile_h-full tile_default tile_white carier-tile" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <span class="date carier-tile__date"><?= $date; ?></span>
                <div class="carier-tile__content">
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="carier-tile__title"><?= $arItem['NAME']; ?></a>
                    <? if (empty($zp)) { ?>
                        <span class="carier-tile__desc">
                            з/п не указана
                        </span>
                    <? } else { ?>
                        <span class="carier-tile__desc">
                            <?= $zp; ?>
                        </span>
                    <? } ?>
                </div>
                <div class="carier-tile-nav">
                    <a href="#vacancy-popup-<?php echo $arItem['ID']; ?>" class="carier-tile-nav__link btn btn_box box_blue inline-popup" data-title="<?= $arItem['NAME']; ?>">
                        Откликнуться
                    </a>
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="carier-tile-nav__link btn btn_box btn_gray">
                        <span class="btn__title">Подробнее</span>
                    </a>
                </div>
            </div>
        </div>
    <? } ?>
</div>

