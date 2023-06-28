<?php /**
 * @var array $arItem
 * @var array $arResult
 * @var int $num
 */
?>
<?php if ($num == 0): ?>
<div class="box box_white box_default box-table">
    <h3 class="h3 table-section__title section__title">Банкоматы</h3>
    <div class="table table_default">
        <div class="table__tr table__tr_th">
            <div class="table__td">
                <span class="table__sub">Адрес</span>
            </div>
            <div class="table__td">
                <span class="table__sub">Режим работы</span>
            </div>
            <div class="table__td">
                <span class="table__sub">Операции</span>
            </div>
        </div>
        <?php endif; ?>

        <div class="table__tr">
            <div class="table__td">
                <?php echo $arItem['NAME']; ?>
            </div>
            <div class="table__td">
                <?php echo $arItem['PREVIEW_TEXT']; ?>
            </div>
            <div class="table__td">
                <?php echo implode(' / ', $arItem['PROPERTIES']['OPERATIONS']['VALUE']); ?>
            </div>
        </div>

        <?php if ($num == count($arResult['ITEMS']) - 1): ?>
    </div>
</div>
<?php endif; ?>
