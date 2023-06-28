;(function(window) {'use strict';

var raf = window.requestAnimationFrame
    ? window.requestAnimationFrame.bind(window)
    : setTimeout;
function nextTick(fn) {
    raf(function () {
        raf(fn);
    });
}

function getAutoHeightDuration(height) {
    if (!height) {
        return 0;
    }
    var constant = height / 36;
    return Math.round((4 + 15 * Math.pow(constant, 0.25) + constant / 5) * 10);
}

var Collapse = /** @class */ (function () {
    function Collapse(props) {
        this.props = props;
        this.timeout = null;
        this.$summary = props.summaryEl;
        this.$collapse = props.collapseEl;
        this.$collapseWrapperInner = props.collapseEl.querySelector('.collapse__wrapper-inner');
        this.expanded = !!props.initExpanded;
        this._initEvents();
    }
    Collapse.prototype.toggle = function (e) {
        var _this = this;
        var _a, _b;
        if (!this._isAllow()) {
            return;
        }
        e.preventDefault();
        this.expanded = !this.expanded;
        var wrapperSize = this._getWrapperSize();
        var duration = getAutoHeightDuration(wrapperSize);
        if (this.expanded) {
            this.$collapse.style.height = "".concat(wrapperSize, "px");
            this.$collapse.style.transitionDuration = "".concat(duration, "ms");
            this.$collapse.classList.remove('collapse--hidden');
            if (this.timeout) {
                clearTimeout(this.timeout);
            }
            this.timeout = setTimeout(function () {
                _this.$collapse.style.height = 'auto';
                _this.$collapse.classList.add('collapse--entered');
            }, duration);
        }
        else {
            this.$collapse.style.height = "".concat(wrapperSize, "px");
            nextTick(function () {
                _this.$collapse.style.height = "0px";
                _this.$collapse.classList.remove('collapse--entered');
                if (_this.timeout) {
                    clearTimeout(_this.timeout);
                }
                _this.timeout = setTimeout(function () {
                    _this.$collapse.classList.add('collapse--hidden');
                }, duration);
            });
        }
        this.$summary.setAttribute('aria-expanded', this.expanded.toString());
        (_b = (_a = this.props).onToggle) === null || _b === void 0 ? void 0 : _b.call(_a, this.expanded);
    };
    Collapse.prototype._initEvents = function () {
        var _this = this;
        this.$summary.addEventListener('click', function (e) {
            _this.toggle(e);
        });
        this.$summary.addEventListener('keydown', function (e) {
            _this._handleKeyDown(e);
        });
    };
    Collapse.prototype._handleKeyDown = function (e) {
        if (e.key === ' ' || e.key === 'Enter') {
            e.preventDefault();
            this.toggle(e);
        }
    };
    Collapse.prototype._getWrapperSize = function () {
        return this.$collapseWrapperInner
            ? this.$collapseWrapperInner.clientHeight
            : 0;
    };
    Collapse.prototype._isAllow = function () {
        return typeof this.props.allowToggle !== 'undefined'
            ? typeof this.props.allowToggle === 'function'
                ? this.props.allowToggle()
                : this.props.allowToggle
            : true;
    };
    return Collapse;
}());

window.addEventListener('DOMContentLoaded', function () {
    var accordions = document.querySelectorAll('.accordion-section');
    accordions.forEach(function (accordion) {
        var summaryEl = accordion.querySelector('.accordion-section__summary');
        var summaryExpandEl = accordion.querySelector('.accordion-section__summary-expand');
        var hideText = (summaryExpandEl === null || summaryExpandEl === void 0 ? void 0 : summaryExpandEl.dataset.hideText) || 'Скрыть';
        var showText = (summaryExpandEl === null || summaryExpandEl === void 0 ? void 0 : summaryExpandEl.dataset.showText) || 'Показать';
        var summaryExpandTextEl = accordion.querySelector('.accordion-section__summary-expand-text');
        var collapseEl = accordion.querySelector('.collapse');
        if (!summaryEl || !collapseEl) {
            return;
        }
        new Collapse({
            collapseEl: collapseEl,
            summaryEl: summaryEl,
            initExpanded: summaryEl.getAttribute('aria-expanded') === 'true',
            onToggle: function (expanded) {
                accordion.classList[expanded ? 'add' : 'remove']('accordion-section--expanded');
                if (summaryExpandTextEl) {
                    summaryExpandTextEl.innerText = expanded ? hideText : showText;
                }
            },
        });
    });
});
})(
  typeof window !== 'undefined' ? window : typeof global !== 'undefined' ? global : {}
);