<?php /**
 * @var array $arItem
 * @var array $arResult
 * @var int $num
 */
?>
<a name="<?php echo $arItem['CODE']; ?>"></a>
<?php if($num == 0):?>
    <div itemscope itemtype="http://schema.org/Organization" class="box box_white box_default box-table">
        <h3 itemprop="name" class="h3 table-section__title section__title"><?php echo $arItem['NAME']; ?></h3>
        <div class="otd">
            <div class="row">
                <div class="col col--lg-5">
                    <span class="otd__content">
                        <link itemprop="url" href="https://<?=$_SERVER['HTTP_HOST']?>">
                        <span itemprop="address" class="otd__title">
                            <?php echo $arItem['PROPERTIES']['ADDRESS']['VALUE']; ?>
                        </span>
                        <?if ($arItem['PROPERTIES']['PHONE']['VALUE']){?>
                            <span class="otd-info key-val">
                                <span class="key-val__title gray">
                                    Телефон:
                                </span>
                                <span class="key-val__desc">
                                    <a itemprop="telephone" href="tel:<?php echo clear_phone($arItem['PROPERTIES']['PHONE']['VALUE']); ?>">
                                        <?php echo $arItem['PROPERTIES']['PHONE']['VALUE']; ?>
                                    </a>
                                </span>
                            </span>
                        <?}?>
                        <?if ($arItem['PROPERTIES']['FAX']['VALUE']){?>
                            <span class="otd-info key-val">
                                <span class="key-val__title gray">
                                    Факс:
                                </span>
                                <span class="key-val__desc">
                                    <a itemprop="faxNumber" href="tel:<?php echo clear_phone($arItem['PROPERTIES']['FAX']['VALUE']); ?>">
                                        <?php echo $arItem['PROPERTIES']['FAX']['VALUE']; ?>
                                    </a>
                                </span>
                            </span>
                        <?}?>
                        <?if ($arItem['PROPERTIES']['EMAIL']['VALUE']){?>
                            <span class="otd-info key-val">
                                <span class="key-val__title gray">
                                    E-mail:
                                </span>
                                <span class="key-val__desc">
                                    <a itemprop="email" href="mailto:<?php echo $arItem['PROPERTIES']['EMAIL']['VALUE']; ?>">
                                        <?php echo $arItem['PROPERTIES']['EMAIL']['VALUE']; ?>
                                    </a>
                                </span>
                            </span>
                        <?}?>
                    </span>
                </div>
                <div class="col col--lg-7">
                    <div class="row">
                        <?if (htmlspecialchars_decode($arItem['PREVIEW_TEXT'])){?>
                            <div class="col col--lg-6">
                                <div class="otd-tile">
                                    <span class="otd-tile__title">
                                        Обслуживание частных клиентов:
                                    </span>
                                    <div class="otd-tile__info">
                                        <?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']); ?>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                        <?if (htmlspecialchars_decode($arItem['DETAIL_TEXT'])){?>
                            <div class="col col--lg-6">
                                <div class="otd-tile">
                                    <span class="otd-tile__title">
                                        Обслуживание корпоративных клиентов:
                                    </span>
                                    <div class="otd-tile__info">
                                        <?php echo htmlspecialchars_decode($arItem['DETAIL_TEXT']); ?>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php if($num == 1): ?>
        <div class="box box_white box_default">
        <h4 class="h4">Офисы обслуживания</h4>
        <div class="table cont-table">
            <div class="table__tr table__tr_th">
                <div class="table__th">
                    Название офиса
                </div>
                <div class="table__th">
                    Адрес и телефон
                </div>
                <div class="table__th">
                    Обслуживание частных клиентов
                </div>
                <div class="table__th">
                    Обслуживание корпоративных клиентов
                </div>
            </div>
    <?php endif ?>

            <div itemscope itemtype="http://schema.org/LocalBusiness" class="table__tr">
                <div class="table__td">
                    <span class="table_mobile">
                        Название офиса
                    </span>
                    <span itemprop="name" class="cont-table__title">
                        <?php echo $arItem['NAME']; ?>
                    </span>
                </div>
                <div class="table__td">
                    <span class="table__mobile">
                        Адрес и телефон
                    </span>
                    <div class="cont-table__content">
                        <?if ($arItem['PROPERTIES']['PHONE']['VALUE']){?>
                            <span class="otd-info key-val">
                                <span class="key-val__title gray">
                                    Телефон:
                                </span>
                                <span class="key-val__desc">
                                    <a itemprop="telephone" href="tel:<?php echo clear_phone($arItem['PROPERTIES']['PHONE']['VALUE']); ?>">
                                        <?php echo $arItem['PROPERTIES']['PHONE']['VALUE']; ?>
                                    </a>
                                </span>
                            </span>
                        <?}?>
                        <?if ($arItem['PROPERTIES']['ADDRESS']['VALUE']){?>
                            <span class="otd-info key-val">
                                <span class="key-val__title gray">
                                    Адрес:
                                </span>
                                <span itemprop="address" class="key-val__desc">
                                    <?php echo $arItem['PROPERTIES']['ADDRESS']['VALUE']; ?>
                                </span>
                            </span>
                        <?}?>
                    </div>
                </div>
                <div class="table__td">
                    <span class="table__mobile">
                        Обслуживание частных клиентов
                    </span>
                    <div class="cont-table__content">
                        <?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']); ?>
                    </div>
                </div>
                <div class="table__td">
                    <span class="table__mobile">
                        Обслуживание корпоративных клиентов
                    </span>
                    <div class="cont-table__content">
                        <?php echo htmlspecialchars_decode($arItem['DETAIL_TEXT']); ?>
                    </div>
                </div>
            </div>

    <?php if($num == count($arResult['ITEMS']) - 1): ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
