$(document).ready(function() {
    let defaultCity = $('.city-link-js.active').attr('data-id');
    let currentCity = defaultCity;

    $('.city-close-js').on('click', function(e) {
        e.preventDefault();

        if(defaultCity === currentCity) {
            $.magnificPopup.close();
        } else {
            Cookies.set('city', currentCity, { expires: 365, path: '/' });
            window.location.reload();
        }
    });

    $('.city-link-js').on('click', function(e) {
        e.preventDefault();
        currentCity = $(this).attr('data-id');
        $('.city-link-js').removeClass('active');
        $(this).addClass('active');
    })
})
