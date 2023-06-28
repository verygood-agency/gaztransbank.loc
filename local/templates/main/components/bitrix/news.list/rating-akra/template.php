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
<?php foreach ($arResult["ITEMS"] as $arItem): ?>
    <div class="rating">
        <h4 class="h4 rating__title">
            <?php echo $arItem['NAME']; ?>
        </h4>
        <div class="box box_white box_default">
            <div class="table table_default dep-table">
                <div class="table__tr table__tr_th">
                    <div class="table__td">
                        Рейтинговое агентство
                    </div>
                    <div class="table__td">
                        Рейтинг
                    </div>
                    <div class="table__td">
                        Уровень рейтинга/Прогноз
                    </div>
                    <div class="table__td">
                        Дата присвоения / подтверждения рейтинга
                    </div>
                </div>

                <div class="table__tr">
                    <div class="table__td" style="width:30%;">
                        <span class="table-mobile">
                            Рейтинговое агентство
                        </span>
                        <span class="table__item">
                            <?php echo $arItem['PROPERTIES']['AGENT']['VALUE']; ?>
                        </span>
                    </div>
                    <div class="table__td">
                        <span class="table-mobile">
                            Рейтинг
                        </span>
                        <span class="table__item">
                            <?php echo $arItem['PROPERTIES']['RATING']['VALUE']; ?>
                        </span>
                    </div>
                    <div class="table__td">
                        <span class="table-mobile">
                            Уровень рейтинга/Прогноз
                        </span>
                        <span class="table__item">
                            <?php echo $arItem['PROPERTIES']['LEVEL']['VALUE']; ?>
                        </span>
                    </div>
                    <div class="table__td">
                        <span class="table-mobile">
                            Дата присвоения / подтверждения рейтинга
                        </span>
                        <span class="table__item">
                            <?php echo $arItem['PROPERTIES']['DATE']['VALUE']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box_default">
            <span class="title title_blue">
                <?php echo $arItem['PREVIEW_TEXT']; ?>
            </span>
        </div>
    </div>
<?php endforeach; ?>
