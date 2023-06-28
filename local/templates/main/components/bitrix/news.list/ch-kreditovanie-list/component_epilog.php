<?php
/**
 * @var array $arResult
 */
?>
<?php foreach($arResult['ITEMS'] as $arItem): ?>
    <?php echo view('forms.product', ['id' => 'credit-'.$arItem['ID'], 'name' => 'Кредит '.$arItem['NAME']]); ?>
<?php endforeach; ?>
