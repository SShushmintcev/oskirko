var ui;

!(function ($, window, ui) {
    "use strict";

    String.prototype.format = function () {
        var formatted = this;
        for (var arg in arguments) {
            formatted = formatted.replace("{" + arg + "}", arguments[arg]);
        }
        return formatted;
    };

    var baseUi = {
        view: {},

        base: '',
        baseUrl: '',
        imgPath: '',

        ymapsContacts: [],

        init: function () {
            $(function () {
                $("#searchButton").on('click', ui.onClickSearchImage);
                document.addEventListener('click', ui.onListenerDocument);

                $(".photo-grey-change").on('hover', function (e) {
                    var target = e.target;
                    var file = target.src.split('/').pop().split('?')[0];

                    if (file) {
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

                        if (newFileName !== "" && newFileName !== undefined && newFileName !== null) {
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
                that._template.style.top = that.options.top + "px";
                that._template.style.minHeight = "160px";
                that._template.style.width = that.options.width + "px";
                that._template.style.left = that.options.size + "px";
                that._template.style.display = "block";

                that._parent.appendChild(that._template);
            }
        };

        popup.prototype.close = function () {
            if (this._template !== null) {
                var popup = this._parent.getElementById("customPopup");

                if (popup) {
                    popup.remove();
                }

                this._template = null;
            }
        };

        popup.prototype._createTemplate = function () {
            var that = this;

            var contTemplate = document.createElement('div');
            contTemplate.id = "customPopup"
            contTemplate.className = "modal-popup-cont";

            var template = document.createElement('div');
            template.className = "modal-popup";

            var checkDiv = document.createElement('div');
            checkDiv.className = "modal-popup-check";

            template.appendChild(checkDiv);

            if (that.options.title !== null && that.options.title !== "") {
                var title = document.createElement('div');
                title.className = "modal-popup-title";
                title.innerHTML = "<span>{0}</span>".format(that.options.title);

                template.appendChild(title);
            }

            var body = document.createElement('div');
            body.className = "modal-popup-content";
            body.innerHTML = that.options.content;

            template.appendChild(body);
            contTemplate.appendChild(template);

            this._template = contTemplate;
        };

        return popup;
    }());
}(jQuery));

!(function ($) {

    function map(ymapsContacts) {
        this.ymapsContacts = ymapsContacts || [];
        this.balloonTemplates = [];
    }

    map.prototype.init = function () {
        ymaps.ready(this._load.bind(this));
    };

    map.prototype._load = function () {
        var that = this;

        if (that.ymapsContacts.length > 0) {
            this._createBalloonTemplates();
        }

        if (this.balloonTemplates.length === 0) {
            throw new Error('Not found coordinates for yMap');
        }

        var myMap = new ymaps.Map("map", {
            center: [59.94783014, 30.35691551],
            zoom: 15,
            behaviors: ['default', 'scrollZoom']
        }, {
            searchControlProvider: 'yandex#search'
        });

        myMap.controls.remove('trafficControl');
        myMap.controls.remove('typeSelector');
        myMap.controls.remove('searchControl');

        for (var i = 0; i < this.balloonTemplates.length ; i++){
            myMap.geoObjects.add(this.balloonTemplates[i]);
        }
    };

    map.prototype._createBalloonTemplates = function () {
        var that = this;

        var img = ui.baseUrl + ui.imgPath + 'ypoint.png';
        var squareLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="placemark_layout_container"><img src="' + img + '" /></div>');

        var balloonLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="balloon-style top">' +
            '<a class="close-balloon" href="#">&times;</a>' +
            '<div class="arrow"></div>' +
            '<div class="balloon-style-inner">' +
            '$[[options.contentLayout observeSize minWidth=150 maxWidth=180 maxHeight=240]]' +
            '</div>' +
            '</div>',
            {
                build: function () {
                    this.constructor.superclass.build.call(this);

                    this._$element = $('.balloon-style', this.getParentElement());

                    this.applyElementOffset();

                    this._$element.find('.close-balloon').on('click', $.proxy(this.onCloseClick, this));
                },
                clear: function () {
                    this._$element.find('.close-balloon').off('click');

                    this.constructor.superclass.clear.call(this);
                },
                onSublayoutSizeChange: function () {
                    balloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

                    if (!this._isElement(this._$element)) {
                        return;
                    }

                    this.applyElementOffset();

                    this.events.fire('shapechange');
                },
                applyElementOffset: function () {
                    this._$element.css({
                        left: -(this._$element[0].offsetWidth / 2) + 4,
                        top: -(this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight)
                    });
                },
                onCloseClick: function (e) {
                    e.preventDefault();

                    this.events.fire('userclose');
                },
                getShape: function () {
                    if (!this._isElement(this._$element)) {
                        return balloonLayout.superclass.getShape.call(this);
                    }

                    var position = this._$element.position();

                    return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                        [position.left, position.top], [
                            position.left + this._$element[0].offsetWidth,
                            position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
                        ]
                    ]));
                },
                _isElement: function (element) {
                    return element && element[0] && element.find('.arrow')[0];
                }
            });

        var balloonContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="balloon-style-content">$[properties.balloonContent]</div>'
        );

        for (var i = 0; i < this.ymapsContacts.length; i++) {
            var placemark = new ymaps.Placemark(this.ymapsContacts[i].coordinates,
                {
                    hintContent: this.ymapsContacts[i].pointToolTip,
                    balloonContent: '<div style="text-align: center;">' + this.ymapsContacts[i].city + ',<br />'
                    + this.ymapsContacts[i].street + ',<br />' + this.ymapsContacts[i].house + '<br /><br />' +
                    '<span style="' +
                    'font-family: Tahoma, Verdana, Segoe, sans-serif;' +
                    'font-weight: 500;line-height: 13.4px;' +
                    'font-size: 12px;letter-spacing: 0.08em;">' + this.ymapsContacts[i].work.days +
                    '</span> ' + this.ymapsContacts[i].work.time + '<br /><br />' +
                    '<div style="' +
                    'font-family: Tahoma, Verdana, Segoe, sans-serif;' +
                    'font-weight: 500;' +
                    'line-height: 14.4px;' +
                    'margin-bottom: 5px;' +
                    'margin-top: -3px;">' +
                    '<span style="font-size: 13px;">' + this.ymapsContacts[i].contact.zip + '</span>&nbsp;' +
                    '<span style="font-size: 18px;">' + this.ymapsContacts[i].contact.phone + '</span>' +
                    '</div>' +
                    '<a style="font-size: 13px;" class="mail" href="mailto:'
                    + this.ymapsContacts[i].contact.mail + '">' + this.ymapsContacts[i].contact.mail + '</a>' +
                    '</div>'
                },
                {
                    balloonShadow: false,
                    balloonLayout: balloonLayout,
                    balloonContentLayout: balloonContentLayout,
                    balloonPanelMaxMapArea: 0,
                    hideIconOnBalloonOpen: false,
                    iconImageHref: img,
                    iconLayout: squareLayout,
                    iconShape: {
                        type: 'Rectangle',
                        coordinates: [
                            [-25, -25], [25, 25]
                        ]
                    }
                }
            );

            that.balloonTemplates.push(placemark);
        }
    };

    ui.view.Map = map;

}(jQuery));