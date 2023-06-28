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
<style>
    @media screen and (max-width: 990px) {
        .mfp-container::before {
          display: none;
        }
    }
</style>
<? foreach ($arResult["ITEMS"] as $n => $arItem) {
    $img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width' => 250, 'height' => 250),
        BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 75);
    $img2 = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width' => 250, 'height' => 250),
        BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 75);

    ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="monets ymap-container monet-<?= ($n + 1); ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="monets-popup">
            <button class="monets-popup__btn"></button>
            <div id="monets<?= ($n + 1);?>" class="monets-popup__map"></div>
            <div class="monets-widget">
                <h4 class="monets-widget__title">
                    <?=\Local\Utils\Settings::get('monets-address'); ?>
                </h4>
                <div class="monets-widget__lines">
                    <div class="key-val monets-widget__line">
                        <span class="key-val__title">
                            Телефон:
                        </span>
                        <a href="tel:<?=clear_phone(\Local\Utils\Settings::get('monets-phone')); ?>" class="key-val__desc">
                            <?=\Local\Utils\Settings::get('monets-phone'); ?>
                        </a>
                    </div>
                    <div class="key-val monets-widget__line">
                        <span class="key-val__title">
                            Факс:
                        </span>
                        <a href="tel:<?=clear_phone(\Local\Utils\Settings::get('monets-fax')); ?>" class="key-val__desc">
                            <?=\Local\Utils\Settings::get('monets-fax'); ?>
                        </a>
                    </div>
                    <div class="key-val monets-widget__line">
                        <span class="key-val__title">
                            E-mail:
                        </span>
                        <a href="mailto:<?=\Local\Utils\Settings::get('monets-email'); ?>" class="key-val__desc">
                            <?=\Local\Utils\Settings::get('monets-email'); ?>
                        </a>
                    </div>
                </div>
                <div class="monets-widget__lines">
                    <span class="monets-widget__subtitle">
                        Обслуживание частных клиентов:
                    </span>
                    <?php foreach (explode("\n", \Local\Utils\Settings::get('monets-rasp-personal')) as $adr): ?>
                        <div class="key-val monets-widget__line">
                            <span class="key-val__desc"><?=$adr; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="monets-widget__lines">
                    <span class="monets-widget__subtitle">
                        Обслуживание корпоративных клиентов:
                    </span>
                    <?php foreach (explode("\n", \Local\Utils\Settings::get('monets-rasp-ur')) as $adr): ?>
                        <div class="key-val monets-widget__line">
                            <span class="key-val__desc"><?=$adr; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="monets__img">
            <img class="monets__img-left" src="<?= $img['src']; ?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
            <img class="monets__img-right" src="<?= $img2['src']; ?>" width="<?=$img2['width'];?>" height="<?=$img2['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
        </div>
        <div class="monets-info">
            <div class="monets__title">
                <?= $arItem['NAME']; ?>
            </div>
            <div class="monets-desc">
                <div class="monets-desc__left">
                    <? if (!empty($arItem['PROPERTIES']['METALL']['VALUE'])) { ?>
                        <div class="monets-left__item">Металл, проба, качество</div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['YEAR']['VALUE'])) { ?>
                        <div class="monets-left__item">Год выпуска</div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['NUMBER']['VALUE'])) { ?>
                        <div class="monets-left__item">№ по каталогу ЦБ РФ</div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['NOMINAL']['VALUE'])) { ?>
                        <div class="monets-left__item">Достоинство (номинал), руб.</div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['MASS']['VALUE'])) { ?>
                        <div class="monets-left__item">Масса, (гр.)</div>
                    <? } ?>
                </div>
                <div class="monets-desc__right">
                    <? if (!empty($arItem['PROPERTIES']['METALL']['VALUE'])) { ?>
                        <div class="monets-right__item"><?= $arItem['PROPERTIES']['METALL']['VALUE']; ?></div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['YEAR']['VALUE'])) { ?>
                        <div class="monets-right__item"><?= $arItem['PROPERTIES']['YEAR']['VALUE']; ?></div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['NUMBER']['VALUE'])) { ?>
                        <div class="monets-right__item"><?= $arItem['PROPERTIES']['NUMBER']['VALUE']; ?></div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['NOMINAL']['VALUE'])) { ?>
                        <div class="monets-right__item"><?= $arItem['PROPERTIES']['NOMINAL']['VALUE']; ?></div>
                    <? } ?>
                    <? if (!empty($arItem['PROPERTIES']['MASS']['VALUE'])) { ?>
                        <div class="monets-right__item">
                            <?= $arItem['PROPERTIES']['MASS']['VALUE']; ?>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="monets-more">
                <? if (!empty($arItem['PROPERTIES']['PRICE']['VALUE'])) { ?>
                    <div class="monets__price">
                        <div class="monets__price-int"><?= $arItem['PROPERTIES']['PRICE']['VALUE']; ?></div>
                        <div class="monets__price-text"><?= $arItem['PROPERTIES']['PRICE']['DESCRIPTION']; ?></div>
                    </div>
                <? } ?>
                <a href="#" class="kredit-nav__btn btn btn_default btn_blue monets-more__btn">
                    <span class="btn__title">
                        Где купить?
                    </span>
                </a>
            </div>
        </div>
    </div>
<? } ?>
<script>
    var spinner = $('.ymap-container').children('.loader');
    var check_if_load = false;
    var myMapTemp, myPlacemarkTemp;

    function init() {
        <?php foreach ($arResult["ITEMS"] as $n => $arItem): ?>
        var myMapTemp = new ymaps.Map("monets<?=($n+1);?>", {
            center: [<?=\Local\Utils\Settings::get('monets-lat'); ?>, <?=\Local\Utils\Settings::get('monets-lon'); ?>],
            zoom: 17,
            controls: ['zoomControl', 'fullscreenControl']
        });
        myMapTemp.geoObjects.add(new ymaps.Placemark([<?=\Local\Utils\Settings::get('monets-lat'); ?>, <?=\Local\Utils\Settings::get('monets-lon'); ?>], {
            balloonContent: '<?=\Local\Utils\Settings::get('monets-address'); ?>'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }))
        var layer = myMapTemp.layers.get(0).get(0);
        waitForTilesLoad(layer).then(function () {
            spinner.removeClass('is-active');
        });
        <?php endforeach; ?>
    }


    function waitForTilesLoad(layer) {
        return new ymaps.vow.Promise(function (resolve, reject) {
            var tc = getTileContainer(layer),
                readyAll = true;
            tc.tiles.each(function (tile, number) {
                if (!tile.isReady()) {
                    readyAll = false;
                }
            });
            if (readyAll) {
                resolve();
            } else {
                tc.events.once("ready", function () {
                    resolve();
                });
            }
        });
    }

    function getTileContainer(layer) {
        for (var k in layer) {
            if (layer.hasOwnProperty(k)) {
                if (
                    layer[k] instanceof ymaps.layer.tileContainer.CanvasContainer ||
                    layer[k] instanceof ymaps.layer.tileContainer.DomContainer
                ) {
                    return layer[k];
                }
            }
        }
        return null;
    }

    function loadScript(url, callback) {
        var script = document.createElement("script");

        if (script.readyState) { // IE
            script.onreadystatechange = function () {
                if (script.readyState == "loaded" ||
                    script.readyState == "complete") {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else { // Другие браузеры
            script.onload = function () {
                callback();
            };
        }
        script.src = url;
        document.getElementsByTagName("head")[0].appendChild(script);
    }

    var ymap = function () {
        $('.monets-more__btn').click(function (e) {
            e.preventDefault();
            if ($(window).width() > 990) {
                $(this).closest('.monets').find('.monets-popup').addClass('active');
            } else {
                if (!check_if_load) {
                    check_if_load = true;
                    spinner.addClass('is-active');
                    loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;loadByRequire=1", function () {
                        ymaps.load(init);
                    });
                }
                $.magnificPopup.open({
                    items: {
                        src: $(this).closest('.monets').find('.monets-popup'),
                    },
                    type: 'inline'
                });
            }

        })


        $('.ymap-container').mouseenter(function () {

            if (!check_if_load) {
                check_if_load = true;
                spinner.addClass('is-active');
                loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;loadByRequire=1", function () {
                    ymaps.load(init);
                });
            }
        });
    }

    $(function () {
        ymap();

        $('.monets-popup__btn').click(function (e) {
            $('.monets-popup').removeClass('active');
        })

    });

</script>
