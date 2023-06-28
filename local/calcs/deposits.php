<?php
/**
 * @var \Local\Calcs\Calc $calc
 */

$sum = intval($_GET['sum']);
if (!$sum) {
    $sum = $calc->getMinSum();
}

$days = intval($_GET['days']);
if (!$days) {
    $days = $calc->getTerms()['start'];
}

$result = $calc->calc([
    'sum' => $sum,
    'days' => $days,
]);


?>
<div class="calc-content" id="vklad-calc-form">
    <form action="#" class="form calc-form deposit-calc" id="vklad-calc-form-inner">
        <div class="row">
            <div class="col col--lg-7">
                <div class="calc-controls calc-controls_r-offset">
                    <div class="calc-row calc-row_offset">
                        <div class="calc-radio">
                            <?php $n = 0; ?>
                            <?php foreach ($calc->getAvailableMethods() as $methodName => $method): ?>
                                <label class="radio radio_blue calc-radio__radio">
                                    <input
                                        value="<?php echo $methodName; ?>"
                                        type="radio"
                                        class="radio__input"
                                        name="type"
                                        <?php if (
                                        (!$_GET['type'] && $n == 0)
                                        || $_GET['type'] == $methodName
                                        ): ?>checked<?php endif; ?>
                                    >
                                    <span class="radio__label">
                                        <?php echo $method->getTitle(); ?>
                                    </span>
                                </label>
                                <?php $n++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="calc-row calc-row_offset">
                        <label class="label label_default">
                            Сумма вклада
                        </label>

                        <div class="u-input__widget noui noui_default">
                            <input
                                name="sum"
                                type="text"
                                id="garanty-summ-input"
                                class="input input_default u-input__item"
                            >
                            <div class="u-input__toggle" id="garanty-summ-1"
                                 data-start="<?php echo $sum; ?>"
                                 data-min="<?php echo $calc->getMinSum(); ?>"
                                 data-max="<?php echo $calc->getMaxSum(); ?>"
                            ></div>
                            <div class="u-nav u-nav_offset u-nav_between">
                                <span class="u-nav__title">
                                    от <?php echo number_format(
                                        $calc->getMinSum(),
                                        0,
                                        '.',
                                        ' '
                                    ); ?> <i class="rub">i</i>
                                </span>
                                <span class="u-nav__title">
                                    до <?php echo number_format(
                                        $calc->getMaxSum(),
                                        0,
                                        '.',
                                        ' '
                                    ); ?> <i class="rub">i</i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="calc-row calc-row_offset">
                        <label class="label label_default">
                            Срок
                        </label>
                        <div class="u-input">
                            <div class="u-input__widget noui noui_default">
                                <input
                                    type="text"
                                    id="garanty-sroc-input"
                                    class="input input_default u-input__item"
                                    name="days"
                                >
                                <div
                                    class="u-input__toggle"
                                    id="garanty-sroc-1"
                                    data-start="<?php echo $days ?>"
                                    data-min="<?php echo $calc->getTerms()['start']; ?>"
                                    data-max="<?php echo $calc->getTerms()['end']; ?>"
                                ></div>
                                <div class="u-nav u-nav_offset u-nav_between">
                                    <span class="u-nav__title">
                                        <?php echo $calc->getTerms()['start']; ?> день
                                    </span>
                                    <span class="u-nav__title">
                                        <?php echo $calc->getTerms()['end']; ?> дней
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="calc-row calc-row_offset">
                        <button type="button" class="btn deposit-calc__btn btn_large btn_blue">
                            <span class="btn__title">
                                Рассчитать
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col col--lg-5">
                <div class="calc-summ">
                    <img class="calc-summ__pic" src="<?=SITE_TEMPLATE_PATH?>/images/dep-calc.png" alt="Депозиты. ООО КБ «ГТ банк»">
                    <div class="calc-sum__content">
                        <div class="summ-result calc-sum__row calc-sum__row_offset">
                            <span class="calc-summ__title">
                                Сумма через <?php plural_form($days, ['день', 'дня', 'дней']); ?>
                            </span>
                            <div class="calc-summ__desc">
                                <span class="calc-summ__numb"><?php echo price_format($sum + $result['price']); ?></span>
                                <span class="rub rub_middle">i</span>
                            </div>
                        </div>
                        <div class="calc-sum__row calc-sum__row_offset">
                            <div class="row">
                                <div class="col col--lg-4">
                                    <div class="calc-sum-info calc-sum-info_offset">
                                        <span class="calc-sum-info__title title title_block">
                                            Процентная ставка
                                        </span>
                                        <div class="h4 calc-sum-info__desc title title_block title_bold">
                                            <?php echo $result['percent']; ?>%
                                        </div>
                                    </div>
                                </div>
                                <div class="col col--lg-8">
                                    <div class="calc-sum-info calc-sum-info_offset">
                                        <span class="calc-sum-info__title title title_block">
                                            Доход
                                        </span>
                                        <div class="h4 calc-sum-info__desc title title_block title_bold">
                                            <?php echo price_format($result['price']); ?> <span class="rub">i</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="calc-sum__row calc-sum__row_offset">
                            <a
                                href="#product-open-deposit-0"
                                class="btn btn_default btn-bordered_red inline-t-popup"
                                data-tile="Заявка на депозит"
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
<script>
    function updateCalc() {
        let queryString = $('#vklad-calc-form form').serialize();

        console.log('Start');
        $('#vklad-calc-form').load('<?php echo $APPLICATION->GetCurPage();?>?' + queryString + ' #vklad-calc-form-inner', function () {
            console.log('Proceed');
            let garantySumm = document.getElementById('garanty-summ-1');
            if (garantySumm) {
                var start = parseInt(garantySumm.dataset.start);
                var min = parseInt(garantySumm.dataset.min);
                var max = parseInt(garantySumm.dataset.max);
                noUiSlider.create(garantySumm, {
                    start: [start],
                    connect: [true, false],
                    range: {
                        'min': min,
                        'max': max
                    },

                });
                garantySumm.noUiSlider.on('update', function (values, handle) {
                    document.getElementById('garanty-summ-input').value = parseInt(values[0]);
                })
                garantySumm.noUiSlider.on('end', function (values, handle) {
                    $('#garanty-summ-input').trigger('change');
                    updateCalc();
                })
            }

            let garantySroc = document.getElementById('garanty-sroc-1');

            if (garantySroc) {
                var start = parseInt(garantySroc.dataset.start);
                var min = parseInt(garantySroc.dataset.min);
                var max = parseInt(garantySroc.dataset.max);
                noUiSlider.create(garantySroc, {
                    start: [start],
                    connect: [true, false],
                    range: {
                        'min': min,
                        'max': max
                    },

                });
                garantySroc.noUiSlider.on('update', function (values, handle) {
                    document.getElementById('garanty-sroc-input').value = parseInt(values[0]);
                })
                garantySroc.noUiSlider.on('end', function (values, handle) {
                    $('#garanty-sroc-input').trigger('change');
                    updateCalc();
                })
            }
        });

    }

    $(document).ready(function () {
        updateCalc();

        $('#vklad-calc-form').on('change', 'input', function () {
            updateCalc();
        })
    });
</script>

<?php echo view('forms.product', ['id' => 'deposit-0', 'name' => 'Заявка на депозит']); ?>
