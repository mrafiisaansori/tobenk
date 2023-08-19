!function(i) {
  "use strict";
  function e() {}
  e.prototype.init = function() {
      i(".tc").TouchSpin({
          initval: 40,
          buttondown_class: "btn btn-primary",
          buttonup_class: "btn btn-primary"
      })
  }
  ,
  i.AdvancedForm = new e,
  i.AdvancedForm.Constructor = e
}(window.jQuery),
function() {
  "use strict";
  window.jQuery.AdvancedForm.init()
}();
