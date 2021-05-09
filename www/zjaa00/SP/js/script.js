$(function () {
  //refresh page
  filter_data();

  /**FILTER - functionality.
   * Temporarily disables search bar, shows loading spinner with delay and sends AJAX request
   * on refresh or filter request by user
  */
  function filter_data() {
   
    //disable search bar when loading
    $("nav .search_input").prop("disabled", true);
   
    var spinnerDelay = 1000;
    setTimeout(function () {
      if ($("#drinks_box").children().length === 0 && $("#spinner").length === 0) {
        if (!$("#drinks_box").is(":visible")) {
          $("#drinks_box").fadeIn();
        }

        $("#drinks_box").html(
          '<div id="spinner" style="background-image: url(&apos;img/spinner.svg&apos;)"></div>'
        );
        
        $("#spinner").hide().fadeIn(500);
        
      }
    }, spinnerDelay);

    //data to be sent
    var action = "fetch_data",
        price = $("#price input[name=price]:checked").val(),
        alcoholic = $("#alco input[name=alco]:checked").val(),
        deadly = $("input[name=deadly]:checked").val(),
        inflammatory = $("input[name=inflammatory]:checked").val(),
        shuffle = $("#random").val();

    //database request
    $.ajax({
      url: "./partials/fetch_data.php",
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
        $("nav .search_input").prop("disabled", false);

        //fade-in animation after data is loaded
        var speed = 500;
        $("#drinks_box")
          .html(data)
          .hide()
          .stop()
          .fadeIn(speed);
        
      },
    });
  }

  //SEARCH BAR
  //functionality
  $("nav .search_input").keyup(function () {
    var filter = $("nav .search_input")
          .val()
          .toUpperCase() //search is not case-sensitive
          .normalize("NFD").replace(/[\u0300-\u036f]|\s/g, ""), //search doesn't follow diacritics
        li = $("#drinks_box .card");
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

    var results = $("#drinks_box .card:visible"), //number of search results
        noMatch = "Žiadne výsledky"; //"NO MATCH" message

    if (results.length == 0 && $("#drinks_box > h3").length == 0) { //if there are 0 results and "NO MATCH" header is not present
      $("<h3>"+ noMatch +"</h3>").appendTo("#drinks_box"); //create "NO MATCH" message
    } else if (results.length > 0 && $("#drinks_box > h3").length) { //if there are any results and "NO MATCH" header is stil present
      $("#drinks_box h3").remove(); //remove "NO MATCH" message
    }
  });

  //clear icon
  var clearIcon = $("nav .clear_icon"),
      searchBar = $("nav .search_input");

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
  $("#filter_slider div").css("opacity", 0);

  function goDown(object, content, slideSpeed, optionsFadeSpeed) {
    var slider = $(object),
        options = $(object + " " + content);

    if (options.css("opacity") == 0) {
      $("nav").stop().animate(
        {
          borderBottomLeftRadius: 0,
          borderBottomRightRadius: 0,
        },
        100,
        function () {
          slider.slideDown(slideSpeed, function () {
            options.animate({ opacity: "1" }, optionsFadeSpeed);
          });
        }
      );
    }
  }

  function goUp(object, content, slideSpeed, optionsFadeSpeed, callback) {
    var slider = $(object),
        options = $(object + " " + content);

    if (options.css("opacity") == 1) {
      options.animate({ opacity: "0" }, optionsFadeSpeed, function () {
        slider.slideUp(slideSpeed, function () {
          $("nav").stop().animate(
            {
              borderBottomLeftRadius: "20px",
              borderBottomRightRadius: "20px",
            },
            100
          );

          if (typeof callback === 'function') { 
            callback(); 
          }
        });
      });
    }

  }

  //filter - slide-down/-up animation
  $('.logo').on("click", function() {
    //slide-down
    goUp("#menu_slider", "div", 300, 200, function() {
      goDown("#filter_slider", "div", 300, 200);
    });
    if ($("#menu_slider div").css("opacity") == 0 || $("#menu_slider").length == 0) {
      goDown("#filter_slider", "div", 300, 200);
    }
    
    //slide-up
    goUp("#filter_slider", "div", 300, 200);
  });

  //OK button
  $("#ok").on("click", function (e) {
    e.preventDefault();
    $("#drinks_box").hide().empty();
    filter_data();
    $("nav .search_input").val("");
  });

  //SHUFFLE button
  $("#shuffle").on("click", function (e) {
    e.preventDefault();
    $("#random").val(1);
    $("#drinks_box").hide().empty();
    filter_data();
    $("#random").val("");
  });

  //FILTER - RADIO INPUTS - options' select, values & animation
  $("#filter_slider div a:not([id])").on("click", function (e) {
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


  /* ORDER */
  sumUpdate();

  function sendOrder(path, callback) {
    var order = {};
    $("#menu_slider .my_order .order_item").each(function() {
      var drink_id = Number($(this).find("option:selected").val()),
          drink_name = $(this).find("option:selected").text(),
          drink_amount = Number($(this).find(".amount").html()),
          drink_price = Number($(this).find(".drink_price").html()).toFixed(2),
          drink_sum = Number($(this).find(".drink_sum").html()).toFixed(2);
      if (drink_id) {
        order[drink_id] = {
          name: drink_name,
          amount: drink_amount,
          price: drink_price,
          sum: drink_sum
        };
      }
    });

    console.log("ellou");
    $.ajax({
      url: path,
      method: "POST",
      data: {order: order},
      success: function() {
        if (typeof callback === 'function') { 
          callback(); 
        }
      }
    });
  };

  $("#menu_slider div").css("opacity", 0);
  $('#menu').on("click", function(e) {
    e.preventDefault();
    //slide-down
    goUp("#filter_slider", "div", 300, 200, function() {
      goDown("#menu_slider", "div", 300, 200);
    });
    if ($("#filter_slider div").css("opacity") == 0) {
      goDown("#menu_slider", "div", 300, 200);
    }

    //slide-up
    goUp("#menu_slider", "div", 300, 200);

  });

  function addItem(id) {
    var item = $("#blank_item .order_item").clone();
    if (id) {
      var checkIfExists = $(".order_item option[value='" + id + "']").is(':selected');
      if (checkIfExists) {
        item = $(".order_item option[value='" + id + "']:selected").closest(".order_item");
        newAmount = Number(item.find(".amount").html()) + 1;
        item.find(".amount").html(newAmount);

      } else {
        item.find("select").val(id);
        $("#menu_slider .my_order").append(item);

      }
    } else {
      $("#menu_slider .my_order").append(item);
    }

    itemUpdate(item);

    sumUpdate();
    sendOrder("_inc/order_session.php");
  }
  
  $("#add").on("click", function(e) {
    e.preventDefault();
    addItem();
  });

  $("#menu_slider .my_order").on("click", ".delete_button", function(e) {
    e.preventDefault();

    var item = $(this).closest(".order_item");
    item.addBack().remove();

    itemUpdate(item)

    sumUpdate();
    sendOrder("_inc/order_session.php");
  });

  function sumUpdate() {
    var sum = 0.00;
    $('#menu_slider .my_order .drink_sum').each(function() {
        sum += Number($(this).html());
    });
    if (!sum) {
      $("#menu_slider .order_sum").html("0.00");
    } else {
      $("#menu_slider .order_sum").html(sum.toFixed(2));
    }
  }

  function itemUpdate(item) {
    var id = item.find("select").val(),
        drinkId = "#drink-" + id,
        price = $(drinkId).find(".price_tag span").html(),
        amount = Number(item.find(".amount").html()),
        drink_sum = (amount * price);
        
    item.find(".drink_price").html(price);

    if (drink_sum) {
      item.find(".drink_sum").html(drink_sum.toFixed(2));
      $(drinkId).find(".add div:visible").html(amount);
    } else {
      item.find(".drink_sum").html("0.00");
    }
    
    $("#drinks_box .card").has(".add div:visible").each(function() {
      var id = $(this).attr("id").replace('drink-', ''),
          isInOrder = $("#menu_slider .order_item option[value=" + id + "]:selected");
      
      if(isInOrder.length == 0) {
        $(this).find(".add div").fadeOut(200);
      }
    });

    var tag = $(drinkId).find(".add div:hidden");
    tag.html("1");
    tag.fadeIn(200);

    sumUpdate();
  }

  $("#menu_slider .my_order").on("change", "select", function() {
    item = $(this).closest(".order_item");
    itemUpdate(item);
  
    sumUpdate();
    sendOrder("_inc/order_session.php");
  });

  $("#menu_slider .my_order").on("click", "button", function(e) {
    e.preventDefault();
    var item = $(this).closest(".order_item"),
        button = $(this).attr("class"),
        amount = $(this).closest(".order_item").find(".amount"),
        value = Number(amount.html()),
        min = 1,
        max = 99;
    if (button == "plus_button" && amount.html() != max) {
      newAmount = value + 1;
      amount.html(newAmount);

      itemUpdate(item);
      sumUpdate();
      sendOrder("_inc/order_session.php");
    } else if (button == "minus_button" && amount.html() != min) {
      newAmount = value - 1;
      amount.html(newAmount);

      itemUpdate(item);
      sumUpdate();
      sendOrder("_inc/order_session.php");
    }
  });

  $("#make_order").on("click", function(e) {
    e.preventDefault();

    sendOrder("_inc/add_to_order.php", function() {
      $("#menu_slider .my_order").empty();
      
      $("#drinks_box .card .add div:visible").each(function() {
        $(this).html("").fadeOut(200);
      });
      sumUpdate();
      sendOrder("_inc/order_session.php");
    });
  });

  $("#drinks_box").on("click", ".add", function() {
    var id = $(this).closest(".card").attr("id").replace('drink-', '');

    addItem(id);
  });

  var box = $("#orders_box"),
      spinner = $('<div id="spinner" style="background-image: url(&apos;img/spinner.svg&apos;)"></div>'),
      limit = 10,
      offset = $("#orders_box .order_card").length,
      areItemsLeft = 1;

  $(document).scroll(function() {
    if ($(document).scrollTop() == $(document).height() - $(window).height() && areItemsLeft != 0 && offset) {

        spinnerClone = spinner.clone();
        box.append(spinner);

      var request = $.ajax({
        url: "./_inc/load_orders.php",
        method: "POST",
        data: {offset: offset, limit: limit}
      });
      request.done(function(data) {
        var items = $(data).find(".order_card");
        numberOfItems = items.length;

        if (numberOfItems == limit) {
          box.append(items);
        } else if(numberOfItems < limit) {
          box.append(items);
          areItemsLeft = 0;
        }
        
        offset = offset + limit;
      });
      request.fail(function() {
        alert("Server error");
      });
      request.always(function() {
        $('#spinner').remove();
        console.log(areItemsLeft);
      });
    }
  });

  $('#show_password input').removeAttr('checked');
  $(".password[type='text']").attr("type", "password");
  $("#show_password").on("click", function() {
    var x = $(this).prev("input");

    if (x.attr("type") === "password") {
      x.attr("type", "text");
    } else {
      x.attr("type", "password");
    }
  })

});