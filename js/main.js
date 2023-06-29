// техническая часть - УДАЛИТЬ НА ПРОДАКШЕНЕ!
// получить в консоли элемент, по которому кликнули
document.addEventListener('click', e => console.log(e.target));


// выбираем все элементы с классом .custom-filter__link
let filterLinks = document.querySelectorAll('.custom-filter__link');

// перебираем все найденные элементы
filterLinks.forEach(function(link) {
    // добавляем слушатель события 'click' на каждый элемент
    link.addEventListener('click', function(e) {
        // предотвращаем стандартное действие ссылки
        e.preventDefault();

        // удаляем класс .active со всех элементов .custom-filter__link
        filterLinks.forEach(function(innerLink) {
            innerLink.classList.remove('active');
        });

        // добавляем класс .active тому элементу, по которому кликнули
        this.classList.add('active');
    });
});
