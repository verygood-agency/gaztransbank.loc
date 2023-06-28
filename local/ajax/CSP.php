<?
http_response_code(204);

$report = file_get_contents('php://input');
$report = json_decode($report, true);

if (empty($report)) {
    exit;
}

$report = $report['csp-report'];

$text = '';
$text .= "csp-report:";
$text .= "\r\n date: ". date("Y-m-d H:i:s"); //Дата и время нарушения
$text .= "\r\n blocked-uri: ". $report['blocked-uri']; //URI ресурса, заблокированного для загрузки
$text .= "\r\n disposition: ". $report['disposition']; //содержит значение «enforce» (CSP работает в режиме блокировки) или «report» (CSP работает в режиме только отчётов)
$text .= "\r\n document-uri: ". $report['document-uri']; //URI документа (страницы в браузере), в котором произошло нарушение
$text .= "\r\n effective-directive: ". $report['effective-directive']; //директива, исполнение которой привело к нарушению
$text .= "\r\n violated-directive: ". $report['violated-directive']; //название раздела политики, который был нарушен
$text .= "\r\n original-policy: ". $report['original-policy']; //исходная политика
$text .= "\r\n referrer: ". $report['referrer']; //реферер документа, в котором произошло нарушение
$text .= "\r\n script-sample: ". $report['script-sample']; //первые 40 символов встроенного скрипта, обработчика события или инлайн стиля, вызвавшего нарушение
$text .= "\r\n status-code: ". $report['status-code']; //HTTP-код состояния ресурса
$text .= "\r\n source-file: ". $report['source-file']; //URL с которого был загружен внешний файл, вызвавший нарушение
$text .= "\r\n line-number: ". $report['line-number']; //номер строки исходного файла, в которой произошло нарушение
$text .= "\r\n column-number: ". $report['column-number']; //номер столбца исходного файла, в котором произошло нарушение
$text .= "\r\n\r\n";

file_put_contents('cspReport.csv', $text, FILE_APPEND);