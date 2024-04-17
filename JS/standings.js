$(document).ready(function () {
    $(".standings-driver").click(function () {
      var info = $(this).next(".standings-driver-info");
      info.slideToggle(function () {
        if ($(this).is(":hidden")) {
          $(this)
            .prev(".standings-driver")
            .css("border-bottom-left-radius", "5px");
          $(this)
            .prev(".standings-driver")
            .css("border-bottom-right-radius", "5px");
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

    $(".standings-teams").click(function () {
      var info = $(this).next(".standings-teams-info");
      info.slideToggle(function () {
        if ($(this).is(":hidden")) {
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-left-radius", "5px");
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-right-radius", "5px");
        } else {
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-left-radius", "0px");
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-right-radius", "0px");
        }
      });
    });
  });


  let DriverStan = document.getElementById("DriverStan").addEventListener("click", ()=>{
    let barDriverStan = document.getElementById("barDriverStan");
    let barConstStan = document.getElementById("barConstStan");

    let teams = document.querySelector(".standings-teams-container");
    let drivers = document.querySelector(".standings-drivers-container");


    barDriverStan.style.display="block";
    barConstStan.style.display="none";

    teams.style.display="none";
    drivers.style.display="block";
  });

  let ConstStan = document.getElementById("ConstStan").addEventListener("click", ()=>{
    let barDriverStan = document.getElementById("barDriverStan");
    let barConstStan = document.getElementById("barConstStan");

    let teams = document.querySelector(".standings-teams-container");
    let drivers = document.querySelector(".standings-drivers-container");

    barDriverStan.style.display="none";
    barConstStan.style.display="block";

    teams.style.display="block";
    drivers.style.display="none";
  });