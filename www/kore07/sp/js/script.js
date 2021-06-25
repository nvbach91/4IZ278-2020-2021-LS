//open-close map-popup

var map = document.querySelector(".map");
var mapPopup = document.querySelector(".map-popup");
var mapCloseButton = mapPopup.querySelector(".close-button");

map.addEventListener("click", function (evt) {
  evt.preventDefault();
  mapPopup.classList.remove("hidden");
});

mapCloseButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  mapPopup.classList.add("hidden");
});

window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (!mapPopup.classList.contains("hidden")) {
      mapPopup.classList.add("hidden");
    }
  }
});

// services

var servicesList = document.querySelector(".service-list");
var servicesItem = servicesList.querySelectorAll(".service-item");
var services = document.querySelectorAll(".service-description-item");

servicesList.addEventListener("click", function(evt) {
  evt.preventDefault();
  var target = evt.target;
  if (target.classList.contains("service-item-link")) {
    var targetParent = target.parentElement;
    for (i = 0; i < services.length; i++) {
      services[i].classList.remove("service-description-show");
      servicesItem[i].classList.remove("current-service-item");
    }
    var className = "." + target.id;
    document.querySelector(className).classList.add("service-description-show");
    targetParent.classList.add("current-service-item");
  }
});
