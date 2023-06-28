<?php
/**
 * @var \Local\Calcs\Calc $calc
 * @var $arResult
 */

global $APPLICATION;
global $reCaptchaKey;

if ($arResult['PROPERTIES']['CALCULATOR']['VALUE']) {
  $sum = intval($_GET['sum']);
  if (!$sum || $sum < $calc->getMinSum()) {
    $sum = $calc->getMinSum();
  }

  $days = intval($_GET['days']);
  if (!$days) {
    $days = intval($calc->getTerms()[0]) * 365;
  }

  $years = round($days / 365);
  $months = $years * 12;


  $result = $calc->calc([
    'sum' => $sum,
    'months' => $months,
    'days' => $days,
  ]);
}
?>

<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
  }
</style>

<form action="/local/ajax/forms/kredit2.php" method="post" class="ajax-form" id="credit-form" onkeydown="if(event.keyCode==13){return false;}">
  <?php echo bitrix_sessid_post() ?>

  <input
    hidden
    name="credit_name"
    type="text"
    value="<?=$APPLICATION->ShowTitle(false)?>">
  <div class="app">
    <div class="section section_default section_gray">
      <div class="wrapper wrapper_default">
        <div class="credit-form credit-form--step-1">
          <div class="credit-form__container">
            <div class="credit-form__header">
              <div class="credit-form__title-area">
                <h2 class="credit-form__title">Оставьте заявку сейчас</h2>
                <div class="credit-form__description">Если заявка была оставлена в нерабочее время, то мы перезвоним в ближайший рабочий день.</div>
              </div>
              <div class="credit-form__nav">
                <div class="form-nav">
                  <ul class="form-nav__items">
                    <li id="link-1" class="form-nav__item form-nav__item--active">
                      <a class="form-nav__link">Условия кредита</a>
                    </li>
                  </ul>
                </div>

              </div>
            </div>
            <div class="credit-form__steps">
              <div id="step-1" class="credit-form__step credit-form__step--show">
                <?if ($arResult['PROPERTIES']['CALCULATOR']['VALUE']){?>
                  <div id="calc" class="credit-form__calc">
                    <div class="credit-calc">
                      <div id="vklad-calc-form-inner" class="credit-calc__container">
                        <div class="credit-calc__fields">
                          <div class="credit-calc__field">
                            <div class="field">
                              <label class="field__label">
                                Сумма кредита
                              </label>
                              <div class="field__content">

                                <div class="u-input">
                                  <div class="u-input__widget noui noui_default">
                                    <input
                                      name="sum"
                                      type="number"
                                      id="feed-input"
                                      value="<?echo $sum;?>"
                                      class="input input_default u-input__item">
                                    <div
                                      class="u-input__toggle noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr"
                                      id="feed-ui"
                                      data-start="<?echo $sum;?>"
                                      data-min="<?echo $calc->getMinSum();?>"
                                      data-max="<?echo $calc->getMaxSum(); ?>"
                                    >
                                    </div>
                                    <div class="u-nav u-nav_offset u-nav_between">
                                                                            <span class="u-nav__title">
                                                                                От <?php echo number_format(
                                                                                $calc->getMinSum(),
                                                                                0,
                                                                                '.',
                                                                                ' '
                                                                              ); ?>
                                                                            </span>
                                      <span class="u-nav__title">
                                                                                До <?php echo number_format(
                                          $calc->getMaxSum(),
                                          0,
                                          '.',
                                          ' '
                                        ); ?>
                                                                            </span>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>


                          </div>
                          <div class="credit-calc__field">
                            <div class="field">
                              <label class="field__label">
                                Срок кредита
                              </label>
                              <div class="field__content">
                                <div class="select">
                                  <select id="years" name="years" class="select__select">
                                    <?foreach($calc->getTerms() as $n => $term):?>
                                      <option value="<?echo $term?>" <?if(intval($term) == $years){?>selected<?}?> ><?echo $term;?></option>
                                    <?endforeach;?>
                                  </select>
                                </div>

                              </div>
                            </div>


                          </div>
                        </div>
                        <div class="credit-calc__info-wrapper">
                          <div class="credit-calc__info">
                            <div class="credit-calc__payment">
                              <div class="credit-calc__payment-title">Ежемесячный платеж</div>
                              <div class="credit-calc__payment-field">
                                <div class="credit-number-field">
                                  <div class="credit-number-field__container">
                                    <button <?if ($sum <= $calc->getMinSum()){echo ('style="background-color: #003566"');} else {echo ('id="btn-minus"');}?> class="credit-number-field__btn credit-number-field__btn--minus" type="button"></button>
                                    <input
                                      name="monthly_payment"
                                      id="monthly_payment"
                                      type="number"
                                      inputmode="numeric"
                                      value="<?echo $result['monthlyPay'];?>"
                                      class="credit-number-field__input"
                                    >
                                    <button <?if ($sum >= $calc->getMaxSum()){echo ('style="background-color: #003566"');} else {echo ('id="btn-plus"');}?> class="credit-number-field__btn credit-number-field__btn--plus" type="button"></button>
                                  </div>
                                </div>

                              </div>
                            </div>
                            <div class="credit-calc__percent">
                              <input
                                hidden
                                name="credit_percent"
                                type="text"
                                value="<?echo $result['percent']; ?>%">
                              <div class="credit-calc__percent-title">Процентная ставка:</div>
                              <div id="percent" class="credit-calc__percent-value"><?echo $result['percent']; ?>%</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?}?>
                <div class="credit-form__fields credit-form__fields--col-2">
                  <div class="credit-form__fields-group">
                    <div class="credit-form__field">
                      <div class="field">
                        <div class="field__content">
                          <input required name="family" type="text" inputmode="text" placeholder="Фамилия*" class="input input_default input_middle">

                        </div>
                      </div>

                    </div>
                    <div class="credit-form__field">
                      <div class="field">
                        <div class="field__content">
                          <input required name="name" type="text" inputmode="text" placeholder="Имя*" class="input input_default input_middle">

                        </div>
                      </div>

                    </div>
                    <div class="credit-form__field">
                      <div class="field">
                        <div class="field__content">
                          <input name="patronymic" type="text" inputmode="text" placeholder="Отчество" class="input input_default input_middle">

                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="credit-form__fields-group">
                    <div class="credit-form__field">
                      <div class="field">
                        <div class="field__content">
                          <input required name="phone" type="tel" inputmode="tel" placeholder="Телефон*" class="input input_default input_middle phone-mask">

                        </div>
                        <div class="field__description">
                          Мы отправим решение по заявке на указанный номер
                        </div>
                      </div>

                    </div>
                    <div class="credit-form__field">
                      <div class="field">
                        <div class="field__content">
                          <input required name="email" type="email" inputmode="email" placeholder="Электронная почта*" class="input input_default input_middle">
                        </div>
                        <div class="field__description">
                          На данный email будет направлена информация по заявке
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="credit-form__consent">
                  <div class="consent">
                    <label class="consent__container">
                      <input required name="policy" type="checkbox" class="consent__input visually-hidden">
                      <span class="consent__checkbox"></span>
                      <span class="consent__text">Я соглашаюсь <a href="/policy/">с условиями</a> и даю свое согласие на <a href="/policy/">обработку</a> моих персональных данных.</span>
                    </label>
                  </div>
                  <br>
                  <div class="g-recaptcha" data-sitekey="<?=$reCaptchaKey?>"></div>
                </div>
              </div>
            </div>
            <div class="credit-form__footer">
              <div class="credit-form__notification-wrapper">
                <div class="credit-form__notification">Мы гарантируем безопасность и сохранность ваших данных</div>
              </div>
              <div class="credit-form__buttons-wrapper">
                <div class="credit-form__buttons">
                  <button id="next" type="submit" class="credit-form__button credit-form__button--next">Отправить</button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</form>

