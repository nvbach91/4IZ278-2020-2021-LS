$(function () {
  //refresh page
  filter_data();

  /**FILTER - functionality.
   * Temporarily disables search bar, shows loading spinner with delay and sends AJAX request
   * on refresh or filter request by user
  */
  function filter_data() {
    
    //disable search bar when loading
    $("#search").prop("disabled", true);

    //spinner delay
    var delay = 1000;
    setTimeout(function () {
      if ($("#box").children().length === 0 && $("#spinner").length === 0) {
        if (!$("#box").is(":visible")) {
          $("#box").fadeIn();
        }

        $("#box").html(
          '<div id="spinner" style="background-image: url(&apos;img/spinner.svg&apos;)"></div>'
        );
        
        $("#spinner").hide().fadeIn(500);
        
      }
    }, delay);

    //data to be sent
    var action = "fetch_data",
        price = $("#price input[name=price]:checked").val(),
        alcoholic = $("#alco input[name=alco]:checked").val(),
        deadly = $("input[name=deadly]:checked").val(),
        inflammatory = $("input[name=inflammatory]:checked").val(),
        shuffle = $("#random").val();

    //database request
    $.ajax({
      url: "_inc/fetch_data.php",
      method: "POST",
      data: {
        action: action,
        price: price,
        alcoholic: alcoholic,
        deadly: deadly,
        inflammatory: inflammatory,
        shuffle: shuffle,
      },

      success: function (data) {
        
        //enable search bar after data is loaded
        $("#search").prop("disabled", false);

        //fade-in animation after data is loaded
        var speed = 500;
        $("#box")
          .html(data)
          .hide()
          .stop()
          .fadeIn(speed);
        
      },
    });
  }

  //SEARCH BAR
  //functionality
  $("#search").keyup(function () {
    var filter = $("#search")
          .val()
          .toUpperCase() //search is not case-sensitive
          .normalize("NFD").replace(/[\u0300-\u036f]|\s/g, ""), //search doesn't follow diacritics
        li = $("#box .card");
    li.each(function () { //match check
      var txtValue = $(this).find(".content h2").text();

      if (
        txtValue
          .toUpperCase()
          .normalize("NFD").replace(/[\u0300-\u036f]|\s/g, "")
          .indexOf(filter) > -1
      ) {
        $(this).show(); //if matches => show/leave visible
      } else {
        $(this).hide(); //if doesn't match => hide
      }
    });

    var results = $("#box .card:visible"), //number of search results
        noMatch = "Žiadne výsledky"; //"NO MATCH" message

    if (results.length == 0 && $("#box > h3").length == 0) { //if there are 0 results and "NO MATCH" header is not present
      $("<h3>"+ noMatch +"</h3>").appendTo("#box"); //create "NO MATCH" message
    } else if (results.length > 0 && $("#box > h3").length) { //if there are any results and "NO MATCH" header is stil present
      $("#box h3").remove(); //remove "NO MATCH" message
    }
  });

  //clear icon
  var clearIcon = $("#clear-icon"),
      searchBar = $("#search");

  //show clear icon when search bar input is not empty and hide it if it is
  searchBar.on("keyup", function () {
    if (searchBar.val() && !clearIcon.is(":visible")) {
      clearIcon.fadeIn(500);
    } else if (!searchBar.val()) {
      clearIcon.fadeOut(500);
    }
  });
  
  //refresh data, clear out search bar input and hide clear icon on clicking at the clear icon
  clearIcon.on("click", function () {
    filter_data();
    searchBar.val("");
    clearIcon.fadeOut(500);
  });

  //FILTER SLIDER
  //filter - options' initial opacity 
  $("#filter div").css("opacity", 0);

  function slideDown(object, content, slideSpeed, optionsFadeSpeed) {
    var slider = $(object),
        options = $(object + " " + content),
        slideSp = slideSpeed, //slide animation speed
        optionsFadeSp = optionsFadeSpeed; //text fade-in/-out speed;

    if (options.css("opacity") == 0) {
      $("nav").animate(
        {
          borderBottomLeftRadius: 0,
          borderBottomRightRadius: 0,
        },
        100,
        function () {
          slider.slideDown(slideSp, function () {
            options.animate({ opacity: "1" }, optionsFadeSp);
          });
        }
      );
    }
  }

  function slideUp(object, content, slideSpeed, optionsFadeSpeed) {
    var slider = $(object),
        options = $(object + " " + content),
        slideSp = slideSpeed, //slide animation speed
        optionsFadeSp = optionsFadeSpeed; //text fade-in/-out speed;

    if (options.css("opacity") == 1) {
      options.animate({ opacity: "0" }, optionsFadeSp, function () {
        slider.slideUp(slideSp, function () {
          $("nav").animate(
            {
              borderBottomLeftRadius: "20px",
              borderBottomRightRadius: "20px",
            },
            100
          );
        });
      });
    }
  }

  //filter - slide-down/-up animation
  $('.logo').on("click", function() {
    //slide-down
    slideDown("#filter", "div", 300, 200);

    //slide-up
    slideUp("#filter", "div", 300, 200);
  });

  //OK button
  $("#ok").on("click", function (e) {
    e.preventDefault();
    $("#box").hide().empty();
    filter_data();
    $("#search").val("");
  });

  //SHUFFLE button
  $("#shuffle").on("click", function (e) {
    e.preventDefault();
    $("#random").val(1);
    $("#box").hide().empty();
    filter_data();
    $("#random").val("");
  });

  //FILTER - RADIO INPUTS - options' select, values & animation
  $("#filter div a:not([id])").on("click", function (e) {
    e.preventDefault();
    var a = $(this),
      cl = a.attr("class").split(" ")[0],
      input = $("input:radio[name=" + cl + '][value="' + a.data(cl) + '"]');

    if (a.hasClass("selected")) {
      input.prop("checked", false);
      a.removeClass("selected");
    } else {
      input.prop("checked", true);
      a.addClass("selected")
       .siblings().removeClass("selected");
    }
  });

  //FILTER - CHECKBOX INPUTS - options' select, values & animation
  $("#checkbox > a").on("click", function (e) {
    e.preventDefault();
    var a = $(this),
      id = a.attr("id"),
      input = $("input[name=" + id + "]");

    if (a.hasClass("selected")) {
      input.prop("checked", false);
      a.removeClass("selected");
    } else {
      input.prop("checked", true);
      a.addClass("selected");
    }
  });

});
