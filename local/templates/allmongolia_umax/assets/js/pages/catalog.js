document.addEventListener('DOMContentLoaded', function () {
  // var $range = $(".js-range-slider"),
  //     $inputFrom = $(".js-input-from"),
  //     $inputTo = $(".js-input-to"),
  //     instance,
  //     min = 0,
  //     max = 55000,
  //     from = 0,
  //     to = 0;

  // $range.ionRangeSlider({
  //   type: "double",
  //   min: min,
  //   max: max,
  //   from: min,
  //   to: max,
  //   onStart: updateInputs,
  //   onChange: updateInputs,
  // });
  // instance = $range.data("ionRangeSlider");

  // function updateInputs(data) {
  //   from = data.from;
  //   to = data.to;

  //   $inputFrom.prop("value", from);
  //   $inputTo.prop("value", to);
  // }

  // $inputFrom.on("input", function () {
  //   var val = $(this).prop("value");

  //   // validate
  //   if (val < min) {
  //     val = min;
  //   } else if (val > to) {
  //     val = to;
  //   }

  //   instance.update({
  //     from: val,
  //   });
  // });

  // $inputTo.on("input", function () {
  //   var val = $(this).prop("value");

  //   // validate
  //   if (val < from) {
  //     val = from;
  //   } else if (val > max) {
  //     val = max;
  //   }

  //   instance.update({
  //     to: val,
  //   });
  // });

// Аккордеон
  window.initCatalog = function() {
    var acc1 = document.getElementsByClassName("accordion-catalog");
    $(".accordion-catalog__header").on("click", function () {
      var item1 = this.parentNode;
      var panel1 = this.nextElementSibling;
      if ($(item1).is(".is-active")) {
        DelActive1(item1);
      } else {
        DelActive1(item1);
        item1.classList.toggle("is-active");
        // panel1.style.height = panel1.scrollHeight + 5 + "px";
      }
    });

    function DelActive1(elem) {
      $(elem).removeClass("is-active");
      // $(".accordion-catalog__description").css("height", 0);
      return true;
    }

  // Аккордеон
    var acc = document.getElementsByClassName("catalog-content-top__sort");

    $(".catalog-content-top__sort-top").on("click", function () {
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
    $(".catalog-content-top__sort-item").on("click", function () {
      let selectText = $(this).text();
      $(".catalog-content-top__sort-top-text").text(selectText);
      $(".catalog-content-top__sort").removeClass("is-active");
    });

    $(document).mouseup(function (e) {
      let div = $(".catalog-content-top__sort");
      if (!div.is(e.target) && div.has(e.target).length === 0) {
        $(".catalog-content-top__sort").removeClass("is-active");
      }
    });

    function DelActive() {
      $(acc).removeClass("is-active");
      $(".catalog-content-top__sort-bottom").css("height", 0);
      return true;
    }

    $(function () {
      let arrCatalog = $(".catalog-nav__item-bottom--size");
      for (let i = 0; i < arrCatalog.length; i++) {
        if (
            $(".catalog-nav__item-size-card").is(".catalog-nav__item-size-card--not")
        ) {
          $(".catalog-nav__item-size-card--not input").attr("type", "text");
        }
      }
    });

    // $(".catalog-content__card-basket").on("click", function () {
    //   $(this).toggleClass("active");
    // });

    $(document).ready(function () {
      $(".catalog-content__card--not")
          .find(".catalog-content__card-availability")
          .text("Нет в наличи");
    });

    $(".extra-controls__price input").on("input", function () {
      $(this).val($(this).val().replace(/\D/, "").substring(0, 6));
    });
  }
  initCatalog()
})
