var ui;

!(function ($, window, ui) {
    "use strict";

    String.prototype.format = function() {
        var formatted = this;
        for( var arg in arguments ) {
            formatted = formatted.replace("{" + arg + "}", arguments[arg]);
        }
        return formatted;
    };

    var baseUi = {
        view: {},

        init: function () {
            $(function () {
                $("#searchButton").on('click', ui.onClickSearchImage);
                document.addEventListener('click', ui.onListenerDocument);
            });
        },

        onListenerDocument: function (e) {
            var target = e.target;
            var parent = target.parentElement;

            if (target.id === "searchButton") {
                return;
            }

            if (parent.id !== "searchForm") {
                ui.hide("#searchForm");
            }
        },

        hide: function (selector) {
            $(selector).hide();
        },

        show: function (selector) {
            $(selector).show();
        },

        toggle: function (selector) {
            $(selector).toggle();
        },

        onClickSearchImage: function (e) {
            e.preventDefault();

            ui.toggle('#searchForm');
        },
    };

    $.extend(window.ui, baseUi);
    ui.init();

}(jQuery, window, ui || (ui = {})));

(function ($) {
    ui.popup = (function () {

        function popup(options) {
            var that = this;
            this._template = '<div class="modal-content">' +
                '<div class="modal-title"><span class="close">&times;</span></div>' +
                '<div class="modal-body">{0}</div>' +
                '</div>';

            this._model = $.extend({
                id: 'popup',
                footerText: null,
                content: null,
                title: null,
                width: 400,
            }, options);

        }

        popup.prototype.init = function () {
            var e = document.createElement('div');
            e.className = "my-modal";
            e.innerHTML = this._template.format('tet');
            document.body.appendChild(e);

        }

        return popup;
    }());
}(jQuery));