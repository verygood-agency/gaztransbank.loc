<style>
  p {
    margin-bottom: 1rem;
  }
  .deposit-modal__buttons{
    margin-top: 4rem
  }
</style>
<div class="deposit-modal">
  <div class="deposit-modal__container">
    <button type="button" class="deposit-modal__close-btn" aria-label="Закрыть" data-modal-close></button>
    <div class="deposit-modal__content">
      <h2 class="deposit-modal__title">
        <?=htmlspecialchars($_REQUEST['NAME']);?>
      </h2>
      <?=htmlspecialchars_decode(htmlspecialchars($_REQUEST['CONTENT']));?>
      <div class="deposit-modal__buttons">
        <div class="deposit-modal__button deposit-modal__button--color-blue">
          <a href="" class="deposit-modal__button-link inline-t-popup" data-modal-close >Закрыть окно</a>
        </div>
      </div>
    </div>
  </div>
</div>