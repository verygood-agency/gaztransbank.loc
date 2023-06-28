/*tab*/

var tabHeader = document.querySelectorAll('.toggle-w__header');
for(var i = 0; i < tabHeader.length; i++){
    tabHeader[i].addEventListener('click',function(e){
        e.preventDefault();
        var toggleWidget = this.closest(".toggle-w").classList.toggle('active');
        toggleWidget.querySelectorAll('.toggle-w__content').length;
//
//        var toggleWidget = this.closest(".toggle-w").classList.add('toggle');
//        console.log(toggleWidget.querySelector('.toggle-w__content').length);
    })
}
/*tab*/
if(document.querySelectorAll('.match-height').length){
Utils.sameElementsHeight(".match-height");
}
/*date input*/
var element = document.getElementById('date-born');
if(element && window.IMask){
var maskOptions = {
    mask: Date,
    lazy: false,
    overwrite: true,
    autofix: true,
    blocks: {
      d: {mask: IMask.MaskedRange, placeholderChar: 'д', from: 1, to: 31, maxLength: 2},
      m: {mask: IMask.MaskedRange, placeholderChar: 'м', from: 1, to: 12, maxLength: 2},
      Y: {mask: IMask.MaskedRange, placeholderChar: 'г', from: 1900, to: 2999, maxLength: 4}
    }
  };
    var mask = IMask(element, maskOptions);
}




/*date input*/




/*phone input*/
if (window.$ && window.$.fn.inputmask) {
    $('#phone-mask').inputmask("+7(999) 999-99-99");
}

/*phone input*/
var feedUi = document.getElementById('feed-ui');
if(feedUi){
noUiSlider.create(feedUi, {
    start: [100000],
    connect: [true, false],
    range: {
        'min':100000,
        'max': 3000000
    },

});

    feedUi.noUiSlider.on('update', function( values, handle ){
        document.getElementById('feed-input').value =parseInt(values[0]);

    })
}
/*оставте заявку*/


/*депозиты  сумма*/

var DepositsSumm = document.getElementById('summ-slider');
if(DepositsSumm){
noUiSlider.create(DepositsSumm, {
    start: [50000],
    connect: [true, false],
    range: {
        'min': 30000,
        'max': 3000000
    },
    range: {
        'min': 30000,
        '10%': [  60000 ],
        '30%': [  100000 ],
        '40%': [  1000000 ],
        '50%': [  1400000 ],
        '80%': [ 1800000 ],
        '90%': [ 3000000 ],
        'max': 3100000
    },
    tooltips: [wNumb({decimals: 0,thousand: ' '})],
});
}
/*депозиты  сумма*/




