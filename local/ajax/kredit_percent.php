<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$day = intval($_GET['days']);
if($_GET['year']) {
    $day = intval($_GET['year']) * 365;
}

$calc = \Local\Calcs\AbstractCalc::make($_GET['credit'], $day, $_GET['type']);

echo json_encode($calc->calc([
    'sum' => intval($_GET['sum']),
    'months' => intval($_GET['year']) * 12,
    'days' => intval($_GET['days']),
]));
