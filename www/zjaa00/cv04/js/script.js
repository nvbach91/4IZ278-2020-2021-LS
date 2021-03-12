(function($) {

  $('input[type=checkbox]').removeAttr('checked');

  $("input[type='checkbox']").on("click", function() {
    var x = $(this).prev("input.form-control");

    if (x.attr("type") === "password") {
      x.attr("type", "text");
    } else {
      x.attr("type", "password");
    }
  })

}(jQuery));