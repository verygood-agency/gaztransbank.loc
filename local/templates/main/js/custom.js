let loadRecaptcha = true;
// Функция загрузки библиотеки по требованию
function fLoadRecaptcha(){
  if (loadRecaptcha) {
    console.log('loadRecaptcha');
    loadRecaptcha = false;

    let url = "https://www.google.com/recaptcha/api.js";
    var script = document.createElement("script");

    if (script.readyState){  // IE
      script.onreadystatechange = function(){
        if (script.readyState == "loaded" ||
          script.readyState == "complete"){
          script.onreadystatechange = null;
        }
      };
    } else {  // Другие браузеры
      script.onload = function(){};
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
  }
}

function ready(fn) {
  if (document.readyState != 'loading'){
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}
jQuery(document).ready(function($){
    
    $('.toggle-w__content table').each(function(){
        $(this).wrap('<div class="table-wrapper">');
    })
    
    $('.file-w__input').change(function(){
        var fileVal = $(this).val();
        var that = $(this);
        var placeholder= $(this).closest('.file-w').find('.file-w__title').data('title');
        if(fileVal.length > 0){
            $picImg = fileVal.split(/(\\|\/)/g).pop();
            that.closest('.file-w').find('.file-w__title').text($picImg);
        }else{
            that.closest('.file-w').find('.file-w__title').html(placeholder);
        }
    })
    
   $('input[name="phone"]').inputmask("+7(999) 999-99-99");
   $('.phone-mask').inputmask("+7(999) 999-99-99");
   $('.date-mask').inputmask("99.99.9999");

    $('#date-w__input').datepicker({
        autoClose:true
    });
    
    $('.kredit-tile').matchHeight();
    $('.match-height').matchHeight();
    
    $('.nst-toggle').click(function(){
        $(this).toggleClass('active');
        $('.nst-content').stop().slideToggle();
    })
    
    $.bvi({
        'bvi_target' : '.bvi-open', // Класс ссылки включения плагина
        "bvi_theme" : "white", // Цвет сайта
        "bvi_font" : "arial", // Шрифт
        "bvi_font_size" : 16, // Размер шрифта
        "bvi_letter_spacing" : "normal", // Межбуквенный интервал
        "bvi_line_height" : "normal", // Междустрочный интервал
        "bvi_images" : true, // Изображения
        "bvi_reload" : false, // Перезагрузка страницы при выключении плагина
        "bvi_fixed" : false, // Фиксирование панели для слабовидящих вверху страницы
        "bvi_tts" : true, // Синтез речи
        "bvi_flash_iframe" : true, // Встроенные элементы (видео, карты и тд.)
        "bvi_hide" : false // Скрывает панель для слабовидящих и показывает иконку панели.
    });
});
ready(function() {
    $('.inline-popup').magnificPopup({
      type:'inline',
      midClick: true
    });
    $(document).on("click", ".inline-t-popup", function(e){
        //Загрузка библиотеки reCaptcha
        fLoadRecaptcha();

        e.preventDefault();
        var title = $(this).data('title');
        $.magnificPopup.open({
            items: {
                src: $(this).attr('href')
            },
            type: 'inline',
            callbacks:{
                open:function(){
                    $('.t-popup-title').text(title);
                }
            }
        });
    }); 
   
    
    let selects = document.querySelectorAll('#carier-filter-form-js select')
    Array.prototype.forEach.call(selects, function(el, i){
        el.addEventListener('change', function() {
            let form = document.querySelector('#carier-filter-form-js')
            form.submit();
        })
    });
})

document.addEventListener('DOMContentLoaded', function () {

  //Загрузка библиотеки reCaptcha для форм с классом js_form_product2
  // $('form.js_form_product2 input').bind("change", fLoadRecaptcha);

  //Обработка форм с классом js_form_product2
  const forms = document.querySelectorAll('form.js_form_product2');
  forms.forEach(form => {
    //Загрузка библиотеки reCaptcha
    form.querySelectorAll('input').forEach(input => {
      input.addEventListener('change', fLoadRecaptcha);
    });

    //Отправка формы
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let formData = new FormData(form);

      if (formData.get("name") == "" || formData.get("phone") == "" || formData.get("consent") != "on") {
        Swal.fire({
          icon: 'warning',
          title: 'Внимание',
          text: 'Заполните все обязательные поля'
        })
      } else if (formData.get("phone").replace(/[\D]+/g, '').length != 11) {
        Swal.fire({
          icon: 'warning',
          title: 'Внимание',
          text: 'Укажите правильный номер телефон'
        })
      } else if (formData.get("g-recaptcha-response") == undefined || formData.get("g-recaptcha-response") == "") {
        Swal.fire({
          icon: 'warning',
          title: 'Внимание',
          text: 'Необходимо пройти проверку "Я не робот"'
        })
      } else {
        BX.ajax({
          url: '/local/ajax/forms/product2.php',
          data: formData,
          method: 'POST',
          dataType: 'json',
          processData: false,
          preparePost: false,
          onsuccess: function (result) {
            result = JSON.parse(result);
            console.log(result);

            Swal.fire({
              icon: result["status"],
              html: result["text"],
            })

            if (result.status == "success") {
              form.reset();
            }
          },
          onfailure: function () {
            Swal.fire({
              icon: 'warning',
              title: 'Внимание',
              text: 'Ошибка отправки формы'
            })
          }
        });
      }
    });
  });

});