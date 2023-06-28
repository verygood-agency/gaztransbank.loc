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
$component->SetResultCacheKeys(array("ID", "NAME"));
$this->setFrameMode(true);

$callbackTitle = "Подать заявку на лизинг";
$eventName = 'FORM_UL_LIZING';
$sectionId = '135';
?>
<div class="app">
    <div class="first-screen">
        <div class="first-screen__picture">
            <?if($arResult["PREVIEW_PICTURE"]):?>
                <div class="picture">
                    <picture>
                        <?foreach($arResult["PREVIEW_PICTURE"]['SOURCES'] as $arSource):?>
                            <source srcset="<?= $arSource['SRCSET'] ?>" sizes="100vw" type="<?= $arSource['TYPE'] ?>"/>
                        <?endforeach;?>
                        <img alt="<?=$arResult["PROPERTIES"]["HEADING"]["VALUE"];?>" src="<?= $arResult["PREVIEW_PICTURE"]['SRC'] ?>" width="<?= $arResult["PREVIEW_PICTURE"]['WIDTH'] ?>" height="<?= $arResult["PREVIEW_PICTURE"]['HEIGHT'] ?>">
                    </picture>
                </div>
            <?endif?>
        </div>
        <div class="first-screen__container">
            <div class="wrapper wrapper_default">
                <div class="first-screen__content">
                    <div class="first-screen__title">
                        <h1><?=htmlspecialchars_decode($arResult["NAME"])?></h1>
                    </div>
                    <div class="first-screen__description">
                        <?=$arResult["PREVIEW_TEXT"]?>
                    </div>
                    <div class="first-screen__btn">
                        <a href="#product-open-lizing" data-title="Подать заявку на лизинг" class="inline-t-popup btn btn_box btn_red">Подать заявку</a>
                        <?php echo view('forms.product3', ['id' => 'lizing', 'name' => 'lizing', 'callbackTitle' => $callbackTitle, 'eventName' => $eventName, 'sectionId' => $sectionId]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="for-business">
        <div class="for-business__container section_gray_important">
            <div class="wrapper wrapper_default">
                <div class="for-business__title">
                    <h2 style="text-align:center;"><?=$arResult["PROPERTIES"]["ADVANTAGES_TITLE"]["VALUE"]?></h2>
                </div>
                <div class="row">
                    <?foreach ($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"] as $arAdvantages):?>
                        <div class="col col--lg-4 col--sm-6">
                            <span class="pic-link pic-link_b-offset pic-link_white">
                                <span class="pic-link__title">
                                    <?=$arAdvantages["DESCRIPTION"]?>
                                </span>
                                <img class="pic-link__img" src="<?=$arAdvantages["SRC"]?>" width="<?=$arAdvantages['width'];?>" height="<?=$arAdvantages['height'];?>" alt="<?=$arAdvantages["DESCRIPTION"]?>" title="<?=$arAdvantages["DESCRIPTION"]?>">
                            </span>
                        </div>
                    <?endforeach;?>
                </div>
                <div class="for-business__title" style="margin-top: 24px;">
                    <h2 style="text-align:center;font-weight: bold; font-size: 40px;">Финансируем напрямую с баланса банка</h2>
                </div>
                <div class="issue-card__items-wrapper issue-card__items">
                    <div class="issue-card__item">
                        <div class="issue-card-item">
                            <div class="issue-card-item__container">
                                <div class="issue-card-item__num">
                                    <img src="/upload/lizing-1.svg">
                                </div>
                                <div class="issue-card-item__text-wrapper">
                                    <div class="issue-card-item__text">
                                        <div class="issue-card-item__title">Банк</div>
                                        <div class="issue-card-item__description">Баланс банка</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="issue-card__item">
                        <div class="issue-card-item">
                            <div class="issue-card-item__container">
                                <div class="issue-card-item__num">
                                    <img src="/upload/lizing-2.svg">
                                </div>
                                <div class="issue-card-item__text-wrapper">
                                    <div class="issue-card-item__text">
                                        <div class="issue-card-item__title">Клиент</div>
                                        <div class="issue-card-item__description">Ваш счет в банке</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
    include $_SERVER['DOCUMENT_ROOT']."/local/views/forms/call3.php";
    ?>
    <div class="conditions">
        <div class="conditions__container">
            <div class="wrapper wrapper_default">
                <div class="conditions__title">
                    <h2><?=$arResult["PROPERTIES"]["CONDITIONS_TITLE"]["VALUE"]?></h2>
                </div>
                <div class="conditions__content">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "doc-section",
                        [
                            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                            "CACHE_GROUPS" => "N",	// Учитывать права доступа
                            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                            "CACHE_TYPE" => "A",	// Тип кеширования
                            "COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
                            "FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
                            "IBLOCK_ID" => getIblockIdByCode('lizing-documents'),	// Инфоблок
                            "IBLOCK_TYPE" => "buiznes",	// Тип инфоблока
                            "SECTION_CODE" => "",	// Код раздела
                            "SECTION_FIELDS" => ["CODE", "NAME", ""],
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
                            "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                            "SECTION_USER_FIELDS" => ["", ""],
                            "SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
                            "TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
                            "VIEW_MODE" => "LINE",	// Вид списка подразделов
                        ],
                        false
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>