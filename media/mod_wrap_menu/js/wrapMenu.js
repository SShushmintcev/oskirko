!(function ($) {
    function wrapMenu() {
        this.model = {
            selectorPreview: "preview",
            selectorMenu: "wrapMenu"
        }

        this.popup = null;
    }

    wrapMenu.prototype.init = function () {
        var that = this;
        $("#" + that.model.selectorMenu + ">li").hover(that.fnHover.bind(that), that.fnOut.bind(that));
    };

    wrapMenu.prototype.fnHover = function (e) {
        var that = this;
        var target = e.currentTarget;

        var preview = null;
        for(var i = 0; i < target.children.length; i++){
            var child = target.children[i];
            if (child.className === that.model.selectorPreview){
                preview = child;
            }
        }

        if (preview !== null) {
            var parentPosition = $(target.parentElement.parentElement).offset();
            var targetPosition = $(target).offset();

            var options = {
                target: target,
                top: targetPosition.top - parentPosition.top - 10,
                size: target.offsetWidth + 10,
                content: preview.innerHTML
            };

            that.popup = new ui.popup(options);
            that.popup.show();
        }
    };

    wrapMenu.prototype.fnOut = function () {
        var that = this;

        if (that.popup !== null) {
            that.popup.close();

            that.popup = null;
        }
    };

    ui.view.WrapMenu = wrapMenu;
}(jQuery));

jQuery(document).ready(function() {
    var view = new ui.view.WrapMenu();
    view.init();
});