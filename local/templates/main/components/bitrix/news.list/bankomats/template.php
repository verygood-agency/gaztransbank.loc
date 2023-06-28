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

$type = $arParams['TYPE'];
if($type != 'atm') {
    $type = 'otd';
}

?>
<a name="kontakts"></a>
<div class="section section_default">
    <div class="wrapper wrapper_default">
        <h1 class="page-title">
            Отделения и банкоматы
        </h1>
        <div class="otd">
            <form action="#kontakts" class="otd-nav otd-nav_offset" id="otd-form">
                <div class="otd-nav__radios">
                    <label class="otd-nav__radio radio-circle">
                        <input name="type" type="radio" value="otd" <?php echo ($type == 'otd') ? 'checked' : ''; ?> class="radio-circle__input">
                        <span class="radio-circle__label">
                            Отделения
                        </span>
                    </label>
                    <label class="otd-nav__radio radio-circle">
                        <input type="radio" name="type" value="atm" <?php echo ($type == 'atm') ? 'checked' : ''; ?> class="radio-circle__input">
                        <span class="radio-circle__label">
                            Банкоматы
                        </span>
                    </label>
                </div>
                <div class="otd-nav__controls">

<!--
                    <div class="city-search otd-nav__control">
                        <input name="s" type="text" placeholder="Поиск" class="city-search__input" value="<?php echo htmlspecialchars($arParams['SEARCH']); ?>">
                        <img class="city-search__ico" src="/local/templates/main/images/city-loc.svg" alt="Город. ООО КБ «ГТ банк»">
                    </div>
-->
                    <?php /*<a href="#city-select" class="inline-popup city-search otd-nav__control">
                        <img class="city-search__ico" src="/local/templates/main/images/city-loc.svg" alt="Город. ООО КБ «ГТ банк»">
                        <span class="city-search__title"><?php echo htmlspecialchars($arParams['SEARCH']); ?></span>
                    </a>*/ ?>
                    <div class="otd-nav__btns ">
                        <a href="#" class="btn otd-nav__btn btn_default btn-bordered_blue active">Списком</a>
                        <a href="#" class="btn otd-nav__btn btn_default btn-bordered_blue">На карте</a>
                    </div>

                </div>
            </form>
            <div class="tab-widget">
                <div class="tab active">
            <?php foreach ($arResult["ITEMS"] as $num => $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <?php if($type == 'atm'): ?>
                    <?php include "atm.php"; ?>
                <?php else: ?>
                    <?php include "otd.php"; ?>
                <?php endif; ?>

            <?php endforeach; ?>
                </div>
                <div class="tab">

                    <div class="otd-map">
                        <div id="map" class="otd-map__item"></div>
                        <?php foreach ($arResult["ITEMS"] as $num => $arItem): ?>
                            <?php include "widget.php"; ?>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('.otd-nav__btn').click(function(e){
            e.preventDefault();
            $('.tab').removeClass('active');
            $('.otd-nav__btn').removeClass('active');
            $(this).addClass('active');
            $('.tab').eq($(this).index()).addClass('active');
        })


        $('.otd input[name=type]').on('change', function() {
            $('#otd-form').submit();
        })
    })
</script>
<script>
    $(document).ready(function () {
        //Переменная для определения была ли хоть раз загружена Яндекс.Карта (чтобы избежать повторной загрузки при наведении)
        var check_if_load = false;
        //Необходимые переменные для того, чтобы задать координаты на Яндекс.Карте
        var myMap, myPlacemark;

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [<?php echo $arItem['PROPERTIES']['LAT']['VALUE']; ?>, <?php echo $arItem['PROPERTIES']['LON']['VALUE']; ?>],
                zoom: 13,
                controls: ['zoomControl', 'fullscreenControl']
            })
            <?php foreach ($arResult["ITEMS"] as $num => $arItem): ?>
            myPlacemark = new ymaps.Placemark([<?php echo $arItem['PROPERTIES']['LAT']['VALUE']; ?>, <?php echo $arItem['PROPERTIES']['LON']['VALUE']; ?>], {
                // Свойства.
                // Содержимое иконки, балуна и хинта.
                iconContent: '',
                balloonContent: '<?php echo $arItem['PROPERTIES']['ADDRESS']['VALUE']; ?>',
                hintContent: '<?php echo $arItem['PROPERTIES']['ADDRESS']['VALUE']; ?>'
            }, {
                // Опции.
                // Стандартная фиолетовая иконка.
                preset: 'twirl#violetIcon'
            })

            myPlacemark.events.add('click', function () {
                $('.map-widget').hide();
                $('#widget-<?php echo $arItem['ID']; ?>').show();
            });

            // Добавляем все метки на карту.
            myMap.geoObjects.add(myPlacemark)
            <?php endforeach; ?>
        }

        // Функция загрузки API Яндекс.Карт по требованию (в нашем случае при наведении)
        function loadScript(url, callback){
            var script = document.createElement("script");

            if (script.readyState){  // IE
                script.onreadystatechange = function(){
                    if (script.readyState == "loaded" ||
                        script.readyState == "complete"){
                        script.onreadystatechange = null;
                        callback();
                    }
                };
            } else {  // Другие браузеры
                script.onload = function(){
                    callback();
                };
            }

            script.src = url;
            document.getElementsByTagName("head")[0].appendChild(script);
        }

        $('.otd-nav__btn').click(function(){
                if (!check_if_load) { // проверяем первый ли раз загружается Яндекс.Карта, если да, то загружаем

                    // Чтобы не было повторной загрузки карты, мы изменяем значение переменной
                    check_if_load = true;

                    // Загружаем API Яндекс.Карт
                    loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;loadByRequire=1", function(){
                        // Как только API Яндекс.Карт загрузились, сразу формируем карту и помещаем в блок с идентификатором map;
                        ymaps.load(init);
                    });
                }
            }
        );

        $('.section_default').mouseenter(function(){
                if (!check_if_load) { // проверяем первый ли раз загружается Яндекс.Карта, если да, то загружаем

                    // Чтобы не было повторной загрузки карты, мы изменяем значение переменной
                    check_if_load = true;

                    // Загружаем API Яндекс.Карт
                    loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;loadByRequire=1", function(){
                        // Как только API Яндекс.Карт загрузились, сразу формируем карту и помещаем в блок с идентификатором map;
                        ymaps.load(init);
                    });
                }
            }
        );
    })
</script>
<style>
    .tab {
        display: none;
    }
    .tab.active {
        animation: show .3s ease;
        display: block;
    }
</style>
