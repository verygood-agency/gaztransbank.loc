<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<div class="management">
    <div class="management__items">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
            <div class="management__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="management__item-container">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="management__item-title">
                        <?= $arItem['NAME'] ?>
                    </a>
                    <? if ($arItem['PREVIEW_TEXT']): ?>
                        <div class="management__item-description">
                            <?= $arItem['PREVIEW_TEXT'] ?>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>