<style>
  @media screen and (min-width: 768px) {
    .credit-form__footer {
      margin-top: 5px;
    }
  }
</style>

<script>
  var nameCalc = "<?echo ($arResult['PROPERTIES']['CALCULATOR']['VALUE'])?>";

  function sumCalc(pay) {
    let month = parseInt($('#years').val()) * 12;
    let PM = <?echo $result['percent'];?>/100/
    12;
    let sumNew = 0;
    let min = parseInt(feedUi.dataset.min);
    let max = parseInt(feedUi.dataset.max);

    sumNew = Math.round(pay / ((PM * Math.pow(1 + PM, month)) / (Math.pow(1 + PM, month) - 1)));

    if (sumNew < min) {
      sumNew = min
    }
    ;
    if (sumNew > max) {
      sumNew = max
    }
    ;

    $('#monthly_payment').val(pay);
    $('#feed-input').val(sumNew);

    creditCalc();
  }

  function creditCalc() {
    let type = 'annuet';
    let sum = $('#feed-input').val();
    let year = parseInt($('#years').val()) * 365;

    let queryString = 'type=' + type + '&sum=' + sum + '&days=' + year;

    $('#calc').load('<?echo $APPLICATION->GetCurPage();?>?' + queryString + ' #vklad-calc-form-inner', function () {
      var feedUi = document.getElementById('feed-ui');
      if (feedUi) {
        var start = parseInt(feedUi.dataset.start);
        var min = parseInt(feedUi.dataset.min);
        var max = parseInt(feedUi.dataset.max);
        noUiSlider.create(feedUi, {
          start: [start],
          connect: [true, false],
          range: {
            'min': min,
            'max': max
          },

        });

        feedUi.noUiSlider.on('update', function (values, handle) {
          document.getElementById('feed-input').value = parseInt(values[0]);
        })

        feedUi.noUiSlider.on('end', function (values, handle) {
          creditCalc();
        })
      }

      $('.select__select').select2({
        minimumResultsForSearch: -1,
        width: '100%',
        language: {
          noResults: function noResults() {
            return 'Ничего не найдено';
          }
        },
        scrollAfterSelect: true,
        placeholder: 'Выберите'
      });

      $('#years').on('change', function () {
        creditCalc();
      })

      $('#btn-minus').on('click', function () {
        sumCalc($('#monthly_payment').val() - 5);
      })

      $('#btn-plus').on('click', function () {
        sumCalc(+$('#monthly_payment').val() + +5);
      })

      $('#monthly_payment').on('change', function () {
        sumCalc($('#monthly_payment').val());
      })

      $('#feed-input').on('change', function (el) {
        $('#feed-input').val(
          $('#feed-input').val()
        )
        creditCalc();
      })
    })

    //getCreditPercent(type, sum, year);*/

  }

  $(document).ready(function () {
    if (nameCalc != "") {
      creditCalc();
    } else {
      $('#link-1 a').text("Заявитель");
    }

    $(document).on('click', '#next', function(e) {
      e.preventDefault();
      if(check('#step-1')) {
        $('#credit-form').submit();
      }
    })

    $("#credit-form").submit(function() {
      $('input[name="phone"]').val(null);
      $('input[name="email"]').val(null);
      $('input[name="policy"]').removeAttr("checked");
      document.getElementById("credit-form").reset();
    });

    $("#step-1").on('change', 'input', function() {
      //Загрузка библиотеки reCaptcha
      fLoadRecaptcha();
    })

  })

  function check(id)
  {
    let fields = $(id)
      .find("select[required], textarea[required], input[required]")
      .serializeArray();

    let result = true;
    console.log(fields);

    $.each(fields, function (i, field) {
      console.log(field)
      if (!field.value) {
        Swal.fire({
          icon: 'warning',
          title: 'Внимание',
          text: 'Необходимо заполнить все обязательные поля!'
        })

        result = false;
      }
    });

    if(! $('[name=policy]:checked').length && result) {
      Swal.fire({
        icon: 'warning',
        title: 'Внимание',
        text: 'Необходимо согласиться на обработку персональных данных!'
      })
      result = false;
    } else if(! $('#step-1 .g-recaptcha-response').val() && result) {
      Swal.fire({
        icon: 'warning',
        title: 'Внимание',
        text: 'Необходимо пройти проверку "Я не робот"'
      })
      result = false;
    }

    return result;
  }


</script>

<?php echo view('forms.product', ['id' => 'credit-0', 'name' => 'Заявка на кредит']); ?>
