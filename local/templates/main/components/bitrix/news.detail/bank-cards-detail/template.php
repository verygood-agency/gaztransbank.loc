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

$img=CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"], Array('width'=>715, 'height'=>450), BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,65);
?>
<div class="app">
    <div class="bankovskaya-karta">
        <section class="section section_default section_b-offset section_white">
            <div class="wrapper wrapper_default">
                <div class="card-list">

                    <div class="card-item">
                        <div class="card-item__img">
                            <img class="card-item__pic" src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="100%" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>">

                            <?$this->SetViewTarget('META-IMAGE');?>
                                <meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['PREVIEW_PICTURE']['SRC'];?>" />
                                <meta property="og:image:alt" content="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" />
                                <meta property="vk:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['PREVIEW_PICTURE']['SRC'];?>" />
                                <meta property="vk:image:alt" content="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" />
                                <meta property="fb:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['PREVIEW_PICTURE']['SRC'];?>" />
                                <meta property="fb:image:alt" content="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" />
                                <meta name="twitter:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['PREVIEW_PICTURE']['SRC'];?>" />
                                <meta name="twitter:image:alt" content="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" />
                            <?$this->EndViewTarget();?>
                        </div>
                        <div class="card-item__content">
                            <h3 class="h3 card-item__title">
                                <?echo $arResult['NAME'];?>
                            </h3>
                            <?foreach($arResult['PROPERTIES']['ADVANTAGE']['VALUE'] as $key=> $Item){?>
                                <div class="card-item__section card-item__section_offset">
                                    <h4 class="h4 card-item__sub">
                                        <?echo ($arResult['PROPERTIES']['ADVANTAGE']['VALUE'][$key]);?>
                                    </h4>
                                    <div class="card-item__desc">
                                        <p>
                                            <?echo($arResult['PROPERTIES']['ADVANTAGE']['DESCRIPTION'][$key]);?>
                                        </p>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?if ($arResult['PROPERTIES']['STEP']['VALUE']){?>
            <section class="section section_default section_gray">
                <div class="wrapper wrapper_default">
                    <div class="issue-card">
                        <div class="issue-card__container">
                            <div class="issue-card__title"><?echo $arResult['PROPERTIES']['STEP_NAME']['VALUE']?></div>
                            <div class="issue-card__items-wrapper issue-card__items">
                                <?foreach($arResult['PROPERTIES']['STEP']['VALUE'] as $key=> $Item){?>
                                    <div class="issue-card__item">
                                        <div class="issue-card-item">
                                            <div class="issue-card-item__container">
                                                <div class="issue-card-item__num"><?echo ($key+1)?></div>
                                                <div class="issue-card-item__text-wrapper">
                                                    <div class="issue-card-item__text">
                                                        <?if ($arResult['PROPERTIES']['STEP']['VALUE'][$key]):?>
                                                            <div class="issue-card-item__title"><?echo ($arResult['PROPERTIES']['STEP']['VALUE'][$key]);?></div>
                                                        <?endif;?>
                                                        <?if ($arResult['PROPERTIES']['STEP']['DESCRIPTION'][$key]):?>
                                                            <div class="issue-card-item__description"><?echo($arResult['PROPERTIES']['STEP']['DESCRIPTION'][$key]);?></div>
                                                        <?endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?}?>

        <?if ($arResult['PROPERTIES']['TEXT']['VALUE']){

            foreach($arResult['PROPERTIES']['TEXT']['VALUE'] as $key => $Item){
                if (empty(preg_replace('/<!--(.|\s)*?-->/', '', htmlspecialchars_decode($arResult['PROPERTIES']['TEXT']['DESCRIPTION'][$key]))) &&
                    empty(preg_replace('/<!--(.|\s)*?-->/', '', htmlspecialchars_decode($Item['TEXT'])))){
                    unset($arResult['PROPERTIES']['TEXT']['VALUE'][$key]);
                }
            }

            if ($arResult['PROPERTIES']['TEXT']['VALUE']){
                foreach($arResult['PROPERTIES']['TEXT']['VALUE'] as $key=> $Item){?>
                    <section class="section section_default section_gray">
                        <div class="wrapper wrapper_default">
                            <div class="tile tile_middle tile_default tile_white">
                                <h4 class="h3 tile__title">
                                    <?echo htmlspecialchars_decode($arResult['PROPERTIES']['TEXT']['DESCRIPTION'][$key]);?>
                                </h4>
                                <div class="row">
                                    <?echo htmlspecialchars_decode($Item['TEXT']); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?}
            }
        }?>

        <?
        global $arrFilter;
        $arrFilter = array("ACTIVE" => "Y", "PROPERTY_TYPE_VALUE" => "Банковские карты");
        ?>
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "sale-tiles-mini", Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "AJAX_MODE" => "N",	// Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "N",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
            "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
            "DISPLAY_DATE" => "Y",	// Выводить дату элемента
            "DISPLAY_NAME" => "Y",	// Выводить название элемента
            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
            "FIELD_CODE" => array(	// Поля
                0 => "NAME",
                1 => "PREVIEW_TEXT",
                2 => "PREVIEW_PICTURE",
                3 => "",
            ),
            "FILTER_NAME" => "arrFilter",	// Фильтр
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
            "IBLOCK_ID" => getiblockIdByCode("akcii"),	// Код информационного блока
            "IBLOCK_TYPE" => "about",	// Тип информационного блока (используется только для проверки)
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
            "INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
            "NEWS_COUNT" => "3",	// Количество новостей на странице
            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
            "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
            "PAGER_TITLE" => "Новости",	// Название категорий
            "PARENT_SECTION" => "",	// ID раздела
            "PARENT_SECTION_CODE" => "",	// Код раздела
            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
            "PROPERTY_CODE" => array(	// Свойства
                0 => "TYPE",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
            "SET_STATUS_404" => "N",	// Устанавливать статус 404
            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
            "SHOW_404" => "N",	// Показ специальной страницы
            "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
            "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
            "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
            "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
            "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
        ),
          $component
        );?>

        <?if(
            $arResult['PROPERTIES']['DOCUMENT_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['DOCUMENT_FILE']['VALUE'] ||
            $arResult['PROPERTIES']['RATE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['RATE_FILE']['VALUE'] || $arResult['PROPERTIES']['RATE_LINK']['VALUE'] ||
            $arResult['PROPERTIES']['ARCHIVE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['ARCHIVE_FILE']['VALUE'] || $arResult['PROPERTIES']['ARCHIVE_LINK']['VALUE'] ||
            $arResult['PROPERTIES']['FAQ']['VALUE']
            ):

            if (empty($arResult['PROPERTIES']['DOCUMENT_TEXT']['VALUE']['TEXT']) && empty($arResult['PROPERTIES']['DOCUMENT_FILE']['VALUE'])){
                if ($arResult['PROPERTIES']['RATE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['RATE_FILE']['VALUE'] || $arResult['PROPERTIES']['RATE_LINK']['VALUE']){
                    $RATE = "+";
                } elseif ($arResult['PROPERTIES']['ARCHIVE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['ARCHIVE_FILE']['VALUE'] || $arResult['PROPERTIES']['ARCHIVE_LINK']['VALUE']){
                    $ARCHIVE = "+";
                } elseif ($arResult['PROPERTIES']['FAQ']['VALUE']) {
                    $FAQ = "+";
                }
            }

            ?>
            <section class="section section_default section_gray">
                <div class="wrapper wrapper_default">
                    <div class="tabs">
                        <div class="tabs__buttons">
                            <?if ($arResult['PROPERTIES']['DOCUMENT_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['DOCUMENT_FILE']['VALUE']) {?>
                                <button class="tabs__button tabs__button--active">
                                    Документы
                                </button>
                            <?}?>
                            <?if ($arResult['PROPERTIES']['RATE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['RATE_FILE']['VALUE'] || $arResult['PROPERTIES']['RATE_LINK']['VALUE']) {?>
                                <button class="tabs__button <?if($RATE){echo ("tabs__button--active");}?>">
                                    Тарифы
                                </button>
                            <?}?>
                            <?if ($arResult['PROPERTIES']['ARCHIVE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['ARCHIVE_FILE']['VALUE'] || $arResult['PROPERTIES']['ARCHIVE_LINK']['VALUE']) {?>
                                <button class="tabs__button <?if($ARCHIVE){echo ("tabs__button--active");}?>">
                                    Архив
                                </button>
                            <?}?>
                            <?if ($arResult['PROPERTIES']['FAQ']['VALUE']) {?>
                                <button class="tabs__button <?if($FAQ){echo ("tabs__button--active");}?>">
                                    Часто задаваемые вопросы
                                </button>
                            <?}?>
                        </div>
                        <div class="tabs__contents">
                            <?if ($arResult['PROPERTIES']['DOCUMENT_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['DOCUMENT_FILE']['VALUE']) {?>
                                <div class="tabs__content tabs__content--active">
                                    <?echo htmlspecialchars_decode($arResult['PROPERTIES']['DOCUMENT_TEXT']['VALUE']['TEXT'])?>
                                    <div class="doc-list">
                                        <br>
                                        <?foreach($arResult['PROPERTIES']['DOCUMENT_FILE']['VALUE'] as $key => $arItem){
                                            $fileSrc = CFile::GetPath($arItem);
                                            ?>
                                            <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset">
                                                <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
                                                <span class="doc__title title title_semi"><?=$arResult['PROPERTIES']['DOCUMENT_FILE']['DESCRIPTION'][$key]?></span>
                                            </a>
                                        <?}?>
                                    </div>
                                </div>
                            <?}?>

                            <?if ($arResult['PROPERTIES']['RATE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['RATE_FILE']['VALUE'] || $arResult['PROPERTIES']['RATE_LINK']['VALUE']) {?>
                                <div class="tabs__content <?if($RATE){echo ("tabs__content--active");}?>">
                                    <?echo htmlspecialchars_decode($arResult['PROPERTIES']['RATE_TEXT']['VALUE']['TEXT'])?>
                                    <div class="doc-list">
                                        <br>
                                        <?foreach($arResult['PROPERTIES']['RATE_LINK']['VALUE'] as $arLink){
                                          $arLink['SUB_VALUES']['RATE_LINK_SRC']['VALUE'] = $arLink['SUB_VALUES']['RATE_LINK_SRC']['VALUE']. "?v". filemtime($_SERVER['DOCUMENT_ROOT']. $arLink['SUB_VALUES']['RATE_LINK_SRC']['VALUE']);
                                          if ($arLink['SUB_VALUES']['RATE_LINK_PAGE']['VALUE']){
                                            $arLink['SUB_VALUES']['RATE_LINK_SRC']['VALUE'] = $arLink['SUB_VALUES']['RATE_LINK_SRC']['VALUE']. '#page='. $arLink['SUB_VALUES']['RATE_LINK_PAGE']['VALUE'];
                                          }
                                          ?>
                                          <a href="<?echo($arLink['SUB_VALUES']['RATE_LINK_SRC']['VALUE']);?>" target="_blank" class="doc doc_offset">
                                            <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
                                            <span class="doc__title title title_semi"><?=htmlspecialchars_decode($arLink['SUB_VALUES']['RATE_LINK_NAME']['VALUE']);?></span>
                                          </a>
                                        <?}?>
                                        <?foreach($arResult['PROPERTIES']['RATE_FILE']['VALUE'] as $key => $arItem){
                                            $fileSrc = CFile::GetPath($arItem);
                                            ?>
                                            <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset">
                                                <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
                                                <span class="doc__title title title_semi"><?=$arResult['PROPERTIES']['RATE_FILE']['DESCRIPTION'][$key]?></span>
                                            </a>
                                        <?}?>
                                    </div>
                                </div>
                            <?}?>
                            <?if ($arResult['PROPERTIES']['ARCHIVE_TEXT']['VALUE']['TEXT'] || $arResult['PROPERTIES']['ARCHIVE_FILE']['VALUE'] || $arResult['PROPERTIES']['ARCHIVE_LINK']['VALUE']) {?>
                                <div class="tabs__content <?if($ARCHIVE){echo ("tabs__content--active");}?>">
                                    <?echo htmlspecialchars_decode($arResult['PROPERTIES']['ARCHIVE_TEXT']['VALUE']['TEXT'])?>
                                    <div class="doc-list">
                                        <br>
                                        <?foreach($arResult['PROPERTIES']['ARCHIVE_LINK']['VALUE'] as $arLink){
                                          $arLink['SUB_VALUES']['ARCHIVE_LINK_SRC']['VALUE'] = $arLink['SUB_VALUES']['ARCHIVE_LINK_SRC']['VALUE']. "?v". filemtime($_SERVER['DOCUMENT_ROOT']. $arLink['SUB_VALUES']['ARCHIVE_LINK_SRC']['VALUE']);
                                          if ($arLink['SUB_VALUES']['ARCHIVE_LINK_PAGE']['VALUE']){
                                            $arLink['SUB_VALUES']['ARCHIVE_LINK_SRC']['VALUE'] = $arLink['SUB_VALUES']['ARCHIVE_LINK_SRC']['VALUE']. '#page='. $arLink['SUB_VALUES']['ARCHIVE_LINK_PAGE']['VALUE'];
                                          }
                                          ?>
                                          <a href="<?echo($arLink['SUB_VALUES']['ARCHIVE_LINK_SRC']['VALUE']);?>" target="_blank" class="doc doc_offset">
                                            <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
                                            <span class="doc__title title title_semi"><?=htmlspecialchars_decode($arLink['SUB_VALUES']['ARCHIVE_LINK_NAME']['VALUE']);?></span>
                                          </a>
                                        <?}?>
                                        <?foreach($arResult['PROPERTIES']['ARCHIVE_FILE']['VALUE'] as $key => $arItem){
                                            $fileSrc = CFile::GetPath($arItem);
                                            ?>
                                            <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset">
                                                <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
                                                <span class="doc__title title title_semi"><?=$arResult['PROPERTIES']['ARCHIVE_FILE']['DESCRIPTION'][$key]?></span>
                                            </a>
                                        <?}?>
                                    </div>
                                </div>
                            <?}?>
                            <?if ($arResult['PROPERTIES']['FAQ']['VALUE']) {?>
                                <div class="tabs__content <?if($FAQ){echo ("tabs__content--active");}?>">
                                    <?foreach($arResult['PROPERTIES']['FAQ']['VALUE'] as $key => $arItem){?>
                                        <div class="toggle-w toggle-w_b-offset toggle-w_light">
                                            <div class="toggle-w__header ">
                                                    <span class="toggle-w__title h4 title title_light"><?=$arResult['PROPERTIES']['FAQ']['DESCRIPTION'][$key]?></span>
                                                    <i class="toggle-w__arrow"></i>
                                            </div>
                                            <div class="toggle-w__content">
                                                <div class="toggle-w__desc">
                                                    <?echo htmlspecialchars_decode($arItem['TEXT'])?>
                                                </div>
                                            </div>
                                        </div>
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
                    </div>
                </div>
            </section>
        <?endif;?>

    </div>
</div>
<!--    <div class="faq-w">-->
<!--        <div class="wrapper wrapper_default">-->
<!--            <div class="toggle-w toggle-w_b-offset toggle-w_light">-->
<!---->
<!--                <div class="toggle-w__header">-->
<!--                    <span class="toggle-w__title h4 title title_light">Документы</span>-->
<!--                    <i class="toggle-w__arrow"></i>-->
<!--                </div>-->
<!---->
<!--                <div class="toggle-w__content">-->
<!--                    --><?php //foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $num => $value): ?>
<!--                        <a href="--><?php //echo CFile::GetPath($value); ?><!--" target="_blank" class="doc doc_offset">-->
<!--                            <img class="doc__ico" src="/local/templates/main/images/document.svg" alt="--><?//=$arResult["PREVIEW_PICTURE"]["ALT"]?><!--" title="--><?//=$arResult["PREVIEW_PICTURE"]["TITLE"]?><!--">-->
<!--                            <span class="doc__title title title_semi">-->
<!--                                --><?php //echo $arResult['PROPERTIES']['DOCUMENTS']['DESCRIPTION'][$num]; ?>
<!--                            </span>-->
<!--                        </a>-->
<!--                    --><?php //endforeach; ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->