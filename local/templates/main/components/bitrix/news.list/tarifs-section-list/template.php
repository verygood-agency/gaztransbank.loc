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


<div class="faq-w">
        <? foreach ($arResult["ITEMS"] as $arItem) {

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="toggle-w toggle-w_b-offset toggle-w_light" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                <div class="toggle-w__header ">
                    <? if (!empty($arItem['PROPERTIES']['ICO']['VALUE'])) {
                        $icon = CFile::GetPath($arItem['PROPERTIES']['ICO']['VALUE']);
                        ?>
                        <div class="pic-w">
                            <div class="pic-w__ico">
                                <img class="pic-w__ico" src="<?= $icon; ?>" alt="">
                            </div>
                            <span class="pic-w__title">
                                <?= $arItem['NAME'] ?>
                            </span>
                        </div>
                    <? } else { ?>
                        <span class="toggle-w__title h4 title title_light"><?= $arItem['NAME'] ?></span>
                        <i class="toggle-w__arrow"></i>
                    <? } ?>
                </div>
                <div class="toggle-w__content">
                    <?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']);?>
                </div>
            </div>
        <? } ?>
</div>


