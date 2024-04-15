$(document).ready(function () {
    $(".standings-driver").click(function () {
      var info = $(this).next(".standings-driver-info");
      info.slideToggle(function () {
        if ($(this).is(":hidden")) {
          $(this)
            .prev(".standings-driver")
            .css("border-bottom-left-radius", "15px");
          $(this)
            .prev(".standings-driver")
            .css("border-bottom-right-radius", "15px");
        } else {
          $(this)
            .prev(".standings-driver")
            .css("border-bottom-left-radius", "0px");
          $(this)
            .prev(".standings-driver")
            .css("border-bottom-right-radius", "0px");
        }
      });
    });
  });