var DepositsDay = document.getElementById('day-slider');
if(DepositsSumm){
noUiSlider.create(DepositsDay, {
    start: [5],
    connect: [true, false],
    range: {
        'min':1,
        'max': 15
    },
    tooltips: [wNumb({decimals: 0,suffix: ' лет'})],
});
}

    $('.large-slide__content').matchHeight();
    document.addEventListener('DOMContentLoaded', function() {
      var swiper = new Swiper('.large-slider', {
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      loop:true,
//      autoplay: {
//        delay: 5000,
//        disableOnInteraction: false,
//      },
    });
    swiper.on('slideChange', function () {
        $('.large-slide__content').matchHeight();
    })    
    var swiper = new Swiper('.partners-slider', {
      slidesPerView: 6,
      spaceBetween: 30,
      onlyExternal: true,
      noSwiping: true,
      allowTouchMove:false,
      breakpoints: {
        320: {
          onlyExternal: false,
          noSwiping: false,
          allowTouchMove:true,
          slidesPerView: 2,
          spaceBetween: 10,
        },
          500: {
          onlyExternal: false,
          noSwiping: false,
          allowTouchMove:true,
          slidesPerView: 3,
          spaceBetween: 10,
        },
          760: {
          onlyExternal: false,
          noSwiping: false,
          allowTouchMove:true,
          slidesPerView: 5,
          spaceBetween: 10,
        },
        960: {
          onlyExternal: true,
          noSwiping: true,
          allowTouchMove:false,
          slidesPerView: 6,
          spaceBetween: 30,
        },
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });

  var news = new Swiper('.news-tiles', {
      slidesPerView: 4,
      spaceBetween: 30,
      breakpoints: {
        320: {
          onlyExternal: false,
          noSwiping: false,
          allowTouchMove:true,
          slidesPerView: 1,
          spaceBetween: 10,
        },
        400: {
          onlyExternal: false,
          noSwiping: false,
          allowTouchMove:true,
          slidesPerView: 2,
          spaceBetween: 30,
        },
        760: {
          onlyExternal: false,
          noSwiping: false,
          allowTouchMove:true,
          slidesPerView: 3,
          spaceBetween: 30,
        },
        960: {
          onlyExternal: true,
          noSwiping: true,
          allowTouchMove:false,
          slidesPerView: 4,
          spaceBetween: 30,
        },
      }
  })


  var element = document.querySelectorAll('.toggle-w__header');
    element.forEach(function(item, i, arr) {
        item.addEventListener('click', function(){
            this.classList.toggle('active');
        }, false);
    });


var element = document.querySelectorAll('.arrow-js');
    element.forEach(function(item, i, arr) {
        item.addEventListener('click', function(){
            console.log('1212');
            this.parentNode.parentNode.parentNode.classList.toggle('active');
        }, false);
    });



  //vklad-slider

var vkladSlider = document.getElementById('vklad-slider');
if(vkladSlider){

    noUiSlider.create(vkladSlider, {
        start: [10000],
        connect: [true, false],

        range: {
            'min': 3000,
            '10%': [  6000 ],
            '30%': [  50000 ],
            '40%': [  1000000 ],
            '50%': [  1400000 ],
            '80%': [ 1800000 ],
            '90%': [ 2000000 ],
            'max': 2000000
        }
    });
    vkladSlider.noUiSlider.on('update', function( values, handle ){
        document.getElementById('vklad-slider__result').value =parseInt(values[0]);

    })
}
//vklad-slider
 /*custom-select*/

var navSelect = document.getElementById('nav-select');

/*custom-select*/
var depTime =document.getElementById("deposit-time");
if(depTime){
    NiceSelect.bind(depTime);
}
  });

document.addEventListener("DOMContentLoaded", function(event) {
    /*garanty-sroc*/
    var garantySroc = document.getElementById('garanty-sroc');

    if(garantySroc){
        var start = parseInt(garantySroc.dataset.start);
        var min = parseInt(garantySroc.dataset.min);
        var max = parseInt(garantySroc.dataset.max);
        noUiSlider.create(garantySroc, {
            start: [start],
            connect: [true, false],
            range: {
                'min':min,
                'max': max
            },

        });
        garantySroc.noUiSlider.on('update', function( values, handle ){
            document.getElementById('garanty-sroc-input').value =parseInt(values[0]);
        })
        garantySroc.noUiSlider.on('end', function( values, handle ){
            $('#garanty-sroc-input').trigger('change');
        })
    }
 /*garanty-sroc*/
    /*garanty-summ*/
    var garantySumm = document.getElementById('garanty-summ');
    if(garantySumm){
        var start = parseInt(garantySumm.dataset.start);
        var min = parseInt(garantySumm.dataset.min);
        var max = parseInt(garantySumm.dataset.max);
        noUiSlider.create(garantySumm, {
            start: [start],
            connect: [true, false],
            range: {
                'min':min,
                'max': max
            },

        });
        garantySumm.noUiSlider.on('update', function( values, handle ){
            document.getElementById('garanty-summ-input').value = parseInt(values[0]);
        })
    }
 /*garanty-summ*/



  var customSelect = document.querySelectorAll('.custom-select');
console.log(customSelect);
customSelect.forEach(function(item){

    NiceSelect.bind(item.querySelector('select'));
})
});