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
                var that = this;
                $("#searchButton").on('click', ui.onClickSearchImage);
                document.addEventListener('click', ui.onListenerDocument);

                $(".photo-grey-change").on('hover', function (e) {
                    var target = e.target;

                    var file = target.src.split('/').pop().split('?')[0];

                    if (file){
                        var extPattern = /[^.]+$/;
                        var fileNamePattern = /(.*)\.(png|jpg|jpeg|gif)/;
                        var ext = extPattern.exec(file);
                        var fileName = fileNamePattern.exec(file);
                        var newFileName = '';

                        if (target.hasClass("color")) {
                            newFileName = fileName[1] + '-grey.' + ext;
                            target.removeClass("color");
                        } else {
                            newFileName = fileName[1].replace('-grey', '.') + ext;
                            target.addClass("color");
                        }

                        if (newFileName !== "" && newFileName !== undefined && newFileName !== null){
                            var url = target.src.replace(file, newFileName);
                            target.src = url;
                        }
                    }
                });
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
        }
    };

    $.extend(window.ui, baseUi);
    ui.init();

}(jQuery, window, ui || (ui = {})));

!(function ($) {
    ui.popup = (function () {
        function popup(options) {
            var that = this;

            that._parent = null;

            if (!options.target) {
                throw new Error('target not found');
            }

            this.options = $.extend({
                id: 'customPopup',
                target: null,
                content: null,
                title: null,
                width: 550,
                top: 0,
                size: 0
            }, options);

            that._parent = that.options.target.parentElement.tagName === "DIV"
                ? that.options.target.parentElement
                : that.options.target.parentElement.parentElement;

            if (that.options.top === 0 && that.options.size === 0) {
                // var parentPositon = $(that._parent).offset();
                that.options.top = that._parent.offsetTop + 10;
                that.options.size = that._parent.offsetWidth + 10;
            }

            this._createTemplate();
        }

        popup.prototype.show = function () {
            var that = this;
            if (that._parent !== null) {
                that._template.style.top = that.options.top+"px";
                that._template.style.minHeight = "160px";
                that._template.style.width = that.options.width+"px";
                that._template.style.left = that.options.size+"px";
                that._template.style.display = "block";

                that._parent.appendChild(that._template);
            }
        };

        popup.prototype.close = function () {
            if (this._template !== null) {
                var popup = this._parent.getElementById("customPopup");

                if (popup){
                    popup.remove();
                }

                this._template = null;
            }
        };
        
        popup.prototype._createTemplate = function () {
            var that = this;

            var contTemplate = document.createElement('div');
            contTemplate.id="customPopup"
            contTemplate.className="modal-popup-cont";

            var template = document.createElement('div');
            template.className="modal-popup";

            var checkDiv = document.createElement('div');
            checkDiv.className="modal-popup-check";

            template.appendChild(checkDiv);

            if (that.options.title !== null && that.options.title !== "") {
                var title = document.createElement('div');
                title.className="modal-popup-title";
                title.innerHTML= "<span>{0}</span>".format(that.options.title);

                template.appendChild(title);
            }

            var body = document.createElement('div');
            body.className="modal-popup-content";
            body.innerHTML = that.options.content;

            template.appendChild(body);
            contTemplate.appendChild(template);

            this._template = contTemplate;
        };

        return popup;
    }());
}(jQuery));