!(function ($) {
    var selectorMenu1 = "wrapMenu";

    function wrapMenu() {
        this.model = {
            selectorPreview: "preview",
            selectorMenu: "wrapMenu"
        }
    }

    wrapMenu.prototype.init = function () {
        var that = this;
        $("#" + that.model.selectorMenu + ">li").hover(that.fnHover.bind(that), that.fnOut.bind(that));
    };

    wrapMenu.prototype.fnHover = function (e) {
        // debugger;
        var that = this;
        var target = e.currentTarget;

        var preview = null;

        for(var i = 0; i < target.children.length; i++){
            var child = target.children[i];
            if (child.className === that.model.selectorPreview){
                preview = child;
                console.log('true preview');
            }
        }

        if (preview !== null) {
            var popup = new ui.popup();
            popup.init();
        }

    };

    wrapMenu.prototype.fnOut = function (e) {
        console.log('out');
    };

    ui.view.WrapMenu = wrapMenu;
}(jQuery));

jQuery(document).ready(function() {
    var view = new ui.view.WrapMenu();
    view.init();
});