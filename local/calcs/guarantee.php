<?php
/**
 * @var \Local\Calcs\Calc $calc
 */

$sum = intval($_GET['sum']);
if(!$sum) {
    $sum = $calc->getMinSum();
}

$days = intval($_GET['days']);
if(!$days) {
    $days = $calc->getTerms()['start'];
}

$result = $calc->calc([
    'sum' => $sum,
    'days' => $days,
]);

?>
<div class="section section_b-offset">
    <div class="wrapper wrapper_default" id="guarantee">
        <div class="box box_white box_default" id="guarantee-inner">
            <h3 class="h3 table-section__title section__title">Рассчитать комиссию</h3>
            <form action="#" class="form commision-form" id="guarantee-form">


                <div class="row commision-form__row">

                    <div class="col col--lg-6">
                        <label class="label label_default">
                            Тип гарантии
                        </label>
                        <div class="commision-type">
                            <?php $n = 0; ?>
                            <?php foreach ($calc->getAvailableMethods() as $methodName => $method): ?>
                                <label class="checkbox checkbox-boxing">
                                    <input
                                        type="radio"
                                        value="<?php echo $methodName; ?>"
                                        <?php if (
                                            (!$_GET['type'] && $n == 0)
                                            || $_GET['type'] == $methodName
                                        ): ?>checked<?php endif; ?>
                                        name="type"
                                        class="checkbox__input"
                                    >
                                    <span class="checkbox__label">
                                        <?php echo $method->getTitle(); ?>
                                    </span>
                                </label>
                                <?php $n++; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="calc-row calc-row_offset">
                            <label class="label label_default">
                                Срок Гарантии
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
                            <label class="label label_default">
                                Сумма гарантии
                            </label>
                            <div class="u-input">
                                <div class="u-input__widget noui noui_default">
                                    <input
                                        type="text"
                                        id="garanty-summ-input"
                                        class="input input_default u-input__item"
                                        name="sum"
                                    >
                                    <div class="u-input__toggle"
                                         id="garanty-summ-1"
                                         data-start="<?php echo $sum; ?>"
                                         data-min="<?php echo $calc->getMinSum(); ?>"
                                         data-max="<?php echo $calc->getMaxSum(); ?>"
                                    ></div>
                                    <div class="u-nav u-nav_offset u-nav_between">
                                        <span class="u-nav__title">
                                            <?php echo number_format(
                                                $calc->getMinSum(),
                                                0,
                                                '.',
                                                ' '
                                            ); ?> руб
                                        </span>
                                        <span class="u-nav__title">
                                            <?php echo number_format(
                                                $calc->getMaxSum(),
                                                0,
                                                '.',
                                                ' '
                                            ); ?> руб
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col--lg-6">
                        <div class="comision">
                            <img class="comision__img" src="/local/templates/main/images/pechat-img.png" alt="Банковские гарантии. ООО КБ «ГТ банк»">
                            <div class="comision__content">
                                <div class="comision__info">
                                    <span class="comision__title">
                                        Стоимость банковской гарантии
                                    </span>
                                    <span class="comision__price">
                                        <?php echo number_format(
                                            $result['price'],
                                            0,
                                            '.',
                                            ' '
                                        );?> <span class="rub">i</span>
                                    </span>
                                </div>
                                <a
                                    href="#product-open-guarantee-0"
                                    data-title="Подать заявку на банковскую гарантию"
                                    class="btn btn_red btn_default comision__btn inline-t-popup"
                                >
                                    Подать заявку
                                </a>
                                <span class="comision__bottom">
                                    Данный расчёт является предварительным, и не является публичной офертой.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="commit-btns">
                <a target="_blank" href="https://gaztransbank.burno.io/"
                   class="commit-btn btn btn_default btn-bordered_blue rasschet-test">
                    Платформа 1
                </a>
                <a target="_blank" href="https://bg.gaztransbank.ru/"
                   class="commit-btn btn btn_default btn-bordered_blue rasschet-test">
                    Платформа 2
                </a>
            </div>
        </div>
    </div>
</div>

<?php echo view('forms.product', ['id' => 'guarantee-0', 'name' => 'Банковская гарантия']); ?>

<script>
    function updateCalc() {
        let queryString = $('#guarantee form').serialize();

        console.log('Start');
        $('#guarantee').load('<?php echo $APPLICATION->GetCurPage();?>?' + queryString + ' #guarantee-inner', function () {
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

        $('#guarantee').on('change', 'input', function() {
            updateCalc();
        })
    })

</script>

