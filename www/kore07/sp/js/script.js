//open-close contact popup

var contactButton = document.querySelector(".contacts-button");
var contactPopup = document.querySelector(".contact-popup");
var contactCloseButton = contactPopup.querySelector(".close-button");
var submitButton = contactPopup.querySelector(".popup-button");

var contactInputContainers = contactPopup.querySelectorAll(".popup-input");
var inputContactName = contactInputContainers[0].querySelector("[name=name]");
var inputContactEmail = contactInputContainers[1].querySelector("[name=email]");

var isStorageSupport = true;
var storage = "";

try {
  storage = localStorage.getItem("inputName");
} catch (err) {
  isStorageSupport = false;
}

contactButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  contactPopup.classList.remove("hidden");
  contactPopup.classList.add("popup-show");

  if (storage) {
    inputContactName.value = storage;
    inputContactEmail.focus();
  } else {
    inputContactName.focus();
  }
});

contactCloseButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  contactPopup.classList.add("hidden");
  contactPopup.classList.remove("popup-error");
});

contactPopup.addEventListener("submit", function (evt) {
  if (!inputContactName.value || !inputContactEmail.value) {
    evt.preventDefault();
    contactPopup.classList.remove("popup-error");
    contactPopup.offsetWidth = contactPopup.offsetWidth;
    contactPopup.classList.add("popup-error");
  }
  else {
    if (isStorageSupport) {
      localStorage.setItem("inputName", inputContactName.value);
    }
  }
});

window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (!contactPopup.classList.contains("hidden")) {
      contactPopup.classList.add("hidden");
      contactPopup.classList.remove("popup-error");
    }
  }
});

//open-close signin popup

var signInButton = document.querySelector(".login-link");
var signInPopup = document.querySelector(".signin-popup");
var signInCloseButton = signInPopup.querySelector(".close-button");
var submitButton = signInPopup.querySelector(".popup-button");

var inputSigninContainers = signInPopup.querySelectorAll(".popup-input");
var inputSigninEmail = inputSigninContainers[0].querySelector("[name=email]");
var inputSigninPassword = inputSigninContainers[1].querySelector("[name=password]");

var isStorageSupport = true;
var storage = "";

try {
  storage = localStorage.getItem("inputEmail");
} catch (err) {
  isStorageSupport = false;
}

signInButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  signInPopup.classList.remove("hidden");
  signInPopup.classList.add("popup-show");

  if (storage) {
    inputSigninEmail.value = storage;
    inputSigninPassword.focus();
  } else {
    inputSigninEmail.focus();
  }
});

signInCloseButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  signInPopup.classList.add("hidden");
  signInPopup.classList.remove("popup-error");
});

signInPopup.addEventListener("submit", function (evt) {
  if (!inputSigninEmail.value || !inputSigninPassword.value) {
    evt.preventDefault();
    signInPopup.classList.remove("popup-error");
    signInPopup.offsetWidth = signInPopup.offsetWidth;
    signInPopup.classList.add("popup-error");
  }
  else {
    if (isStorageSupport) {
      localStorage.setItem("inputEmail", inputSigninEmail.value);
    }
  }
});

window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (!signInPopup.classList.contains("hidden")) {
      signInPopup.classList.add("hidden");
      signInPopup.classList.remove("popup-error");
    }
  }
});


//open-close sign-up popup

var signUpButton = document.querySelector(".signup-link");
var signUpPopup = document.querySelector(".signup-popup");
var signUpCloseButton = signUpPopup.querySelector(".close-button");
var submitButton = signUpPopup.querySelector(".popup-button");

var inputSignupContainers = signUpPopup.querySelectorAll(".popup-input");
var inputSignupEmail = inputSignupContainers[1].querySelector("[name=email]");
var inputSignupPassword = inputSignupContainers[2].querySelector("[name=password]");

signUpButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  signUpPopup.classList.remove("hidden");
  signUpPopup.classList.add("popup-show");
  signInPopup.classList.add("hidden");
});

signUpCloseButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  signUpPopup.classList.add("hidden");
  signUpPopup.classList.remove("popup-error");
});

signUpPopup.addEventListener("submit", function (evt) {
  if (!inputSignupEmail.value || !inputSignupPassword.value) {
    evt.preventDefault();
    signUpPopup.classList.remove("popup-error");
    signUpPopup.offsetWidth = signUpPopup.offsetWidth;
    signUpPopup.classList.add("popup-error");
  }
  else {
    if (isStorageSupport) {
      localStorage.setItem("inputEmail", inputSignupEmail.value);
    }
  }
});

window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (!signUpPopup.classList.contains("hidden")) {
      signUpPopup.classList.add("hidden");
      signUpPopup.classList.remove("popup-error");
    }
  }
});


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
