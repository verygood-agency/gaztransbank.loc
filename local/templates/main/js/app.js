
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

;

(function () {
  var breadcrumbs = document.querySelectorAll('.breadcrumbs');

  var _iterator = _createForOfIteratorHelper(breadcrumbs),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var breadcrumb = _step.value;
      var items = breadcrumb.querySelector('.breadcrumbs__items');

      if (!items) {
        continue;
      }

      items.scrollLeft = items.scrollLeftMax || 0;
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
})();

(function () {
  var blocks = document.querySelectorAll('.tabs');
  var buttonActiveClass = 'tabs__button--active';
  var contentActiveClass = 'tabs__content--active';

  var removeContentsActiveClassHandler = function removeContentsActiveClassHandler(contents) {
    var _iterator2 = _createForOfIteratorHelper(contents),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var content = _step2.value;

        if (!content.classList.contains(contentActiveClass)) {
          continue;
        }

        content.classList.remove(contentActiveClass);
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  };

  var removeButtonsActiveClassHandler = function removeButtonsActiveClassHandler(buttons) {
    var _iterator3 = _createForOfIteratorHelper(buttons),
        _step3;

    try {
      for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
        var button = _step3.value;

        if (!button.classList.contains(buttonActiveClass)) {
          continue;
        }

        button.classList.remove(buttonActiveClass);
      }
    } catch (err) {
      _iterator3.e(err);
    } finally {
      _iterator3.f();
    }
  };

  var clickHandler = function clickHandler(e, el, index, contents, buttons) {
    e.preventDefault();

    if (!el.classList.contains(buttonActiveClass)) {
      removeButtonsActiveClassHandler(buttons);
      el.classList.add(buttonActiveClass);
    }

    var curContent = contents[index];

    if (!curContent) {
      return;
    }

    if (!curContent.classList.contains(contentActiveClass)) {
      removeContentsActiveClassHandler(contents);
      curContent.classList.add(contentActiveClass);
    }
  };

  var _iterator4 = _createForOfIteratorHelper(blocks),
      _step4;

  try {
    var _loop = function _loop() {
      var block = _step4.value;
      var buttons = block.querySelectorAll('.tabs__button');
      var contents = block.querySelectorAll('.tabs__content');

      var _loop2 = function _loop2(index) {
        if (!buttons.hasOwnProperty(index)) {
          return "continue";
        }

        var button = buttons[index];
        button.addEventListener('click', function (e) {
          clickHandler(e, button, index, contents, buttons);
        });
      };

      for (var index in buttons) {
        var _ret = _loop2(index);

        if (_ret === "continue") continue;
      }
    };

    for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
      _loop();
    }
  } catch (err) {
    _iterator4.e(err);
  } finally {
    _iterator4.f();
  }
})();

(function () {
  var _$$fn;

  var $ = window.$;

  if (!($ !== null && $ !== void 0 && (_$$fn = $.fn) !== null && _$$fn !== void 0 && _$$fn.select2)) {
    return;
  }

  $(document).ready(function () {
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
  });
})();

(function () {
  var IMask = window.IMask;

  if (!IMask) {
    return;
  }

  var blocks = document.querySelectorAll('.callback-form');
  var maskOptions = {
    mask: '+{7}(000) 000-00-00'
  };

  var _iterator5 = _createForOfIteratorHelper(blocks),
      _step5;

  try {
    for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
      var block = _step5.value;
      var input = block.querySelector('.callback-form__input');

      if (!input) {
        continue;
      }

      IMask(input, maskOptions);
    }
  } catch (err) {
    _iterator5.e(err);
  } finally {
    _iterator5.f();
  }
})();