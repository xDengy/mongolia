document.addEventListener('DOMContentLoaded', function() {
  $(".catalog-content__card-basket").on("click", function () {
    $(this).toggleClass("active");
  });
  
  $(document).ready(function () {
    $(".catalog-content__card--not")
      .find(".catalog-content__card-availability")
      .text("Нет в наличи");
  });
  
  var acc1 = document.getElementsByClassName("favourites-top__selector");
  $(".favourites-top__selector-top").on("click", function () {
    var item1 = this.parentNode;
    var panel1 = this.nextElementSibling;
    if ($(item1).is(".is-active")) {
      DelActive();
    } else {
      DelActive();
      item1.classList.toggle("is-active");
      panel1.style.height = panel1.scrollHeight + "px";
    }
  });
  $(document).mouseup(function (e) {
    let div = $(".favourites-top__selector");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $(".favourites-top__selector").removeClass("is-active");
    }
  });
  function DelActive() {
    $(acc1).removeClass("is-active");
    $(".favourites-top__selector-bottom").css("height", 0);
    return true;
  }
  
  $(".favourites-top__selector-item").on("click", function () {
    let selectText = $(this).text();
    $(".favourites-top__selector-text").text(selectText);
    $(".favourites-top__selector").removeClass("is-active");
  });
  
})