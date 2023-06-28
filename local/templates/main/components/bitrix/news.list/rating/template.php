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

<div class="section">
    <div class="wrapper wrapper_default">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php if($arItem['PROPERTIES']['TITLE']['VALUE']):?>
                <h4 class="h4">
                    <?php echo $arItem['PROPERTIES']['TITLE']['VALUE']; ?>
                </h4>
            <?php endif; ?>

            <?php if(!empty($arItem['PROPERTIES']['PROPS']['VALUE'])):?>
                <div class="box box_white table__key-val box_default rating-box">
                    <?php foreach($arItem['PROPERTIES']['PROPS']['VALUE'] as $num => $value): ?>
                        <div class="key-val key-val_sp">
                            <span class="key-val__title h5">
                                <?php echo $value; ?>
                            </span>
                            <span class="key-val__desc h5">
                                <?php echo $arItem['PROPERTIES']['PROPS']['DESCRIPTION'][$num]; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if($arItem['PREVIEW_TEXT']):?>
                <div class="box box_t-small box_h-small">
                    <span class="title title_blue">
                        <?php echo $arItem['PREVIEW_TEXT']; ?>
                    </span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
