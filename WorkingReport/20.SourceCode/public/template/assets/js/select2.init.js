! function(a) {
    "use strict";
    var t = function() {};
    t.prototype.init = function() {
        a(".select2").select2(), a(".select2-limiting").select2({
            maximumSelectionLength: 2
        })
    }, a.AdvancedForm = new t, a.AdvancedForm.Constructor = t
}(window.jQuery),
    function(a) {
        "use strict";
        a.AdvancedForm.init()
    }(window.jQuery);