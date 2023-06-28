;(function () {
    const breadcrumbs = document.querySelectorAll('.breadcrumbs')
    for (const breadcrumb of breadcrumbs) {
        const items = breadcrumb.querySelector('.breadcrumbs__items')
        if (!items) {
            continue
        }

        items.scrollLeft = items.scrollLeftMax || 0
    }
})()
;(function () {
    const blocks = document.querySelectorAll('.tabs')
    const buttonActiveClass = 'tabs__button--active'
    const contentActiveClass = 'tabs__content--active'

    const removeContentsActiveClassHandler = (contents) => {
        for (const content of contents) {
            if (!content.classList.contains(contentActiveClass)) {
                continue
            }
            content.classList.remove(contentActiveClass)
        }
    }

    const removeButtonsActiveClassHandler = (buttons) => {
        for (const button of buttons) {
            if (!button.classList.contains(buttonActiveClass)) {
                continue
            }
            button.classList.remove(buttonActiveClass)
        }
    }

    const clickHandler = (e, el, index, contents, buttons) => {
        e.preventDefault()
        if (!el.classList.contains(buttonActiveClass)) {
            removeButtonsActiveClassHandler(buttons)
            el.classList.add(buttonActiveClass)
        }

        const curContent = contents[index]
        if (!curContent) {
            return
        }

        if (!curContent.classList.contains(contentActiveClass)) {
            removeContentsActiveClassHandler(contents)
            curContent.classList.add(contentActiveClass)
        }
    }

    for (const block of blocks) {
        const buttons = block.querySelectorAll('.tabs__button')
        const contents = block.querySelectorAll('.tabs__content')
        for (const index in buttons) {
            if (!buttons.hasOwnProperty(index)) {
                continue
            }

            const button = buttons[index]
            button.addEventListener('click', (e) => {
                clickHandler(e, button, index, contents, buttons)
            })
        }
    }
})()
;(function () {
    const $ = window.$

    if (!$?.fn?.select2) {
        return
    }

    $(document).ready(function () {
        $('.select__select').select2({
            minimumResultsForSearch: -1,
            width: '100%',
            language: {
                noResults: function () {
                    return 'Ничего не найдено'
                },
            },
            scrollAfterSelect: true,
            placeholder: 'Выберите',
        })
    })
})()
;(function () {
    const $ = window.$
    if (!$?.fn?.inputmask) {
        return
    }
    $(document).ready(function () {
        $('.callback-form__input').inputmask("+7(999) 999-99-99");
    })
})()