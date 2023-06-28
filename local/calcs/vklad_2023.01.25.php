<?php
/**
 * @var int $vkladId
 * @var string $vkladName
 * @var string $vkladType
 */

$class = getHBlockEntityById('VkladCalc');

$res = $class::getList([
  'filter' => ['UF_VKLAD_ID' => $vkladId],
  "order" => ["UF_START_SUM"=>"ASC"],
]);

$currenciesEnum = [];
$rsEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_CURRENCY"));
while ($arEnum = $rsEnum->Fetch()) {
  $currenciesEnum[$arEnum['ID']] = $arEnum['XML_ID'];
}

$calcArray = [];
while ($item = $res->fetch()) {
  $item['UF_CURRENCY'] = $currenciesEnum[$item['UF_CURRENCY']];
  array_push($calcArray, $item);
}

if(!empty($calcArray)) {

  ?>
  <style>
    .vklad-calc-desc {display: block}
    .vklad-calc-mobile {display: none}
    .vklad-calc-border {
      padding-top: 40px;
      margin-top: 10px;
      border-top: 1px solid #e8e8e8;
    }
    .dopSelectShow {
      padding-bottom: 20px;
      display: none;
    }
    .curency-w__radio {display: none}
    .dopShow {display: none}
    @media (max-width: 992px) {
      .vklad-calc-desc {display: none;}
      .vklad-calc-mobile {display: block;}
      .calc-controls_r-offset {padding-right: 0rem;}
    }
  </style>
  <div class="section section_default" id="vklad-calc-form">
    <div class="wrapper wrapper_default" id="vklad-calc-form-inner">
      <div class="vklad-calc">
        <div class="calc-content">
          <form action="#" class="form calc-form deposit-calc">
            <div class="row">
              <div class="col col--lg-7">
                <div class="vklad-calc__title">Калькулятор</div>
                <div class="calc-controls calc-controls_r-offset">
                  <div class="calc-row calc-row_offset vklad-calc-row">
                    <div class="row">
                      <div class="col col--xl-8">
                        <div class="row">
                          <div class="col col--lg-6 col--md-6">
                            <div class="vklad-calc__desc">
                              <div class="vklad-calc__desc-left">
                                <div class="vklad-calc__desc-up">
                                  Вклад
                                </div>
                                <div id="itogSum" class="vklad-calc__desc-down"></div>
                              </div>
                            </div>
                          </div>
                          <div class="col col--lg-6 col--md-6">
                            <div class="vklad-calc__desc-right">
                              <div class="vklad-calc__desc-up">Вы получите</div>
                              <div class="vklad-calc__desc-down itogSumAndIncome"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col col--xl-4">
                        <div class="calc-radio calc-radio_center">
                          <label id="RUB" class="radio radio_blue curency-w__radio">
                            <input
                                value="RUB"
                                type="radio"
                                class="radio__input"
                                name="currency"
                            >
                            <span class="radio__label radio__label_cur">
                                                        ₽
                                                    </span>
                          </label>
                          <label id="USD" class="radio radio_blue curency-w__radio">
                            <input
                                value="USD"
                                type="radio"
                                name="currency"
                                class="radio__input"
                            >
                            <span class="radio__label radio__label_cur">
                                                        $
                                                    </span>
                          </label>
                          <label id="EUR" class="radio radio_blue curency-w__radio">
                            <input
                                value="EUR"
                                type="radio"
                                name="currency"
                                class="radio__input"
                            >
                            <span class="radio__label radio__label_cur">
                                                        €
                                                    </span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="calc-row calc-row_offset">
                    <label class="label label_default">
                      Сумма вклада
                    </label>
                    <div class="u-input">
                      <div class="u-input__widget noui noui_default">
                        <input name="sum" type="text" id="sumInput" class="input input_default u-input__item">
                        <div class="u-input__toggle" id="sumSlider"></div>
                        <div class="u-nav u-nav_offset u-nav_between">
                          <span class="u-nav__title" id="sumMin" ></span>
                          <span class="u-nav__title" id="sumMax" ></span>
                        </div>
                      </div>
                      <div class="vklad-time">
                        <label class="label label_default">
                          Срок вклада
                        </label>
                        <div class="custom-select">
                          <select name="day" id="day" placeholder="Выберите срок">
                          </select>
                        </div>
                      </div>
                      <div class="vklad-time" id="div_initial-fee" style="display: none">
                        <label class="label label_default">
                          Первоначальный взнос
                        </label>
                        <div class="custom-select">
                          <select name="initial-fee" id="initial-fee" placeholder="Выберите взнос">
                          </select>
                        </div>
                      </div>
                      <div class="vklad-time dopShow">
                        <label class="consent__container">
                          <input name="dop" type="checkbox" class="consent__input visually-hidden">
                          <span class="consent__checkbox"></span>
                          <span class="label label_default" style="margin-left: 13px">Дополнительный взнос</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col col--lg-5 vklad-calc-desc">
                <div class="calc-summ">
                  <img class="calc-summ__pic" src="/local/templates/main/images/dep-calc.png" alt="Вклады. ООО КБ «ГТ банк»">
                  <div class="calc-sum__content">
                    <div class="summ-result calc-sum__row calc-sum__row_offset">
                      <span class="calc-summ__title itogDay"></span>
                      <div class="calc-summ__desc">
                        <span class="calc-summ__numb itogSumAndIncome"></span>
                      </div>
                    </div>
                    <div class="calc-sum__row calc-sum__row_offset">
                      <div class="row">
                        <div class="col col--lg-4">
                          <div class="calc-sum-info calc-sum-info_offset">
                                                    <span class="calc-sum-info__title title title_block">
                                                        Процентная ставка
                                                    </span>
                            <div class="h4 calc-sum-info__desc title title_block title_bold itogPercent"></div>
                          </div>
                        </div>
                        <div class="col col--lg-8">
                          <div class="calc-sum-info calc-sum-info_offset">
                                                    <span class="calc-sum-info__title title title_block">
                                                        Доход
                                                    </span>
                            <div class="h4 calc-sum-info__desc title title_block title_bold itogIncome"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?if ($vkladBTN) {?>
                      <div class="calc-sum__row calc-sum__row_offset">
                        <a
                            href="#product-open-vklad-<?php echo $vkladId; ?>" data-title="Заявка на открытие вклада - <?=$vkladName;?>"
                            class="btn btn_default btn-bordered_red inline-t-popup"
                        >Отправить заявку</a>
                      </div>
                    <?}?>
                  </div>
                  <div class="calc-sum__row">
                                    <span class="calc-sum__notif">
                                        Данный расчёт является предварительными не является публичной офертой.<br>
                                        Расчет произведен для вкладов открытых через мобильное приложение или интернет
                                        банк.


                                    </span>
                  </div>
                </div>
              </div>
              <div class="col col--lg-12 dopSelectShow">
                <div class="vklad-calc-border"></div>
                <div class="credit-form__fields--col-2">
                  <div class="credit-form__fields-group">
                    <label class="label label_default">
                      Сумма дополнительного взноса
                    </label>
                    <div class="u-input">
                      <div class="u-input__widget noui noui_default">
                        <input name="dopSum" type="text" id="dopSumInput" class="input input_default u-input__item">
                        <div class="u-input__toggle" id="dopSumSlider"></div>
                        <div class="u-nav u-nav_offset u-nav_between">
                          <span class="u-nav__title" id="dopSumMin"></span>
                          <span class="u-nav__title" id="dopSumMax"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="credit-form__fields-group">
                    <label class="label label_default">
                      День внесения взноса от даты открытия вклада
                    </label>
                    <div class="u-input">
                      <div class="u-input__widget noui noui_default">
                        <input name="dopDay" type="text" id="dopDayInput" class="input input_default u-input__item">
                        <div class="u-input__toggle" id="dopDaySlider"></div>
                        <div class="u-nav u-nav_offset u-nav_between">
                          <span class="u-nav__title" id="dopDayMin"></span>
                          <span class="u-nav__title" id="dopDayMax"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col col--lg-5 vklad-calc-mobile">
                <div class="calc-summ">
                  <img class="calc-summ__pic" src="/local/templates/main/images/dep-calc.png" alt="Вклады. ООО КБ «ГТ банк»">
                  <div class="calc-sum__content">
                    <div class="summ-result calc-sum__row calc-sum__row_offset">
                      <span class="calc-summ__title itogDay"></span>
                      <div class="calc-summ__desc">
                        <span class="calc-summ__numb itogSumAndIncome"></span>
                      </div>
                    </div>
                    <div class="calc-sum__row calc-sum__row_offset">
                      <div class="row">
                        <div class="col col--lg-6">
                          <div class="calc-sum-info calc-sum-info_offset">
                                                    <span class="calc-sum-info__title title title_block">
                                                        Процентная ставка
                                                    </span>
                            <div class="h4 calc-sum-info__desc title title_block title_bold itogPercent"></div>
                          </div>
                        </div>
                        <div class="col col--lg-6">
                          <div class="calc-sum-info calc-sum-info_offset">
                                                    <span class="calc-sum-info__title title title_block">
                                                        Доход
                                                    </span>
                            <div class="h4 calc-sum-info__desc title title_block title_bold itogIncome"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="calc-sum__row calc-sum__row_offset">
                      <a
                          href="#product-open-vklad-<?php echo $vkladId; ?>" data-title="Заявка на открытие вклада - <?=$vkladName;?>"
                          class="btn btn_default btn-bordered_red inline-t-popup"
                      >Отправить заявку</a>
                    </div>

                  </div>
                  <div class="calc-sum__row">
                                    <span class="calc-sum__notif">
                                        Данный расчёт является предварительными не является публичной офертой.<br>
                                        Расчет произведен для вкладов открытых через мобильное приложение или интернет
                                        банк.


                                    </span>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <p>
          * Расчет процентов по вкладу является не окончательным, для получения более точного расчета следует
          обратиться в ближайшее отделение банка.
        </p>
      </div>
    </div>
  </div>
  <script>
    let calcArray = '<?=json_encode($calcArray)?>';
    let calcType = '<?=($vkladType)?>';
    let daysYear = <?=(date('L') ? 366 : 365)?>;
    let dopSlider = '';
    calcArray = JSON.parse(calcArray);
    console.log(calcArray);
    console.log(calcType);

    //Функция преобразования числа
    function numberWithSpaces(x) {
      let parts = x.toString().split(".");
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
      return parts.join(".");
    }

    //Функция склонения слов
    function pluralize(count, words) {
      var cases = [2, 0, 1, 1, 1, 2];
      return count + ' ' + words[ (count % 100 > 4 && count % 100 < 20) ? 2 : cases[ Math.min(count % 10, 5)] ];
    }

    //Отображаем доступные валюты и выбираем первую доступную
    calcArray.forEach(function(item) {
      if (item['UF_START_SUM'] && item['UF_END_SUM'] && item['UF_CURRENCY'] && item['UF_DAYS'] && item['UF_PERCENT']) {
        $('#' + item['UF_CURRENCY']).show();
      };
    });
    $('.curency-w__radio:visible:eq(0) input[name="currency"]:eq(0)').attr("checked", true);

    //Главная функция обновления калькулятора
    function updateCalc(status)
    {
      let valCurrency = $('input[name="currency"]:checked').val();
      let valSum = $('input[name="sum"]').val();
      let valDay = $('select[name="day"]').val();
      let valInitialFee = $('select[name="initial-fee"]').val();
      let valDop = $('input[name="dop"]:checked').val();
      let valDopSum = $('input[name="dopSum"]').val();
      let valDopDay = $('input[name="dopDay"]').val();
      let arrayCurrency = [];
      let arrayDay = [];
      let arrayItog = [];
      let arrayTemp = [];
      let percent = null;
      let sumMin = 9999999999999999999;
      let sumMax = 0;
      let day = [''];
      let initialFee = [''];
      let dopSumMin = 9999999999999999999;
      let dopSumMax = 0;
      let dopDayMin = 9999999999999999999;
      let dopDayMax = 0;
      let dopOn = null;

      // Формируем массив с подходящей валютой и определяем значения сроков и первоначального срока
      calcArray.forEach(function(item, i) {
        if (item['UF_CURRENCY'] == valCurrency && item['UF_START_SUM'] && item['UF_END_SUM'] && item['UF_CURRENCY'] && item['UF_DAYS'] && item['UF_PERCENT']) {
          if (day.includes(item['UF_DAYS']) == false && item['UF_DAYS']) {
            day.push(item['UF_DAYS']);
            if (day['0'] == '') {
              day['0'] = '<option value="' + item['UF_DAYS'] + '" selected="selected" >' + item['UF_DAYS'] + '</option>';
            } else {
              day['0'] = day['0'] + '<option value="' + item['UF_DAYS'] + '" >' + item['UF_DAYS'] + '</option>';
            };
          };
          arrayItog.push(item);
        };
      });
      if (valDay == null) {valDay = day['1']}

      // Формируем массив с подходящей сроком и определяем значения первоначального срока
      arrayTemp = [];
      arrayItog.forEach(function(item, i) {
        if (item['UF_DAYS'] == valDay) {
          if (initialFee.includes(item['UF_INITIAL_FEE']) == false && item['UF_INITIAL_FEE']) {
            initialFee.push(item['UF_INITIAL_FEE']);
            if (initialFee['0'] == '') {
              initialFee['0'] = '<option value="' + item['UF_INITIAL_FEE'] + '" selected="selected" >' + item['UF_INITIAL_FEE'] + '</option>';
            } else {
              initialFee['0'] = initialFee['0'] + '<option value="' + item['UF_INITIAL_FEE'] + '" >' + item['UF_INITIAL_FEE'] + '</option>';
            };
          };
          arrayTemp.push(item);
        };
      });
      arrayItog = arrayTemp;
      if (valInitialFee == null) {valInitialFee = initialFee['1']}

      arrayTemp = [];
      arrayItog.forEach(function(item, i) {
        //Если есть первоначальный взнос, то проверяем на совпадение. Если нет, то просто определяем минимальные и максимальные значения
        if (item['UF_INITIAL_FEE'] == valInitialFee || initialFee['0'] == "") {
          //Определяем минимальные и максимальные значения
          if (parseInt(sumMin) > parseInt(item['UF_START_SUM'])) {sumMin = item['UF_START_SUM']};
          if (parseInt(sumMax) < parseInt(item['UF_END_SUM'])) {sumMax = item['UF_END_SUM']};

          if (item['UF_SUM_DOP_MIN'] && item['UF_SUM_DOP_MAX'] && item['UF_DEN_DOP_MIN'] && item['UF_DEN_DOP_MAX']) {
            dopOn = "Y";
            if (parseInt(dopSumMin) > parseInt(item['UF_SUM_DOP_MIN'])) {dopSumMin = item['UF_SUM_DOP_MIN']};
            if (parseInt(dopSumMax) < parseInt(item['UF_SUM_DOP_MAX'])) {dopSumMax = item['UF_SUM_DOP_MAX']};
            if (parseInt(dopDayMin) > parseInt(item['UF_DEN_DOP_MIN'])) {dopDayMin = item['UF_DEN_DOP_MIN']};
            if (parseInt(dopDayMax) < parseInt(item['UF_DEN_DOP_MAX'])) {dopDayMax = item['UF_DEN_DOP_MAX']};
          };
          arrayTemp.push(item);
        };
      });
      arrayItog = arrayTemp;

      // Определяем процентную ставку
      if (!valSum) {valSum = sumMin};
      if (parseInt(valSum) < parseInt(sumMin)) {valSum = sumMin};
      if (parseInt(valSum) > parseInt(sumMax)) {valSum = sumMax};
      if (dopOn) {
        if (parseInt(valDopSum) < parseInt(dopSumMin)) {valDopSum = dopSumMin};
        if (parseInt(valDopSum) > parseInt(dopSumMax)) {valDopSum = dopSumMax};
        if (parseInt(valDopDay) < parseInt(dopDayMin)) {valDopDay = dopDayMin};
        if (parseInt(valDopDay) > parseInt(dopDayMax)) {valDopDay = dopDayMax};
      }
      arrayItog.forEach(function(item, i) {
        if (parseInt(valSum) >= parseInt(item['UF_START_SUM']) && parseInt(valSum) <= parseInt(item['UF_END_SUM'])) {
          percent = item['UF_PERCENT'];
        };
      });
      console.log(arrayItog);

      //Наполняем значениями калькулятор
      let sum = sumMin;
      let dopSum = dopSumMin;
      let dopDay = dopDayMin;
      let currencySign = null;
      let sumSlider = document.getElementById('sumSlider');
      let dopSumSlider = document.getElementById('dopSumSlider');
      let dopDaySlider = document.getElementById('dopDaySlider');

      if (parseInt(sum) < parseInt(valSum)) {sum = valSum;};
      if (parseInt(dopSum) < parseInt(valDopSum)) {dopSum = valDopSum;};
      if (parseInt(dopDay) < parseInt(valDopDay)) {dopDay = valDopDay;};

      if (valCurrency == 'RUB') {currencySign = '₽'}
      else if (valCurrency == 'USD') {currencySign = '$'}
      else if (valCurrency == 'EUR') {currencySign = '€'};

      if (dopOn) {$('.dopShow').show()} else {$('.dopShow').hide()}
      if (dopOn && valDop) {$('.dopSelectShow').show()} else {$('.dopSelectShow').hide()}

      $('.itogPercent').text(percent + ' %');
      $('#sumMin').text('от ' + numberWithSpaces(sumMin) + ' ' + currencySign);
      $('#sumMax').text('до ' + numberWithSpaces(sumMax) + ' ' + currencySign);
      $('#day').html(day['0']);
      $('select[name="day"]').val(valDay);
      if (initialFee['0'] != "") {
        $('#initial-fee').html(initialFee['0']);
        $('select[name="initial-fee"]').val(valInitialFee);
        $('#div_initial-fee').show();
      } else {
        $('#div_initial-fee').hide();
      }

      $('.itogDay').text('Сумма через ' + pluralize(valDay,['день', 'дня', 'дней']) + ' *');
      if (dopOn) {
        $('#dopSumMin').text('от ' + numberWithSpaces(dopSumMin) + ' ' + currencySign);
        $('#dopSumMax').text('до ' + numberWithSpaces(dopSumMax) + ' ' + currencySign);
        $('#dopDayMin').text(pluralize(dopDayMin,['день', 'дня', 'дней']));
        $('#dopDayMax').text(pluralize(dopDayMax,['день', 'дня', 'дней']));
      };

      //Задание параметров основного слайдера
      if (status == 'new') {
        if (sumSlider) {
          noUiSlider.create(sumSlider, {
            start: [parseInt(sum)],
            connect: [true, false],
            range: {
              'min': parseInt(sumMin),
              'max': parseInt(sumMax)
            },

          });
          sumSlider.noUiSlider.on('update', function (values, handle) {
            $('#sumInput').val(parseInt(values[0]));
          })
          sumSlider.noUiSlider.on('end', function (values, handle) {
            $('#sumInput').trigger('change');
          })
        };
      } else {
        sumSlider.noUiSlider.set(sum);
        sumSlider.noUiSlider.updateOptions({
          range: {
            'min': parseInt(sumMin),
            'max': parseInt(sumMax)
          }
        });
      };

      //Задание параметров дополнительных слайдеров
      if (dopOn) {
        if (dopSlider == '') {
          dopSlider = '+';

          if (dopSumSlider) {
            noUiSlider.create(dopSumSlider, {
              start: [parseInt(dopSum)],
              connect: [true, false],
              range: {
                'min': parseInt(dopSumMin),
                'max': parseInt(dopSumMax)
              },

            });
            dopSumSlider.noUiSlider.on('update', function (values, handle) {
              $('#dopSumInput').val(parseInt(values[0]));
            })
            dopSumSlider.noUiSlider.on('end', function (values, handle) {
              $('#dopSumInput').trigger('change');
            })
          };

          if (dopDaySlider) {
            noUiSlider.create(dopDaySlider, {
              start: [parseInt(dopDay)],
              connect: [true, false],
              range: {
                'min': parseInt(dopDayMin),
                'max': parseInt(dopDayMax)
              },

            });
            dopDaySlider.noUiSlider.on('update', function (values, handle) {
              $('#dopDayInput').val(parseInt(values[0]));
            })
            dopDaySlider.noUiSlider.on('end', function (values, handle) {
              $('#dopDayInput').trigger('change');
            })
          };
        } else {
          dopSumSlider.noUiSlider.set(dopSum);
          dopSumSlider.noUiSlider.updateOptions({
            range: {
              'min': parseInt(dopSumMin),
              'max': parseInt(dopSumMax)
            }
          });
          dopDaySlider.noUiSlider.set(dopDay);
          dopDaySlider.noUiSlider.updateOptions({
            range: {
              'min': parseInt(dopDayMin),
              'max': parseInt(dopDayMax)
            }
          });
        };
      };

      //Расчёт дохода
      let income = 0;
      let incomeDop = 0;
      if (calcType == 'Ежемесячная капитализация') {
        income = Math.round((parseInt(sum) * Math.pow((1 + ((parseFloat(percent) / 100) / 12)), (parseInt(valDay) / (parseInt(daysYear)/12)))) - parseInt(sum));
      } else {
        income = Math.round((parseInt(sum) * parseFloat(percent) * parseInt(valDay) / parseInt(daysYear)) / 100);
      }
      console.log(income);

      if (dopOn && valDop) {
        if (calcType == 'Ежемесячная капитализация') {
          incomeDop = Math.round((parseInt(dopSum) * Math.pow((1 + ((parseFloat(percent) / 100) / 12)), ((parseInt(valDay) - parseInt(dopDay)) / (parseInt(daysYear)/12)))) - parseInt(dopSum));
        } else {
          incomeDop = Math.round((parseInt(dopSum) * parseFloat(percent) * (parseInt(valDay) - parseInt(dopDay)) / parseInt(daysYear)) / 100);
        }
      }
      console.log(incomeDop);

      //Выводим полученные значения
      if (dopOn && valDop) {
        $('#itogSum').text(numberWithSpaces(parseInt(sum) + parseInt(dopSum)) + ' ' + currencySign);
        $('.itogSumAndIncome').text(numberWithSpaces(parseInt(sum) + parseInt(dopSum) + parseInt(income) + parseInt(incomeDop)) + ' ' + currencySign);
        $('.itogIncome').text(numberWithSpaces(parseInt(income) + parseInt(incomeDop)) + ' ' + currencySign);
      } else {
        $('#itogSum').text(numberWithSpaces(parseInt(sum)) + ' ' + currencySign);
        $('.itogSumAndIncome').text(numberWithSpaces(parseInt(sum) + parseInt(income)) + ' ' + currencySign);
        $('.itogIncome').text(numberWithSpaces(parseInt(income)) + ' ' + currencySign);
      }

    };

    updateCalc('new');

    $('#vklad-calc-form').on('change', 'input', function() {
      updateCalc();
    })
    $('#vklad-calc-form').on('change', 'select', function() {
      updateCalc();
    })
  </script>
<?}?>
