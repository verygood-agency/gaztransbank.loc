<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

if (!empty($arResult['ERROR']))
{
	ShowError($arResult['ERROR']);
	return false;
}

//Проверка на то, что информация не устаревшая и обновлялась меньше чем 24 часа назад
$seconds = time() - strtotime($arResult['fields']['UF_DATE']['VALUE']);
if ($seconds <= 86400) {?>
  <div id='tarifs_container'>
    <?=$arResult['fields']['UF_DATA']['VALUE']?>
  </div>
<?}?>
<script>
  $(document).ready(function () {
    //Убираем лишние знаки после запятой
    let curency = document.querySelectorAll('.curency-item__title');
    for (var i = 0; i < curency.length; i++) {
      curency[i].innerText = curency[i].innerText.slice(0, -2);
    }
  });


  console.log("Дата и время последней загрузки курсов валют из restful сервиса: <?=$arResult['fields']['UF_DATE']['VALUE']?>");
  console.log("Дата и время обновления курсов валют на restful сервисе: " + $('.box-header__notif').text().split(' на ')[1]);
  $('.box-header__notif').text('Текущий курс валют');
  // $('.box-header__notif').text(
  //   'Текущий курс валют на ' +
  //   $('.box-header__notif').text().split(' на ')[1].replace( /\b\d\d:\d\d\b:\d\d\b/ , '')
  // );
</script>