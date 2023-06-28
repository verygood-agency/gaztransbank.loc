<?
//*
die('test');
//*/
if (mail("no-reply@m.gaztransbank.ru","Проверка SMTP", "Проверка", "From: no-reply@m.gaztransbank.ru"))
	echo "Сообщение передано функции mail, проверьте почту в ящике.";
else
	echo "Функция mail не работает, свяжитесь с администрацией хостинга.";
die();