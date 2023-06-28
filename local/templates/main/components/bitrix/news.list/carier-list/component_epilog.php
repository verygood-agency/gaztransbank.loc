<?php /**
 * @var array $arResult
 */?>
<?php foreach ($arResult["ITEMS"] as $arItem): ?>
    <?php echo view('forms.vacancy', ['id' => $arItem['ID'], 'name' => $arItem['NAME']]);?>
<?php endforeach; ?>
