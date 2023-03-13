document.addEventListener("DOMContentLoaded", () => {
  // Активность шапки
  $(document).ready(function () {
    if ($(window).scrollTop() > 10) {
      $(".header").addClass("header--sticky");
    } else {
      $(".header").removeClass("header--sticky");
    }
  });
  $(function () {
    $(window).scroll(function () {
      if ($(window).scrollTop() > 10) {
        $(".header").addClass("header--sticky");
      } else {
        $(".header").removeClass("header--sticky");
      }
    });
  });

  // открытие поиска
  $(".header__menu-item--search").on("click", function () {
    $(".header__search").toggleClass("header__search--active");
  });

  $(".header").on("mouseleave", function () {
    $(".header__search--active").removeClass("header__search--active");
  });

  // Аккордеон
  var acc = document.getElementsByClassName("accordion");
  $(".accordion__header").on("click", function () {
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

  function DelActive() {
    $(acc).removeClass("is-active");
    $(".accordion__description").css("height", 0);
    return true;
  }

  // Аккордеон2
  var acc = document.getElementsByClassName("accordion2");
  $(".cart-products__top-button svg").on("click", function () {
    var panel = $(".accordion__description2").get(0);
    if ($(".accordion2").is(".is-active")) {
      DelActive();
    } else {
      DelActive();
      $(".accordion2").toggleClass("is-active");
      panel.style.height = "100%";
    }
  });

  function DelActive() {
    $(acc).removeClass("is-active");
    $(".accordion__description2").css("height", 0);
    return true;
  }

  if ($(".accordion2").length) {
    if ($(".accordion2").hasClass(".is-active")) {
      DelActive();
    } else {
      DelActive();
      $(".accordion2").toggleClass("is-active");
      $(".accordion__description2").get(0).style.height = "100%";
    }
  }

  // для футера (заменяет ссылки заголовков, чтобы открывался лист со ссылками)
  if ($(window).width() <= 768) {
    $(".footer__nav-title").attr("href", "javascript:void(0);");
  }

  // Мобильное меню
  $(".header__menu-item--burger").on("click", function () {
    $("body").toggleClass("overflow ");
    $(".mobile-menu").toggleClass("mobile-menu--active");
    if ($(".mobile-menu").hasClass("mobile-menu--active")) {
      $(".header__menu-icon--open").css("display", "none");
      $(".header__menu-icon--close").css("display", "flex");
    } else {
      $(".header__menu-icon--close").css("display", "none");
      $(".header__menu-icon--open").css("display", "flex");
    }
  });

  // cookies

  $(".cookies__button").on("click", function () {
    $(".cookies").addClass("close");
  });

  // --
  $(function () {
    $(".cart-products__card-number").on("input", function () {
      $(this).val(
        $(this)
          .val()
          .replace(/[^0-9]/g, "")
      );
    });

    $(".cart-products__card-button--minus").on("click", function () {
      let a = Number(
        $(this)
          .parents(".cart-products__card-counter")
          .find(".cart-products__card-number")
          .val()
      );
      if (a > 0) {
        a -= 1;
        $(this)
          .parents(".cart-products__card-counter")
          .find(".cart-products__card-number")
          .val(a);
      }
    });

    $(".cart-products__card-button--plus").on("click", function () {
      console.log(1);
      let a = Number(
        $(this)
          .parents(".cart-products__card-counter")
          .find(".cart-products__card-number")
          .val()
      );
      a += 1;
      $(this)
        .parents(".cart-products__card-counter")
        .find(".cart-products__card-number")
        .val(a);
    });
  });

  // $(".recipient__check-wrap input").on("change", function () {
  //   if ($(".recipient__check-wrap input").is(":checked")) {
  //     $(".recipient-content--2").addClass("active");
  //     $(".recipient-content--1").removeClass("active");
  //   } else {
  //     $(".recipient-content--1").addClass("active");
  //     $(".recipient-content--2").removeClass("active");
  //   }
  // });
  //
  // $(".recipient__check-wrap input").load("change", function () {
  //   if ($(".recipient__check-wrap input").is(":checked")) {
  //     $(".recipient-content--2").addClass("active");
  //     $(".recipient-content--1").removeClass("active");
  //   } else {
  //     $(".recipient-content--1").addClass("active");
  //     $(".recipient-content--2").removeClass("active");
  //   }
  // });

  // tabs
  $(".obtaining__tab").on("click", function () {
    let tabId = $(this).attr("data-id");
    let tabbottom = $(".obtaining__content-wrap");
    let selected = tabbottom.find("[data-id=" + tabId + "]");

    $(".obtaining__tab--active").removeClass("obtaining__tab--active");
    $(this).addClass("obtaining__tab--active");

    tabbottom
      .find(".obtaining__content")
      .removeClass("obtaining__content--active");

    selected.addClass("obtaining__content--active");
  });
  // tabs

  $(".obtaining__content-button").on("click", function () {
    for (let i = 0; i < $(".obtaining__content--active").length; i++) {
      $(".obtaining__content-card").removeClass(
        "obtaining__content-card--active"
      );
      $(this)
        .parents(".obtaining__content-card")
        .addClass("obtaining__content-card--active");
    }
  });

  // sliders
  const products = new Swiper(".products-slider", {
    slidesPerView: "auto",
    spaceBetween: 2,
    navigation: {
      nextEl: ".customers__swiper-button-next",
      prevEl: ".customers__swiper-button-prev",
    },
  });
  // $(document).ready(function () {
  //   if ($(window).width() <= 1180) {
  //     const catalog = new Swiper(".catalog-slider", {
  //       slidesPerView: "auto",
  //       spaceBetween: 2,
  //     });
  //   }
  // });
  let swiperInstance = null;

  const swiperСatalog = () => {
    if (!swiperInstance) {
      swiperInstance = new Swiper(".catalog-slider", {
        slidesPerView: "auto",
        spaceBetween: 2,
      });
    }
  };

  const destroySwiper = () => {
    if (swiperInstance) {
      swiperInstance.destroy();
      swiperInstance = null;
    }
  };

  document.addEventListener("DOMContentLoaded", function () {
    if (window.matchMedia("(max-width: 1180px)").matches) {
      swiperСatalog();
    }
  });

  window.onresize = function () {
    if (window.matchMedia("(max-width: 1180px)").matches) {
      swiperСatalog();
    } else {
      destroySwiper();
    }
  };

  // маска
  $(document).ready(function () {
    $("#host-phone").mask("+7 (000)-000-00-00", {});
  });

  //
  $(".pay__form-check").on("change", function () {
    if ($("#pay__online").is(":checked")) {
      $(".pay__form-wrap--online").addClass("active");
    } else {
      $(".pay__form-wrap--online").removeClass("active");
    }
  });
  $(".pay__form-check").load("change", function () {
    if ($("#pay__online").is(":checked")) {
      $(".pay__form-wrap--online").addClass("active");
    } else {
      $(".pay__form-wrap--online").removeClass("active");
    }
  });
});
