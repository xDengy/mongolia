var swiper = new Swiper(".product-page__photo-swiper--small", {
  spaceBetween: 6,
  slidesPerView: 4,
  direction: "vertical",
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".product-page__photo-swiper--big", {
  spaceBetween: 5,
  loop: true,
  navigation: {
    nextEl: ".product-page__photo-button-next",
    prevEl: ".product-page__photo-button-prev",
  },

  breakpoints: {
    500: {
      loop: false,
    },
  },
  thumbs: {
    swiper: swiper,
  },
});

$(function () {
  let arrCatalog = $(".product-page__form-cards");
  for (let i = 0; i < arrCatalog.length; i++) {
    if ($(".product-page__form-card").is(".product-page__form-card--non")) {
      $(".product-page__form-card--non input").attr("type", "text");
    }
  }
});

$("#product-items__form-input--phone").mask("+7 (000)-000-00-00", {});

$(".product-items__tab").on("click", function () {
  let tabId = $(this).attr("data-id");
  let tabbottom = $(".product-items__bottom");
  let selected = tabbottom.find("[data-id=" + tabId + "]");

  $(".product-items__tab--active").removeClass("product-items__tab--active");
  $(this).addClass("product-items__tab--active");

  tabbottom
    .find(".product-items__bottom-item--active")
    .removeClass("product-items__bottom-item--active");

  selected.addClass("product-items__bottom-item--active");
});

var acc = document.getElementsByClassName("product-items__bottom-selector");
$(".product-items__bottom-selector-top").on("click", function () {
  var item = this.parentNode;
  var panel = this.nextElementSibling;
  if ($(item).is(".is-active")) {
    DelActive();
  } else {
    DelActive();
    item.classList.toggle("is-active");
    panel.style.height = panel.scrollHeight + "px";
  }
});
$(".product-items__bottom-selector-content-item").on("click", function () {
  let selectText = $(this).text();
  $(".product-items__bottom-selector-top-text").text(selectText);
  $(".product-items__bottom-selector").removeClass("is-active");
});

$(document).mouseup(function (e) {
  let div = $(".product-items__bottom-selector");
  if (!div.is(e.target) && div.has(e.target).length === 0) {
    $(".product-items__bottom-selector").removeClass("is-active");
  }
});
function DelActive() {
  $(acc).removeClass("is-active");
  $(".product-items__bottom-selector-content").css("height", 0);
  return true;
}

$(".product-page__btn--small").on("click", function () {
  $(".product-page__btn--small").toggleClass("active");
});

// $(".catalog-content__card-basket").on("click", function () {
//   $(this).toggleClass("active");
// });

$(document).ready(function () {
  $(".catalog-content__card--not")
    .find(".catalog-content__card-availability")
    .text("Нет в наличи");
});

$(".product-page__form-text").on("click", function () {
  $(".modal-screen").addClass("active");
  let body = document.body;
  body.style.overflow = "hidden";
});

$(".modal-top__close").on("click", function () {
  $(".modal-screen").removeClass("active");
  let body = document.body;
  body.style.overflow = "auto";
});

$(document).mouseup(function (e) {
  let div = $(".modal");
  if (!div.is(e.target) && div.has(e.target).length === 0) {
    $(".modal-screen").removeClass("active");
    let body = document.body;
    body.style.overflow = "auto";
  }
});

document.addEventListener("DOMContentLoaded", function () {
  heightTitle();
});

window.addEventListener("resize", function () {
  heightTitle();
});

function heightTitle() {
  let h = document.querySelector(".product-page__title").offsetHeight / 10;
  if (window.innerWidth <= 1024) {
    document.querySelector(".product-page__photo").style.marginTop =
      h + 2.2 + "rem";
  } else {
    document.querySelector(".product-page__photo").style.marginTop = "0";
  }
}

var acc1 = document.getElementsByClassName("product-items__acc");
$(".product-items__acc-top").on("click", function () {
  if (window.innerWidth <= 500) {
    var item1 = this.parentNode;
    var panel1 = this.nextElementSibling;
    if ($(item1).is(".acc-active")) {
      DelActive1();
    } else {
      DelActive1();
      item1.classList.toggle("acc-active");
      panel1.style.height = panel1.scrollHeight + "px";
    }
  }
});

function DelActive1() {
  $(acc1).removeClass("acc-active");
  $(".product-items__acc-bottom").css("height", 0);
  return true;
}

document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth <= 500) {
    $(".product-items__acc-bottom").css("height", 0);
  } else {
    $(".product-items__acc-bottom").css("height", "auto");
    $(acc1).removeClass("acc-active");
  }
});

window.addEventListener("resize", function () {
  if (window.innerWidth <= 500) {
    $(".product-items__acc-bottom").css("height", 0);
  } else {
    $(".product-items__acc-bottom").css("height", "auto");
    $(acc1).removeClass("acc-active");
  }
});

$(".product-items__bottom-item-content-form-add input").on(
  "input",
  function () {
    let file = $(".product-items__bottom-item-content-form-add input")[0]
      .files[0];

    if (file) {
      $(".product-items__bottom-item-content-form-add label").text(file.name);
    }
  }
);
