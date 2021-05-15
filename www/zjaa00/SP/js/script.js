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
    var action = "load_drinks",
        price = $("#price input[name=price]:checked").val(),
        alcoholic = $("#alco input[name=alco]:checked").val(),
        deadly = $("input[name=deadly]:checked").val(),
        inflammatory = $("input[name=inflammatory]:checked").val(),
        shuffle = $("#random").val();

    //database request
    $.ajax({
      url: "./partials/homepage/load_drinks.php",
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

  //slider dole
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
  //slider hore
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

  //pri načítaní zrátať drinky v objednávke, pridané cez SESSION
  sumUpdate();
  
  //opacita na nulu pre všetky div elementy v menu slideri
  $("#menu_slider div").css("opacity", 0);


  //vytvorenie arrayu z objednávky a poslanie ho cez AJAX request na istú adresu
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

  //časť funkcie itemUpdate(), ktorá aktualizuje celkový súčet cien v objednávke
  function sumUpdate() {
    var sum = 0.00,
        orderItems = Boolean($("#menu_slider .my_order .order_item").length);

    //zrátame ceny všetkých drinkov násobené počtom ich kusov (trieda drink_sum)
    $('#menu_slider .my_order .drink_sum').each(function() {
        sum += Number($(this).html());
    });

    //pokiaľ v objednávke nie sú žiadne drinky, tak nastavíme sumu na 0.00 - ak áno, tak zaokrúhľujeme na 2 desatinné miesta
    if (!sum) {
      $("#menu_slider .order_sum").html("0.00");
    } else {
      $("#menu_slider .order_sum").html(sum.toFixed(2));
    }

    //pokiaľ je  počet drinkov v objednávke 0, tak znefunkčníme tlačidlo "Objednané" - ak nie tak ho sfunkčníme
    if (!orderItems) {
      $("#make_order").addClass("disabled");
    } else if($("#make_order.disabled.unselectable")) {
      $("#make_order").removeClass("disabled");
    }
  }

  //funkcia, ktorá má nastarosť celkovú aktualizáciu objednávky, po zmene údajov nejakého drinku a prenesenie množstva na tag karty drinku - atribút je položka .order_item
  function itemUpdate(item) {
    var id = item.find("select").val(),
        drinkCardId = "#drink-" + id,
        price = $(drinkCardId).find(".price_tag span").html(),
        amount = Number(item.find(".amount").html()),
        drink_sum = (amount * price);
    
    //aktualizujeme údaj o cene drinku v menu slideri
    item.find(".drink_price").html(price);

    //ak je súčet ceny za isté drinky nenulový, tak ho zaokrúhlime a aktualizujeme počet drinkov na kartičke
    //- ak nie tak len nastavíme daný súčet na 0.00
    if (drink_sum) {
      item.find(".drink_sum").html(drink_sum.toFixed(2));
      $(drinkCardId).find(".add div:visible").html(amount);
    } else {
      item.find(".drink_sum").html("0.00");
    }
    
    //vyberieme všetky karty s drinkami, čo majú tag s počtom daných drinkov v objednávke
    //a pokiaľ sa už drink s ich ID v objednávke nenachádza, tak tento tag schováme
    $("#drinks_box .card").has(".add div:visible").each(function() {
      var id = $(this).attr("id").replace('drink-', ''),
          isInOrder = $("#menu_slider .order_item option[value=" + id + "]:selected");
      
      if(isInOrder.length == 0) {
        $(this).find(".add div").fadeOut(200);
      }
    });

    //pokiaľ mal drink svoj tag skrytý, tak ho zviditeľníme a nastavíme na hodnotu 1
    var tag = $(drinkCardId).find(".add div:hidden");
    tag.html("1");
    tag.fadeIn(200);

    //aktualizujeme výpočty
    sumUpdate();
    //aktualizujeme SESSION
    sendOrder("_inc/user/order_session.php");
  }

  //funkcia pridávajúca drink do objednávky podľa ID - keď nie je ID k zadané, tak sa pridá prázdna položka
  function addItem(id) {
    //kópia prázdnej položky
    var item = $("#blank_item .order_item").clone();
    if (id) {
      //pokiaľ už položka v objednávke je, tak jej iba zväčšíme počet ks - ak nie, tak ju do objednávky pridáme s 1ks
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

    //aktualizujeme výpočty objednávky a kartičky drinkov
    itemUpdate(item);
  }

  //toggle menu slideru po kliknutí na menu ikonku
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
  
  //pridanie prázdnej položky do objednávky
  $("#add").on("click", function(e) {
    e.preventDefault();
    addItem();
  });

  //vymazanie položky z objednávky
  $("#menu_slider .my_order").on("click", ".delete_button", function(e) {
    e.preventDefault();

    //vrátane delete_buttonu
    var item = $(this).closest(".order_item");
    item.addBack().remove();

    itemUpdate(item)
  });

  //pri zmene drinku cez select sa objednávka aktualizuje
  $("#menu_slider .my_order").on("change", "select", function() {
    item = $(this).closest(".order_item");
    itemUpdate(item);
  });

  //pri stlačení jedného z buttonov (plus_button a minus_button) zväčšíme/zmenšíme množstvo
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
    } else if (button == "minus_button" && amount.html() != min) {
      newAmount = value - 1;
      amount.html(newAmount);
    }
    
    itemUpdate(item);
  });

  //po stlačení tlačidla "Objednané"
  $("#make_order").on("click", function(e) {
    e.preventDefault();
    var orderItems = Boolean($("#menu_slider .my_order .order_item").length);

    if (orderItems) {
      //odošle sa objednávka
      sendOrder("_inc/user/add_to_order.php", function() {
        //vyprázdni sa objednávka v menu slideri
        $("#menu_slider .my_order").empty();
        
        //zmiznú tagy s počtom drinkov v objednávke na kartičkách drinkov
        $("#drinks_box .card .add div:visible").each(function() {
          $(this).html("").fadeOut(200);
        });

        //tlačidlo "Zaplatené" sa sfunkční
        $("#pay.disabled").removeClass("disabled");
        //aktualizujú sa počty
        sumUpdate();
        //aktualizuje sa SESSION
        sendOrder("_inc/user/order_session.php");
      });
    }
  });

  //po kliknutí na kartičku drinku sa zväčší počet ks tu aj v objednávke v menu slideri
  $("#drinks_box").on("click", ".add", function() {
    var id = $(this).closest(".card").attr("id").replace('drink-', '');

    addItem(id);
  });

  //OBJEDNÁVKY
  var box = $("#orders_box"),
      spinner = $('<div id="spinner" style="background-image: url(&apos;img/spinner.svg&apos;)"></div>'),
      limit = 10,
      offset = $("#orders_box .order_card").length,
      areItemsLeft = 1;

  //pokiaľ zoskrolujeme úplne dole, nie sú ešte načítané všetky objednávky a počet objednávok nie je 0 tak sa načítajú ďalšie objednávky z databáze
  $(document).scroll(function() {
    if ($(document).scrollTop() == $(document).height() - $(window).height() && areItemsLeft != 0 && offset) {

      //zobraz spinner
      spinnerClone = spinner.clone();
      box.append(spinner);

      var request = $.ajax({
        url: "./_inc/user/load_orders.php",
        method: "POST",
        data: {offset: offset, limit: limit}
      });
      request.done(function(data) {
        var items = $(data).find(".order_card");
        numberOfItemsLeft = items.length;

        //pokiaľ je už počet objednávok menší ako limit (sú posledné na načítanie), tak nastavíme premennú areItemsLeft na 0 a akcia sa už nebude opakovať
        if (numberOfItemsLeft == limit) {
          box.append(items);
        } else if(numberOfItemsLeft < limit) {
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
      });
    }
  });

  //LOGIN/SIGNUP
  //schovať/zobraziť heslo pri písaní
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