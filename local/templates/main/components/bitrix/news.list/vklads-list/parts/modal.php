<div class="deposit-modal">
    <div class="deposit-modal__container">
        <button type="button" class="deposit-modal__close-btn" aria-label="Закрыть" data-modal-close></button>
        <div class="deposit-modal__content">
            <h2 class="deposit-modal__title">
                Открыть вклад
            </h2>
            <div class="deposit-modal__buttons">
                <div class="deposit-modal__button deposit-modal__button--color-red">
                    <a href="https://elf.faktura.ru/elf/app/?site=gaztransbank" class="deposit-modal__button-link">Я являюсь клиентом Банка</a>
                </div>
                <div class="deposit-modal__button deposit-modal__button--color-blue">
                    <a href="#product-open-vklad-<?=$_REQUEST['ID']; ?>" data-title="Заявка на открытие вклада - <?=$_REQUEST['NAME'];?>" class="deposit-modal__button-link inline-t-popup" data-modal-close>Я хочу стать клиентом Банка</a>
                </div>
            </div>
        </div>
    </div>
</div>