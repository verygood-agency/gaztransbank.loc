<?php /**
 * @var array $arItem
 * @var array $arResult
 * @var int $num
 * @var string $type
 */
?>
<div class="map-widget" id="widget-<?php echo $arItem['ID']; ?>" style="display:none;">
    <div class="map-widget__section map-widget__section_offset">
        <span class="map-widget__title map-widget__title_offset">
            <?php echo $arItem['PROPERTIES']['ADDRESS']['VALUE']; ?>
        </span>
        <div class="map-widget__desc">
            <?php if($arItem['PROPERTIES']['PHONE']['VALUE']): ?>
            <div class="key-val map-widget__key-val">
                <span class="key-val__title key-val__title_gray">
                    Телефон:
                </span>
                <a href="tel:<?php echo clear_phone($arItem['PROPERTIES']['PHONE']['VALUE']); ?>" class="key-val__desc">
                    <?php echo $arItem['PROPERTIES']['PHONE']['VALUE']; ?>
                </a>
            </div>
            <?php endif; ?>
            <?php if($arItem['PROPERTIES']['FAX']['VALUE']): ?>
            <div class="key-val map-widget__key-val">
                <span class="key-val__title key-val__title_gray">
                    Факс:
                </span>
                <a href="tel:<?php echo clear_phone($arItem['PROPERTIES']['FAX']['VALUE']); ?>" class="key-val__desc">
                    <?php echo $arItem['PROPERTIES']['FAX']['VALUE']; ?>
                </a>
            </div>
            <?php endif; ?>
            <?php if($arItem['PROPERTIES']['EMAIL']['VALUE']): ?>
            <div class="key-val map-widget__key-val">
                <span class="key-val__title key-val__title_gray">
                    E-mail:
                </span>
                <a href="mailto:<?php echo $arItem['PROPERTIES']['EMAIL']['VALUE']; ?>" class="key-val__desc">
                    <?php echo $arItem['PROPERTIES']['EMAIL']['VALUE']; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if($type == 'atm'): ?>
    <div class="map-widget__section map-widget__section_offset">
        <span class="map-widget__title">
            Режим работы:
        </span>
        <div class="map-widget__desc">
            <?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']); ?>
        </div>
    </div>
    <?php else: ?>
    <div class="map-widget__section map-widget__section_offset">
        <span class="map-widget__title">
            Обслуживание частных клиентов:
        </span>
        <div class="map-widget__desc">
            <?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']); ?>
        </div>
    </div>
    <div class="map-widget__section">
        <span class="map-widget__title">
            Обслуживание корпоративных клиентов:
        </span>
        <div class="map-widget__desc">
            <?php echo htmlspecialchars_decode($arItem['DETAIL_TEXT']); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
